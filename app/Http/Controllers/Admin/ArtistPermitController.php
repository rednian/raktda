<?php
namespace App\Http\Controllers\Admin;
use DB;
use PDF;
use Auth;

use Carbon\Carbon;
use CountryState;
use App\User;
use App\Artist;
use App\Permit;
use App\Roles;
use App\Country;
use App\ArtistPermit;
use App\Profession;
use App\ApproverProcedure;
use App\ArtistPermitComment;
use App\PermitComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\AllNotification;

class ArtistPermitController extends Controller
{

    public function __construct(){
        $this->middleware('signed')->except([
            'search',
            // 'download',
            'submitApplication',
            'checkActivePermit',
            'artistChecklist',
            'approverDataTable',
            'artistChecklistDocument',
            'artistPermitHistory',
            'applicationDataTable',
            'permitHistory',
            'applicationCommentDataTable',
            'datatable',
            'artistDataTable',
            'permitCommentDatatable',
            'cancelPermit'
        ]);
    }

    public function index(Request $request)
    {
        $view = $request->user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists() ? 'admin.artist_permit.inspector_index' : 'admin.artist_permit.index';

        return view($view, [
            'page_title'=> 'Artist Permit Dashboard',
            'breadcrumb'=> 'admin.artist_permit.index',
            'professions'=>Profession::has('artistpermit')->get(),
            'countries'=> Country::has('artistpermit')->get(),
            'new_request'=> Permit::has('artist')->whereIn('permit_status', ['new'])->count(),
            'pending_request'=> Permit::has('artist')->whereIn('permit_status', ['checked', 'modified'])->count(),
            'approved_permit'=> Permit::lastMonth(['active'])->count(),
            'rejected_permit'=> Permit::lastMonth(['rejected'])->count(),
            'cancelled_permit'=> Permit::lastMonth(['cancelled'])->count(),
            'active_permit'=> Permit::lastMonth(['active', 'approved-unpaid', 'rejected', 'expired', 'modification request'])->count(),
            'active'=> Permit::where('permit_status', 'active')->count(),
            'processing' => Permit::whereIn('permit_status', ['approved-unpaid', 'modification request', 'processing', 'need approval'])->count()
        ]);

    }
    public function search(Request $request)
    {
        $permit = Permit::where('reference_number', 'like', $request->q.'%')->get();
        return response()->json($permit);
    }

    public function download(Request $request, Permit $permit)
    {
        $data['company_details'] = $permit->owner->user_id;
        $data['artist_details'] = $permit->artistPermit()->with('artist', 'profession', 'nationality')->get();
        $data['permit_details'] = $permit;

        $permitNumber = $permit->permit_number;

        $pdf = PDF::loadView('permits.artist.permit_print', $data, [], [
            'title' => 'Artist Permit',
            'default_font_size' => 10,
            'show_watermark'=> in_array($permit->permit_status , ['cancelled', 'expired']) ? true : false,
            'watermark'      => ucfirst($permit->permit_status),
        ]);
        return $pdf->stream('Permit-' . $permitNumber . '.pdf');
    }

    public function cancelPermit(Request $request, Permit $permit)
    {
        DB::beginTransaction();
        try {
            $request['role_id'] = $request->user()->roles()->first()->role_id;
            $request['user_id'] = $request->user()->user_id;
            $request['checked_date'] = Carbon::now();
            $permit->comment()->create($request->all());
            $permit->update([
                'cancel_reason'=>$request->comment,
                'cancel_by'=>$request->user_id,
                'cancel_date'=>$request->checked_date,
                'permit_status'=>$request->action
            ]);
            DB::commit();
            $result = ['success', '', 'Success'];

            //SEND NOTIFICATION TO COMPANY FOR PERMIT CANCELLATION BY ADMIN
            $users = $permit->owner->company->users;

            $subject = 'Artist Permit # ' . $permit->reference_number . ' - Application Cancelled';
            $title = 'Artist Permit <b># ' . $permit->reference_number . '</b> - Application Cancelled';
            $content = 'Your Artist Permit application with the reference number <b>' . $permit->reference_number . '</b> has been cancelled by the Administrator. To view the details, please click the button below.';
            $url = URL::signedRoute('company.get_permit_details', $permit->permit_id);
            $buttonText = 'View Application';

            foreach ($users as $user) {
                $user->notify(new AllNotification([
                    'subject' => $subject,
                    'title' => $title,
                    'content' => $content,
                    'button' => $buttonText,
                    'url' => $url,
                    'mail'=>true
                ]));
            }
            //END SEND NOTIFICATION COMPANY

        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect()->back()->with('message', $result);
    }

    public function show(Request $request, Permit $permit)
    {

        $revision = Permit::has('artist')
            ->whereNotIn('permit_status', ['draft'])
            ->whereNotNull('permit_reference_id')
            ->where('permit_reference_id', $permit->permit_reference_id)
            ->where('permit_id', '!=', $permit->permit_id)
            ->where('permit_id', '<', $permit->permit_id)
            ->count();

        return view('admin.artist_permit.show', ['permit'=>$permit, 'page_title'=>'Artist Permit Details', 'rivision'=>$revision]);
    }

    public function applicationDetails(Request $request, Permit $permit)
    {
        $revision = Permit::has('artist')
            ->whereNotIn('permit_status', ['draft'])
            ->whereNotNull('permit_reference_id')
            ->where('permit_reference_id', $permit->permit_reference_id)
            ->where('permit_id', '!=', $permit->permit_id)
            ->where('permit_id', '<', $permit->permit_id)
            ->count();


        if(!$request->session()->has('user')){$request->session()->put('user', ['time_start'=> Carbon::now()]);}

        //UPDATE LOCK ARTIST PERMIT
        $permit->update([
            'lock' => Carbon::now(),
            'lock_user_id' => $request->user()->user_id
        ]);

        return view('admin.artist_permit.application-details', [
            'page_title'=> 'artist permit details',
            'permit'=>$permit,
            'roles'=>Roles::where('type', 0)->get(),
            'rivision'=>$revision,

        ]);
    }

    public function submitApplication(Request $request, Permit $permit)
    {
        try {
            DB::beginTransaction();
            $user_time = $request->session()->get('user');
            $user = Auth::user();
            $request['user_id'] = $user->user_id;
            $request['checked_date'] = Carbon::now();


            // $request['role_id'] =  $user->roles->where('NameEn', 'admin')->first()->role_id;

            //GET USER ROLE UPDATED BY DONSKIE
            $request['role_id'] = $user->roles()->first()->role_id;

            switch ($request->action) {
                case 'approved-unpaid':
                    $permit->comment()->create($request->all());
                    $permit->update(['permit_status'=>$request->action, 'approved_by'=>$request->user_id, 'approved_date'=> Carbon::now() ]);
                    $this->sendNotificationCompany($permit, 'approve');

                    break;
                case 'rejected';
                    $request['type'] = 1;
                    $permit->comment()->create($request->all());
                    $permit->update(['permit_status'=>$request->action]);

                    $this->sendNotificationCompany($permit, 'reject');
                    break;
                case 'send_back':
                    $request['type'] = 1;
                    $request['action'] = 'modification request';
                    $permit->comment()->create($request->all());
                    $permit->update(['permit_status'=>$request->action]);

                    $this->sendNotificationCompany($permit, 'amend');
                    break;
                case 'need approval':

                    $request['type'] = 1;

                    $permit->comment()->create($request->all());
                    if($request->role){
                        foreach ($request->role as $role_id) {
                            if($role_id != 6){
                                $permit->comment()->create([
                                    'action'=>'pending',
                                    'role_id'=>$role_id,
                                    'user_id'=> null,
                                    'comment'=> null,
                                ]);

                                //SEND EMAIL NOTIFICATION
                                $this->sendNotificationApproval($permit, User::whereHas('roles', function($q) use($role_id){
                                    $q->where('roles.role_id', $role_id);
                                })->get());

                            }else{//IF GOVERNMENT APPROVAL -> LOOP SELECTED GOVT DEPT
                                if($request->has('department')){
                                    foreach ($request->department as $dep) {

                                        $permit->comment()->create([
                                            'action'=>'pending',
                                            'role_id'=>$role_id,
                                            'user_id'=> null,
                                            'comment'=> null,
                                            'government_id' => $dep
                                        ]);

                                        //SEND EMAIL NOTIFICATION
                                        $this->sendNotificationApproval($permit, User::whereHas('roles', function($q) use($role_id){
                                            $q->where('roles.role_id', $role_id);
                                        })->where('government_id', $dep)->get());
                                    }
                                }
                            }
                        }
                    }
                    $permit->update(['permit_status'=>$request->action]);
                    break;
                //INSPECTOR AND MANAGER APPROVAL
                case 'approved':

                    $comment = $permit->comment()->where([
                        'action' => 'pending',
                        'role_id' => $user->roles()->first()->role_id,
                    ])->latest()->first();

                    if(!is_null($user->government_id)){
                        $comment = $permit->comment()->where([
                            'action' => 'pending',
                            'role_id' => $user->roles()->first()->role_id,
                            'government_id' => $user->government_id
                        ])->latest()->first();
                    }

                    $comment->update($request->except(['_token', 'bypass_payment', 'exempt_percentage'=>$request->exempt_percentage]));

                    //RESET LOCK TO NONE
                    $permit->update([
                        'lock' => null,
                        'lock_user_id' => null
                    ]);

                    if($request->has('bypass_payment')){

                        $comment->exempt_payment = 1;
                        $comment->save();

                        $permit->exempt_payment = 1;
                        $permit->exempt_by = $request->user()->user_id;
                        // $permit->exempt_percentage = $request->exempt_percentage;
                        $permit->save();
                    }

                    //CHECK IF I AM THE LAST APPROVER
                    if($permit->comment()->where('action', 'pending')->whereNull('user_id')->count() == 0){
                        $permit->update(['permit_status'=>'checked']);
                    }

                    //SEND NOTIFICATION
                    $this->sendNotificationChecked($permit, User::whereHas('roles', function($q){
                        $q->where('roles.role_id', 1);
                    })->get(), $request->user());

                    break;
                case 'disapproved':

                    $comment = $permit->comment()->where([
                        'action' => 'pending',
                        'role_id' => $user->roles()->first()->role_id
                    ])->first();

                    if(!is_null($user->government_id)){
                        $comment = $permit->comment()->where([
                            'action' => 'pending',
                            'role_id' => $user->roles()->first()->role_id,
                            'government_id' => $user->government_id
                        ])->first();
                    }

                    $comment->update($request->except(['_token', 'bypass_payment']));

                    //RESET LOCK TO NONE
                    $permit->update([
                        'lock' => null,
                        'lock_user_id' => null
                    ]);

                    if($request->has('bypass_payment')){

                        $comment->exempt_payment = 1;
                        $comment->save();

                        $permit->exempt_payment = 1;
                        $permit->exempt_by = $request->user()->user_id;
                        $permit->save();
                    }

                    //CHECK IF I AM THE LAST APPROVER
                    if($permit->comment()->where('action', 'pending')->whereNull('user_id')->count() == 0){
                        $permit->update(['permit_status'=>'checked']);
                    }

                    //SEND NOTIFICATION
                    $this->sendNotificationChecked($permit, User::whereHas('roles', function($q){
                        $q->where('roles.role_id', 1);
                    })->get(), $request->user());

                    break;
            }

            DB::commit();
            $result = ['success', ' Success!', 'Success'];
        } catch (\Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect(URL::signedRoute('admin.artist_permit.index'))->with('message', $result);
    }

    private function sendNotificationCompany($permit, $type){

        $buttonText = 'View Application';
        if($type == 'approve'){
            $subject = 'Artist Permit # ' . $permit->reference_number . ' - Application Approved';
            $title = 'Artist Permit <b># ' . $permit->reference_number . '</b> - Application Approved';
            $content = 'Your Artist Permit application with the reference number <b>' . $permit->reference_number . '</b> has been approved. To view the details, please click the button below.';
            $url = URL::signedRoute('company.get_permit_details', $permit->permit_id);
            $buttonText = 'Make Payment';

            $sms_content = ['name'=>'artist permit', 'status'=> 'approved', 'reference_number'=>$permit->reference_number,
            'url'=> URL::signedRoute('company.get_permit_details', $permit->permit_id), 'payment'=>true];
        }

        if($type == 'amend'){
            $subject = 'Artist Permit # ' . $permit->reference_number . ' - Application Requires Amendment';
            $title = 'Artist Permit <b># ' . $permit->reference_number . '</b> - Application Requires Amendment';
            $content = 'Your application with the reference number <b>' . $permit->reference_number . '</b> has been bounced back for amendment. To view the details, please click the button below.';
            $url = URL::signedRoute('company.get_permit_details', ['id' => $permit->permit_id, 'status' => 'amend']);

            $sms_content = ['name'=>'artist permit', 'status'=> 'bounced back for amendment', 'reference_number'=>$permit->reference_number,
            'url'=> URL::signedRoute('company.get_permit_details', ['id' => $permit->permit_id, 'status' => 'amend'])];
        }

        if($type == 'reject'){
            $subject = 'Artist Permit # ' . $permit->reference_number . ' - Application Rejected';
            $title = 'Artist Permit <b># ' . $permit->reference_number . '</b> - Application Rejected';
            $content = 'Your application with the reference number <b>' . $permit->reference_number . '</b> has been rejected. To view the details, please click the button below.';
            //$url = URL::signedRoute('event.show', ['event' => $event->event_id, 'tab' => 'applied']);
            $url = '#';

            $sms_content = ['name'=>'artist permit', 'status'=> 'rejected', 'reference_number'=>$permit->reference_number,
            'url'=> URL::signedRoute('company.get_permit_details', ['id' => $permit->permit_id])];
        }

        $users = $permit->owner->company->users;

        foreach ($users as $user) {
            $user->notify(new AllNotification([
                'subject' => $subject,
                'title' => $title,
                'content' => $content,
                'button' => $buttonText,
                'url' => $url,
                'mail'=>true
            ]));
            sms($user->number, $sms_content);
        }
    }


    private function sendNotificationApproval($permit, $users){

        $subject = 'Artist Permit #' . $permit->reference_number . ' For Approval';
        $title = 'Artist Permit <b>#' . $permit->reference_number . '</b> For Approval';
        $content = 'The artist permit with reference number <b>' . $permit->reference_number . '</b> needs to have an approval from your department. Please click the link below.';
        $url = URL::signedRoute('admin.artist_permit.applicationdetails', ['permit' => $permit->permit_id]);

        foreach ($users as $user) {
            $user->notify(new AllNotification([
                'subject' => $subject,
                'title' => $title,
                'content' => $content,
                'button' => 'View Permit',
                'url' => $url,
                'mail'=>true
            ]));
        }
    }

    private function sendNotificationChecked($permit, $users, $checked_by){

        $subject = 'Artist Permit #' . $permit->reference_number . ' Has Been Checked';
        $title = 'Artist Permit <b>#' . $permit->reference_number . '</b> Has Been Checked';
        $content = 'The artist permit with reference number <b>' . $permit->reference_number . '</b> has been checked by '. $checked_by->NameEn .'.';
        $url = URL::signedRoute('admin.artist_permit.show', $permit->permit_id);

        if($permit->comment()->where('action', 'pending')->whereNull('user_id')->count() == 0){
            $url = URL::signedRoute('admin.artist_permit.applicationdetails', $permit->permit_id);
        }

        foreach ($users as $user) {
            $user->notify(new AllNotification([
                'subject' => $subject,
                'title' => $title,
                'content' => $content,
                'button' => 'View Permit',
                'url' => $url,
                'mail'=>true
            ]));
        }
    }

    public function checkActivePermit(Request $request, Permit $permit, Artist $artist)
    {
        $permit = Permit::whereHas('artistpermit', function($q) use ($artist){
            $q->where('artist_id',$artist->artist_id);
        })->where('permit_status', 'active')->get();
        $result = ['permit'=>$permit, 'count'=>$permit->count()];

        return response()->json($result);
    }

    public function artistChecklist(Request $request, Permit $permit, ArtistPermit $artistpermit)
    {
        try {
            DB::beginTransaction();

            $artistpermit->update(['artist_permit_status'=>$request->artist_permit_status, 'is_checked'=>1]);
            $artistpermit->update(['is_checked'=>1]);
            //delete the last checklist and replace with recentb
            $artistpermit->check()->where('artist_permit_id', $artistpermit->artist_permit_id)->delete();
            $artist_permit_check = $artistpermit->check()->create(['status'=>0]);

            if($request->comment){
                $request['permit_id'] = $permit->permit_id;
                $request['user_id'] = Auth::user()->user_id;
                $request['type'] = 1;
                $comment = $permit->comment()->create($request->all());
                $comment->artistPermitComment()->attach($artistpermit->artist_permit_id);
            }

            if($request->check){
                foreach ($request->check as $fieldname => $value){
                    $artist_permit_check->checklist()->create([
                        'fieldname'=>$fieldname,
                        'value'=>$value,
                        'artist_permit_id'=>$artistpermit->artist_permit_id
                    ]);
                }
            }

            DB::commit();
            $result = ['success', $artistpermit->artist->fullname.' successfully checked.', 'Success'];

        } catch (Exception $e) {
            DB::rollBack();
            $result = ['danger', $e->getMessage(), 'Error'];
        }

        return redirect(URL::signedRoute('admin.artist_permit.applicationdetails', $permit->permit_id))->with(['message'=>$result]);
    }

    public function checkApplication(Request $request,Permit $permit,  ArtistPermit $artistpermit)
    {
        $existing_permit = ArtistPermit::whereHas('permit', function($q) use ($permit){
            $q->where('permit_status', '!=', 'unchecked')
                ->where('permit_id', '!=', $permit->permit_id);
        })->where('artist_id', $artistpermit->artist_id)->get();

        $artist_is_active = Artist::whereHas('artistpermit', function($q) use ($artistpermit){
            $q->where('artist_permit_id', $artistpermit->artist_permit_id);
        })
            ->where('artist_status', 'active')
            ->exists();
        $permit_count = Artist::where('artist_id', $artistpermit->artist_id)->whereHas('permit', function($q){
            $q->where('permit_status', 'active');
        })->get();

        return view('admin.artist_permit.check-application', [
            'page_title'=>'check artist details',
            'permit'=>$permit,
            'existing_permit'=>$existing_permit,
            'artist_permit'=>$artistpermit,
            'is_local'=>$artistpermit->isLocal()->exists(),
            'is_europe'=>$artistpermit->isEurope()->exists(),
            'status'=>$artistpermit->artist->artist_status,
            'age'=>$artistpermit->age,
            'permit_count'=>$permit_count->count(),
            'reason'=> $artistpermit->artist->artist_status != 'active' ? $artistpermit->artist->action->first()->remarks : null
        ]);
    }

    public function approverDataTable(Request $request)
    {
        $approver = ApproverProcedure::whereHas('procedure', function($q)  {
            $q->where('procedure_type', 'artist')
                ->where('procedure_status', 1);
        })->orderBy('order')->get();


        return Datatables::of($approver)
            ->editColumn('designation', function($approver){
                return ucwords($approver->role->NameEn);
            })
            ->addColumn('employee_name', function($approver){

            })
            ->editColumn('status', function($approver){

                if(!$approver->procedure->has('permitProcedure')->get()){
                    $class_name = strtolower($approver->procedure->permitProcedure->status) == 'approved' ?  'success': 'warning';
                    $status = $approver->procedure->permitProcedure->status;
                }
                else{
                    $status = 'pending';
                    $class_name = 'info';
                }

                return ' <span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($approver->procedure->permitProcedure->status).'</span>';
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function artistChecklistDocument(Request $request, Permit $permit,  ArtistPermit $artistpermit)
    {
        $artist_permit_document = $artistpermit->artistPermitDocument()->get();

        $artist_permit_document =  Datatables::of($artist_permit_document)
            ->editColumn('document_name', function($artist_permit_document){
                $name = '<a href="'.asset('/storage/'.$artist_permit_document->path).'" data-fancybox data-fancybox data-caption="'.ucwords($artist_permit_document->requirement->requirement_name).'">';
                $name .= ucwords($artist_permit_document->requirement->requirement_name);
                $name .='</a>';
                return $name;
            })
            ->editColumn('issued_date', function($artist_permit_document){
                return $artist_permit_document->issued_date->year > 1 ? $artist_permit_document->issued_date->format('d-F-Y') : '-';
            })
            ->editColumn('expired_date', function($artist_permit_document){
                return $artist_permit_document->expired_date->year > 1 ? $artist_permit_document->expired_date->format('d-F-Y') : '-';
            })
            ->addColumn('name', function($artist_permit_document){
                return  $artist_permit_document->requirement->requirement_name;
            })
            ->rawColumns(['action', 'document_name'])
            ->make(true);

        $data = $artist_permit_document->getData(true);

        $data['data'][] = [
            'document_name' => '<a href="'.asset('/storage/'.$artistpermit->thumbnail).'" data-fancybox data-caption="'.ucwords($artistpermit->artist->fullname).' - Photo">Artist Photo</a>',
            'issued_date'=> '-',
            'expired_date'=> '-',
            'name'=> ucwords($artistpermit->artist->fullname)
        ];

        return response()->json($data);

    }

    public function artistPermitHistory(Request $request, Permit $permit, Artist $artist)
    {
        $artist = ArtistPermit::whereHas('permit', function($q) use ($permit){
            $q->where('permit_status', '!=', 'pending')
                ->where('permit_id', '!=', $permit->permit_id);
        })->where('artist_id', $artist->artist_id)->get();
        return Datatables::of($artist)
            ->editColumn('reference_number', function($artist){
                return $artist->permit->reference_number;
            })
            ->editColumn('permit_start', function($artist){
                return $artist->permit->issued_date->format('d-M-Y h:m a');
            })
            ->editColumn('expiry_date', function($artist){
                return $artist->permit->expired_date->format('d-M-Y h:m a');
            })
            ->editColumn('permit_status', function($artist){
                $class_name = strtolower($artist->permit->permit_status) == 'active' ? 'success' : 'danger';
                return ' <span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($artist->permit->permit_status).'</span>';
            })
            ->editColumn('permit_number', function($artist){
                return $artist->permit->permit_number;
            })
            ->editColumn('company_name', function($artist){
                return ucwords($artist->permit->company->company_name);
            })
            ->rawColumns(['permit_status'])
            ->make(true);
    }

    public function applicationDataTable(Request $request, Permit $permit)
    {
        if($request->ajax()){
            $artist_permit = $permit->artistPermit()->whereNull('type')->orderBy('updated_at')->get();
            return Datatables::of($artist_permit)
                ->addColumn('nationality', function($artist_permit){
                    if($artist_permit->country()->exists()){ return ucwords($artist_permit->country->nationality_en); }
                    return null;

                })
                ->addColumn('age', function($artist_permit){
                    return $artist_permit->age;
                })
                ->addColumn('fullname', function($artist_permit){
                    return ucwords($artist_permit->fullname);
                })
                ->addColumn('profession', function($artist_permit){
                    if(!$artist_permit->profession){ return null; }
                    return ucwords($artist_permit->profession->name);
                })
                ->addColumn('person_code', function($artist_permit){
                    return $artist_permit->artist->person_code;
                })
                ->editColumn('artist_status', function($artist_permit){
                    return permitStatus($artist_permit->artist_permit_status);
                })
                ->addColumn('is_allowed_multiple_permit', function($artist_permit){
                    return $artist_permit->profession->is_multiple ? true : false;
                })
                ->addColumn('active_permit', function($artist_permit){
                })
                ->addColumn('existing_permit', function($artist_permit) use ($permit){

                    $existing_permit = Permit::whereHas('artistpermit', function($q) use ($artist_permit){
                        $q->where('artist_id', $artist_permit->artist_id)
                            ->whereHas('profession', function($q){
                                $q->where('is_multiple', 0);
                            });
                    })
                        ->whereNotNull('expired_date')
                        ->where('expired_date', '>=', Carbon::now())
                        ->where('permit_id', '!=',$permit->permit_id)
                        ->whereIn('permit_status', ['active', 'approved-unpaid'])
                        ->first();

                    if (!$existing_permit) { return false; }
                    $name = ucwords($artist_permit->artist->fullname);
                    $date = null;
                    if($existing_permit->expired_date){
                        $date = $existing_permit->created_at->diffForHumans();
                    }
                    $profession = $artist_permit->profession->name_en;
                    return '<span class="kt-font-bolder kt-font-transform-u">'.$name.'</span> currently has an existing permit that will expire '.$date.' with profession of
								<span class="kt-font-bolder  kt-font-transform-u">'.ucwords($profession).' </span>';
                })
                ->addColumn('action', function($artist_permit){
                    $html = '<button class="btn btn-secondary btn-sm btn-elevate btn-document kt-margin-r-5">';
                    $html .=  __('ATTACHMENTS');
                    $html .=  ' <span class="kt-badge kt-badge--brand kt-badge--outline kt-badge--sm">';
                    $html .=  ($artist_permit->artistPermitDocument()->count()+1);
                    $html .=  '</span>';
                    $html .= '</button>';
                    $html .= '<button class="btn btn-secondary btn-sm btn-elevate btn-comment-modal">';
                    $html .= __('REMARKS');
                    $html .= ' <span class="kt-badge kt-badge--brand kt-badge--outline kt-badge--sm">';
                    $html .= $artist_permit->comments()->count();
                    $html .= '</span>';
                    $html .= '</button>';


                    return $html;
                })
                ->addColumn('show_link', function($artist_permit) use($permit){
                    return URL::signedRoute('admin.artist_permit.checkApplication', ['permit' => $permit->permit_id, 'artistpermit' => $artist_permit->artist_permit_id]);
                })
                ->addColumn('artist_link', function($artist_permit){
                    return URL::signedRoute('admin.artist.show', $artist_permit->artist_id);
                })
                ->rawColumns(['artist_status', 'existing_permit', 'action'])
                ->make(true);
        }
    }

    public  function permitHistory(Request $request, Permit $permit)
    {

        $permits = Permit::has('artist')
            ->whereNotIn('permit_status', ['draft'])
            ->whereNotNull('permit_reference_id')
            ->where('permit_reference_id', $permit->permit_reference_id)
            ->where('permit_id', '!=', $permit->permit_id)
            ->where('permit_id', '<', $permit->permit_id)
            ->latest();


        return DataTables::of($permits)
            ->addColumn('applied_date', function($permit){
                return '<span class="text-underline" title="'.$permit->updated_at->format('l h:i A | d-F-Y').'">'.humanDate($permit->updated_at).'</span>';
            })
            ->editColumn('issued_date', function($permit){
                if (in_array($permit->permit_status, ['expired', 'cancelled', 'active'])) {
                    return $permit->issued_date->format('d-F-Y');
                }
                return '-';
            })
            ->editColumn('expired_date', function($permit){
                if (in_array($permit->permit_status, ['expired', 'cancelled', 'active'])) {
                    return $permit->issued_date->format('d-F-Y');
                }
                return '-';
            })
            ->editColumn('rivision_number', function($permit){
                return  $permit->rivision_number ? str_pad($permit->rivision_number, 1, 0, STR_PAD_LEFT) : '-';
            })
            ->editColumn('request_type', function($permit){
                $type = ucwords($permit->request_type).' Application';
                return __($type);
            })
            ->addColumn('artist_number', function($permit){
                $total = $permit->artistPermit()->count();
                $approved = $permit->artistPermit()->where('artist_permit_status', 'approved')->count();
                return $approved.__(' Approved of ').$total;
            })
            ->addColumn('permit_status', function ($permit){
                return permitStatus($permit->permit_status);
            })
            ->addColumn('duration', function ($permit){
                $date = Carbon::parse($permit->expired_date)->diffInDays($permit->issued_date);
                $date = $date !=  0 ? $date : 1;
                $day = $date > 1 ? ' Days': ' Day';
                return $date.$day;
            })
            ->addColumn('link', function ($permit){
                return URL::signedRoute('admin.artist_permit.show', $permit->permit_id);
            })
            ->rawColumns(['permit_status', 'action', 'applied_date'])
            ->make(true);
    }

    public function applicationCommentDataTable(Request $request, Permit $permit, ArtistPermit $artistpermit)
    {
        $comments = $artistpermit->comments()->orderBy('created_at', 'desc')->get();
        return DataTables::of($comments)
            ->addColumn('comment', function ($comments){
                // if(is_null($comments->comment)){ return '-'; }
                return ucfirst($comments->comment);
            })
            ->addColumn('commented_on', function ($comments){
                return $comments->created_at->format('d-M-Y h:m a');
            })
            ->addColumn('commented_by', function ($comments){
                return $comments->user->NameEn;
            })
            ->make(true);
    }


    public function dataTable(Request $request)
    {
        if($request->ajax()){

            $limit = $request->length;
            $start = $request->start;
            $permit = Permit::has('artist')
                ->when($request->term, function ($q) use ($request){
                    $q->where('term', $request->term);
                })
                ->when($request->status, function($q) use ($request){
                    $q->whereIn('permit_status', $request->status);
                })
                ->when($request->date, function ($q) use ($request){
                    $date = $request->date;
                    $q->whereDate('created_at', '>=', Carbon::parse($date['start'])->startOfDay()->toDateTimeString())
                        ->whereDate('created_at', '<=', Carbon::parse($date['end'])->endOfDay()->toDateTimeString());
                })
                ->when($request->approval, function($q) use($request){
                    $q->whereHas('comment', function($q) use($request){
                        $q->where('action', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->when($request->gov, function($q) use($request){
                            $q->where('government_id', $request->user()->government_id);
                        });
                    });
                })
                ->when($request->checked, function($q) use($request){
                    $q->whereHas('comment', function($q) use($request){
                        $q->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->whereNotNull('user_id')->when($request->gov, function($q) use($request){
                            $q->where('government_id', $request->user()->government_id);
                        });;
                    });
                })->get();

            return Datatables::of($permit)
                ->addColumn('artist_number', function($permit){
                    $total = $permit->artistpermit()->whereNull('type')->count();
                    $check = $permit->artistpermit()->whereNull('type')->whereNotIn('artist_permit_status', ['unchecked'])->count();
                    if(in_array($permit->permit_status, ['active', 'expired'])){ return  __('Approved ').$check.' of '.$total; }
                    return  __('Checked ').$check.' of '.$total;
                })
                ->editColumn('permit_status', function($permit){ return permitStatus($permit->permit_status); })
                ->editColumn('reference_number', function($permit){ return '<span class="kt-font-bold">'.$permit->reference_number.'</span>'; })
                ->addColumn('applied_date', function($permit){
                    return '<span class="text-underline" title="'.$permit->created_at->format('l d-M-Y h:i A').'">'.humanDate($permit->created_at).'</span>';
                })
                ->editColumn('permit_start', function($permit){
                    if(!$permit->issued_date) return null;
                    return $permit->issued_date->format('d-F-Y');
                })
                ->editColumn('permit_end', function($permit){
                    if(!$permit->expired_date) return null;
                    return $permit->expired_date->format('d-F-Y');
                })
                ->editColumn('updated_at', function($permit){
                    return '<span class="text-underline" title="'.$permit->updated_at->format('l h:i A | d-F-Y').'">'.humanDate($permit->updated_at).'</span>';
                })
                ->addColumn('rivision', function($permit){
                    $permits = Permit::has('artist')->where('permit_status', '!=', 'draft')
                        ->where('permit_id', '!=', $permit->permit_id)
                        ->where('permit_id', '<=', $permit->permit_id)
                        ->where('permit_reference_id', $permit->permit_reference_id)
                        ->whereNotNull('permit_reference_id')
                        ->count();
                    return $permits > 0 ? $permits : '-';
                })
                ->addColumn('duration', function($permit){
                    // return duration($permit->expired_date, $permit->issued_date);
                    // return $date = Carbon::parse($permit->expired_date)->diffInHumans($permit->issued_date);
                    $date = Carbon::parse($permit->expired_date)->diffInDays($permit->issued_date);
                    // $date = $date !=  0 ? $date : 1;
                    $date = $date + 1;
                    $day = $date > 1 ? ' '.__('Days'): ' '.__('Day');
                    return $date.$day;
                })
                ->editColumn('approved_date', function($permit){
                    return $permit->approved_date ? $permit->approved_date->format('d-F-Y') : '- ';
                })
                ->editColumn('approved_by', function($permit) use ($request){
                    if ($permit->approved_by) {
                        $name = $request->user()->LanguageId == 1 ?  ucwords($permit->approvedBy->NameEn) : ucwords($permit->approvedBy->NameAr);
                        $role = $request->user()->LanguageId == 1 ?ucwords($permit->approvedBy->roles()->first()->NameEn) : ucwords($permit->approvedBy->roles()->first()->NameAr);
                        return profileName($name, $role);
                    }
                    return '-';

                })
                ->addColumn('has_event', function($permit){
                    return $permit->event()->exists() ? __('YES') : __('NO');
                })
                ->addColumn('event', function($permit) use ($request){
                    if ($permit->event()->exists()) {
                        $name = $request->user()->LanguageId == 1 ? ucfirst($permit->event->name_en) : ucfirst($permit->event->name_ar);
                        $type = $request->user()->LanguageId == 1 ? ucfirst($permit->event->type->name_en) : ucfirst($permit->event->type->name_ar);
                        return profileName($name, $type);
                    }
                    return '-';
                })
                ->addColumn('company_name', function($permit) use ($request){
                    return $request->user()->LanguageId == 1 ? ucfirst($permit->owner->company->name_en) : ucfirst($permit->owner->company->name_ar);
                })
                ->editColumn('exempt_payment', function($permit){
                    return $permit->exempt_payment ? __('YES') : '-';
                })
                ->editColumn('exempt_by', function($permit) use ($request){
                    // return $request->user()->LanguageId == 1 ? ucfirst($permit->exemptBy->NameEn) : $permit->exemptBy->NameAr;
                })
                ->addColumn('location', function($permit) use ($request){
                    return $request->user()->LanguageId == 1 ? ucfirst($permit->work_location) : $permit->work_location_ar;

                })
                ->addColumn('application_link', function($permit){
                    return URL::signedRoute('admin.artist_permit.applicationdetails', ['permit' => $permit->permit_id]);
                })
                ->editColumn('term', function($permit){
                    return ucfirst($permit->term).' Term Permit';
                })
                ->addColumn('show_link', function($permit){
                    return URL::signedRoute('admin.artist_permit.show', ['permit' => $permit->permit_id]);
                })
                ->addColumn('company_type', function($permit){
                    return;
                    $class_name = 'default';
                    if(strtolower($permit->company->company_type) == 'private'){$class_name = 'success'; }
                    if(strtolower($permit->company->company_type) == 'government'){$class_name = 'danger'; }
                    if(strtolower($permit->company->company_type) == 'individual'){$class_name = 'info'; }
                    return '<span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($permit->company->company_type).'</span>';
                })
                ->editColumn('request_type', function($permit){ return ucwords($permit->request_type); })
                ->addColumn('action', function($permit){
                    if (in_array($permit->permit_status, ['active', 'expired', 'cancelled']) && !is_null($permit->approved_by)) {
                        return '<a href="'.URL::signedRoute('admin.artist_permit.download', $permit->permit_id).'" target="_blank" class="btn btn-download btn-sm btn-elevate btn-secondary"><span class="la la-download"></span>' . __('DOWNLOAD') . '</a>';
                    }
                    return '-';

                })
                ->addColumn('inspection_url', function($permit){
                    return route('tasks.artist_permit.details', $permit->permit_id);
                })
                ->addColumn('last_check_date', function($permit) use($request){
                    if($permit->comment()->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->latest()->first()){
                        return $permit->comment()->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->latest()->first()->updated_at;
                    }
                })
                ->addColumn('last_check_by', function($permit) use($request){
                    if($permit->comment()->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->latest()->first()){
                        return $permit->comment()->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->latest()->first()->user->NameEn;
                    }

                })
                ->addColumn('last_action_taken', function($permit) use($request){
                    if($permit->comment()->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->latest()->first()){
                        $status = $permit->comment()->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->latest()->first()->action;
                        return permitStatus($status);
                    }
                })
                ->rawColumns(
                    ['request_type', 'last_action_taken','request_type', 'reference_number', 'company_type', 'permit_status',
                        'action' , 'applied_date', 'approved_by', 'updated_at', 'event'
                    ])
                ->with('new_count', function(){
                    return Permit::has('artist')->where('permit_status', 'new')->count();
                })
                ->with('pending_count', function(){
                    return Permit::has('artist')->whereIn('permit_status', ['modified', 'checked'])->count();
                })
                ->with('cancelled_count', function(){
                    return Permit::has('artist')->where('permit_status', 'cancelled')->count();
                })
                ->make(true);
        }
    }

    public function permitCommentDatatable(Request $request, Permit $permit)
    {
        if ($request->ajax()) {

            $comments = $permit->comment()->doesntHave('artistPermitComment')->latest();
            $user = $request->user()->LanguageId;

            return DataTables::of($comments)
                ->addColumn('name', function($comment) use ($user){
                    $role_name = $comment->role->NameEn;


                    if ($comment->role_id == 6) {
                        $role_name =  Auth::user()->LanguageId == 1 ? ucwords($comment->government->government_name_en) : ucwords($comment->government->government_name_ar);
                    }

                    if (is_null($comment->user_id)) {
                        return profileName($role_name, '');
                    }

                    return profileName($comment->user->NameEn, $role_name);

                })
                ->editColumn('comment', function($comment) use ($user){
                    $data =  ucfirst($comment->comment);
                    if($comment->exempt_payment){
                        $data .= '<br><span class="kt-badge kt-badge--warning kt-badge--inline">Exempted for Payment</span>';
                    }
                    return $data;
                })
                ->editColumn('created_at', function($comment){
                    return '<span title="'.$comment->created_at->format('l h:i A | d-F-Y').'" class="text-underline">'.humanDate($comment->created_at).'</span>';
                })
                ->editColumn('action', function($comment){
                    return permitStatus(ucwords($comment->action));
                })
                ->rawColumns(['action', 'name', 'created_at', 'comment'])
                ->make(true);
        }
    }

    public function artistDataTable(Request $request, Permit $permit)
    {
        if($request->ajax()){
            $artist_permit = ArtistPermit::has('artist')->where('permit_id', $permit->permit_id)->get();

            return Datatables::of($artist_permit)
                ->editColumn('profession', function($artist_permit){
                    if(!$artist_permit->permitType) return null;
                    return ucwords($artist_permit->profession->name_en);
                })
                ->editColumn('nationality', function($artist_permit){
                    return ucwords($artist_permit->artist->country->nationality_en);
                })
                ->editColumn('person_code', function($artist_permit){
                    return ucwords($artist_permit->artist->person_code);
                })
                ->editColumn('age', function($artist_permit){
                    return ucwords($artist_permit->artist->age);
                })
                ->editColumn('name', function($artist_permit){
                    return ucwords($artist_permit->artist->name);
                })
                ->editColumn('artist_status', function($artist_permit){
                    $class_name = strtolower($artist_permit->artist->artist_status) == 'active' ? 'success': 'danger';
                    return '<span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($artist_permit->artist->artist_status).'</span>';
                })
                ->editColumn('check', function($artist_permit){
                    $html ='<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">';
                    $html .= '<input type="checkbox" >';
                    $html .=   '<span></span>';
                    $html .= '</label>';
                    return $html;
                })
                ->rawColumns(['artist_status', 'check'])
                ->make(true);}
    }
}
