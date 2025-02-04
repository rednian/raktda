<?php

namespace App\Http\Controllers\Admin;

use App\CompanyArtist;
use DB;
use App\Notifications\AllNotification;
use Carbon\Carbon;
use DataTables;
use App\Company;
use App\CompanyType;
use App\Areas;
use App\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->hasValidSignature()) { abort(401); }

        $new_company = Company::whereIn('status', ['new'])->count();

        return view('admin.company.index',[
            'page_title'=> __('Establishment'),
            'new_company'=> Company::where('status', 'new')->count(),
            'bounce_back'=> Company::where('status', 'bounce back')->count(),
            'approved'=> Company::where('status', 'active')->count(),
            'blocked'=> Company::where('status', 'blocked')->count(),
            'types'=>  CompanyType::orderBy('name_en')->get(),
            'pending'=>Company::whereStatus('return')->count(),
            'areas'=>  Areas::whereHas('company', function($q){ $q->whereIn('status', ['new', 'pending']); })->where('emirates_id', 5)->orderBy('area_en')->get(),
        ]);
    }

    private function sendNotificationCompany($company, $type){

        $buttonText = 'View Application';

        if($type == 'active'){
            $subject = $company->name. ' - Application Approved';
            $title = 'Application has been Approved';
            $content = 'Your application has been approved. To view the details, please click the button below.';
            $url = URL::signedRoute('company.show', ['company' => $company->company_id]);
            $button = 'Profile';
            $sms_content = ['name'=>'company', 'status'=> 'approved', 'reference_number'=>$company->reference_number,
            'url'=> URL::signedRoute('company.show', $company->company_id)];

        }

        if($type == 'return'){
            $subject = $company->name . ' - Application Requires Amendment';
            $title = 'Applications Requires Amendment';
            $content = 'Your application has been bounced back for amendment. To view the details, please click the button below.';
            $url = URL::signedRoute('company.edit', ['company' => $company->company_id]);
            $button ='Update Information';
            $sms_content = ['name'=>'company', 'status'=> 'bounced back for amendment', 'reference_number'=>$company->reference_number,
            'url'=> URL::signedRoute('company.edit', $company->company_id)];
        }

        if($type == 'rejected'){
            $subject = $company->name . ' - Application Rejected';
            $title = 'Application has been Rejected';
            $content = 'Your application has been rejected. To view the details, please click the button below.';
            $button ='Profile';
            $url = URL::signedRoute('company.show', ['company' => $company->company_id]);
            $sms_content = ['name'=>'company', 'status'=> 'rejected', 'reference_number'=>$company->reference_number,
            'url'=> URL::signedRoute('company.show', $company->company_id)];
        }
        $buttonText = null;


        $users = $company->users;
        $company->notify(new AllNotification([
            'subject' => $subject,
            'title' => $title,
            'content' => $content,
            'button' => $button,
            'url' => $url,
            'mail'=>true
        ]));

        foreach ($users as $user) {
            $user->notify(new AllNotification([
                'subject' => $subject,
                'title' => $title,
                'content' => $content,
                'button' => $button,
                'url' => $url,
                'mail'=>true
            ]));
            sms($user->number, $sms_content);
        }
    }

    public function submit(Request $request, Company $company)
    {

        DB::beginTransaction();
        try {
            $request['user_id'] = $request->user()->user_id;
            switch ($request->status) {
                case 'active':
                    $company->update(['status'=>$request->status, 'registered_date'=>Carbon::now(), 'registered_by'=>$request->user()->user_id]);
                    $request['action'] = 'approved';
                    $company->comment()->create($request->all());
                    $result = ['success', '', 'Success'];
                break;
                case 'return':
                    $company->update(['status'=>$request->status]);

                    $company->comment()->create($request->all());
                    $result = ['success',' ', 'Success'];
                break;
                case 'rejected':
                    $company->update(['status'=>$request->status]);
                    $company->comment()->create($request->all());
                    $result = ['success','', 'Success'];
                break;
            }

            $this->sendNotificationCompany($company, $company->status);
            DB::commit();

        } catch (Exception $e) {
            $result = ['danger', $e->getMessage(), 'Error'];
            DB::rollBack();

        }

        return redirect(URL::signedRoute('admin.company.index'))->with('message', $result);

    }



    public function changeStatus(Request $request, Company $company)
    {
        try {
            DB::beginTransaction();
            $company->update(['status'=>$request->status]);
            $request['user_id'] = $request->user()->user_id;
            $request['action'] = $request->status;
            $company->comment()->create($request->all());
            $result = ['success', ' ', 'Success'];
            DB::commit();
        } catch (Exception $e) {
            $result = ['danger', $e->getMessage(), 'Error'];
            DB::rollBack();

        }
        return redirect()->back()->with('message', $result);
    }



    public function commentDatatable(Request $request, Company $company)
    {
        return DataTables::of($company->comment()->latest())
            ->addColumn('name', function($comment) use ($request){
                return profileName($comment->user->name, $comment->user->roles()->first()->name);
            })
            ->addColumn('remark', function($comment) use ($request){
                return ucfirst($comment->remarks);
            })
            ->editColumn('action', function($comment){
                return ucfirst($comment->action);
            })
            ->addColumn('date', function($comment){
                return '<span class="text-underline"  title="'.$comment->created_at->format('l | h:i A, d-F-Y ').'">'.humanDate($comment->created_at).'</span>';
            })
            ->rawColumns(['date', 'name'])
            ->make(true);
    }


    public function application(Request $request, Company $company)
    {
        if (!$request->hasValidSignature()) { abort(401); }
        return view('admin.company.application', [
            'company'=>$company,
            'page_title'=> 'RAKTDA | Proccessing Establishment'
        ]);
    }



    public function show(Request $request, Company $company)
    {

        if (!$request->hasValidSignature()) { abort(401); }

        return view('admin.company.show', [
            'company'=>$company,
            'page_title'=> ucfirst($request->user()->LanguageId == 1 ? $company->name_en : $company->name_ar)
        ]);
    }



    public function applicationDatatable(Request $request, Company $company)
    {
        $requirements = $company->requirement()->get();
        $counter = 0;
        $array = [];

        return DataTables::of($requirements)
            ->addColumn('name',  function($companyRequirement) use ($request){
                if($companyRequirement->type == 'requirement'){
                    $name =  $request->user()->LanguageId == 1 ? ucwords($companyRequirement->requirement->requirement_name) : ucwords($companyRequirement->requirement->requirement_name_ar);
                }
                else{
                    $name =  __('Other Upload');
                }


                return '<a href="'.asset('/storage/'.$companyRequirement->path).'" data-caption="'.ucfirst($name).'" data-fancybox="gallery"  data-fancybox>'.ucfirst($name).'</a>';
            })
            ->addColumn('requirement', function($companyRequirement) use ($request){
                if($companyRequirement->type == 'requirement'){
                    return $request->user()->LanguageId == 1 ? ucwords($companyRequirement->requirement->requirement_name) : ucwords($companyRequirement->requirement->requirement_name_ar);
                }
                else{
                    $name =  __('Other Upload');
                }
                return $name;
            })
            ->editColumn('issued_date', function($companyRequirement){
                return $companyRequirement->issued_date ? date('d-F-Y', strtotime($companyRequirement->issued_date)) : '-';
            })
            ->editColumn('expired_date', function($companyRequirement){
                return $companyRequirement->expired_date ? date('d-F-Y', strtotime($companyRequirement->expired_date)) : '-';
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function artistpermitDatatable(Request $request, Company $company)
    {
        $permit = $company->permit()->orderBy('expired_date', 'desc')->get();
        $user = $request->user()->LanguageId;

        return DataTables::of($permit)
            ->addColumn('artist_number', function($permit){
                $total = $permit->artistPermit()->count();
                $approved = $permit->artistPermit()->where('artist_permit_status', 'approved')->count();
                return $approved.' approved of '.$total;
            })
            ->addColumn('location', function($permit) use ($user){
                return ucfirst($permit->location);
            })
            ->addColumn('status', function($permit){
                return ucfirst(permitStatus($permit->permit_status));
            })
            ->addColumn('link', function($permit){
                return URL::signedRoute('admin.artist_permit.show', ['permit' => $permit->permit_id]);
            })
            ->addColumn('duration', function($permit){
                $date = Carbon::parse($permit->expired_date)->diffInDays($permit->issued_date);
                $date = $date !=  0 ? $date : 1;
                $day = $date > 1 ? ' Days': ' Day';
                return $date.$day;
            })
            ->addColumn('term', function($permit){
                return ucfirst($permit->term);
            })
            ->addColumn('request_type', function($permit){
                return ucfirst($permit->request_type);
            })
            ->editColumn('issued_date', function($permit){
                return $permit->issued_date->format('d-F-Y');
            })
            ->editColumn('expired_date', function($permit){
                return $permit->expired_date->format('d-F-Y');
            })
            ->addColumn('has_event', function($permit){
                return $permit->event()->exists() ? 'YES' : 'NO';
            })
            ->rawColumns(['status'])
            ->make(true);
    }


    public function artistDatatable(Request $request, Company $company)
    {
        // $artist = Artist::whereHas('permit.owner.company', function($q) use ($company){
        //    return $q->where('company_id', $company->company_id);
        // })->get();

        return DataTables::of($company->artists)
            ->editColumn('person_code', function($artist){
                return $artist->person_code;
            })
            ->editColumn('artist_status', function($artist){
                return permitStatus($artist->artist_status);
            })
            ->addColumn('address', function($artist){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return ucfirst($artist_permit->address);
            })
            ->addColumn('name', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();

                return profileName($artist_permit->name, $artist_permit->gender->name);
            })
            ->addColumn('nationality', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return ucfirst($artist_permit->country->name);

            })
            ->addColumn('mobile_number', function($artist){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->mobile_number;

            })
            ->addColumn('email', function($artist){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->email;

            })
            ->addColumn('birthdate', function($artist){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->birthdate->format('d-F-Y');
            })
            ->addColumn('age', function($artist){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->birthdate->age;
            })
            ->addColumn('visa_type', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                if (!$artist_permit->visatype()->exists()) { return '-'; }
                return ucfirst($artist_permit->visatype->name);
            })
            ->addColumn('religion', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                if ( $artist_permit->religion()->exists() ) {
                    return ucfirst($artist_permit->religion->name);
                }
                return '-';

            })
            ->addColumn('visa_number', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->visa_number ? $artist_permit->visa_number : '-';
            })
            ->addColumn('visa_expiry', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->visa_expire_date ? $artist_permit->visa_expire_date->format('d-F-Y') : '-';
            })
            ->addColumn('passport_number', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->passport_number ? $artist_permit->passport_number : '-';
            })
            ->addColumn('passport_expire', function($artist) use ($request){
                $artist_permit = $artist->artistpermit()->latest()->first();
                return $artist_permit->passport_expire_date ? $artist_permit->passport_expire_date->format('d-F-Y') : '-';
            })
            ->addColumn('link', function($artist){
                return URL::signedRoute('admin.artist.show', ['artist' => $artist->artist_id]);
            })
            ->rawColumns(['artist_status', 'name'])
            ->make(true);
    }



    public function eventDatatable(Request $request, Company $company)
    {
        $events = $company->event()->orderBy('issued_date', 'desc')->get();
        return DataTables::of($events)
            ->addColumn('profile', function($event) use ($request){
                $type = null;
                if (!is_null($event->type)) {
                    $type = $request->user()->LanguageId == 1 ? ucfirst($event->type->name_en) : $event->type->name_ar;
                }
                $name = $request->user()->LanguageId == 1 ? ucfirst($event->name_en) : $event->name_ar;

                return ucfirst($event->name);
            })
            ->addColumn('event_type', function($event){
                $sub = !empty($event->subtype->subname) ? $event->subtype->subname : '-';
                return type($event->type->name, $sub);
            })
            ->addColumn('duration', function($event){
                // return duration($event->issued_date, $event->expired_date);
            })
            ->editColumn('status', function($event){
                return permitStatus($event->status);
            })
            ->editColumn('issued_date', function($event){
                return date('d-F-Y', strtotime($event->issued_date));
            })
            ->editColumn('expired_date', function($event){
                return date('d-F-Y', strtotime($event->expired_date));
            })
            ->addColumn('venue', function($event) use ($request){
                return ucfirst($event->venue);
            })
            ->addColumn('time', function($event){
                return $event->time_start.' - '.$event->time_end;
            })
            ->addColumn('truck', function($event){
                return $event->truck->count() ? $event->truck()->count() : 0;
            })
            ->addColumn('liquor', function($event){
                return $event->liquor()->count() ? 'YES' : 'NO';
            })
            ->addColumn('artist', function($event){
                return $event->permit()->count() ? $event->permit->artistpermit()->count() : 0;
            })
            ->addColumn('link', function($event){
                return URL::signedRoute('admin.event.show', ['event' => $event->event_id]);
            })
            ->editColumn('firm', function($event){
                return ucfirst($event->firm);
            })
            ->rawColumns(['profile', 'status', 'event_type'])
            ->make(true);

    }



    public function dataTable(Request $request)
    {
        $company = Company::when($request->status, function($q) use ($request){
            $q->whereIn('status', $request->status);
        })
            ->when($request->type, function($q) use ($request){
                $q->where('company_type_id', $request->type);
            })
            ->when($request->area, function($q) use ($request){
                $q->where('area_id', $request->area);
            })
            ->orderBy('updated_at', 'desc')
            ->orderBy('name_en')
            ->get();

        // ->latest();

        return DataTables::of($company)
            ->addColumn('trade_expired_date', function($company){
                // if ($company->type->name_en == 'corporate') {
                // return '<span class="text-underline" title="'.$company->trade_license_expired_date->format('l, d-F-Y').'">'.humanDate($company->trade_license_expired_date).'</span>';
                // }
                return '-';
            })
            ->addColumn('profile', function($company) use ($request){

                // return profileName($company->name, $company->type->name);
            })
            ->addColumn('name', function($company) use ($request){
                return ucfirst($company->name);
            })
            ->addColumn('full_address', function($company) use ($request){
                return ucfirst($company->fullAddress);
            })
            ->addColumn('issued_date', function($company){
                return null;
            })
            ->addColumn('expired_date', function($company){
                return $company->trade_license_expired_date->format('d-F-Y');
            })
            ->editColumn('type', function($company) use ($request){
                return ucfirst($company->type->name);
            })
            ->editColumn('registered_date', function($company){
                if($company->registered_date){
                    return $company->registered_date->format('d-F-Y');
                }
                return '-';
            })
            ->editColumn('registered_by', function($company) use ($request){
                if(!is_null($company->registered_by)){
                    return  ucfirst($company->registeredBy->name);
                }
                return '-';

            })
            ->editColumn('request_type', function($company){
                return ucwords($company->request_type);
            })
            ->editColumn('status', function($company){
                return permitStatus($company->status);
            })
            ->addColumn('link', function($company){
                return URL::signedRoute('admin.company.show', ['company' => $company->company_id]);
            })
            ->addColumn('application_link', function($company){
                return URL::signedRoute('admin.company.application', ['company' => $company->company_id]);
            })
            ->addColumn('date', function($company){
                return '<span class="text-underline" title="'.$company->updated_at->format('h:i A, l | d-F-Y').'">'.humanDate($company->updated_at).'</span>';
            })
            ->addColumn('reason', function($company) use ($request){
                $comment = null;
                if ($company->comment()->exists()) {
                    $comment = $company->comment()->latest()->first();
                    $comment = ucfirst($comment->remarks);
                }
                return $comment;
            })
            ->rawColumns(['date', 'status', 'profile', 'trade_expired_date', 'request_type', 'status'])
            ->toJson();
    }
}
