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
use Yajra\DataTables\Facades\DataTables;

class ArtistPermitController extends Controller
{
    public function index(Request $request)
    {
      $permit = Permit::where('permit_status', 'active')->whereDate('expired_date', '<',Carbon::now()->format('Y-m-d'))->update(['permit_status'=>'expired']);

      $view = $request->user()->roles()->whereIn('roles.role_id', [4, 5])->exists() ? 'admin.artist_permit.inspector_index' : 'admin.artist_permit.index';

	    return view($view, [
            'page_title'=> 'Artist Permit Dashboard',
            'breadcrumb'=> 'admin.artist_permit.index',
            'professions'=>Profession::has('artistpermit')->get(),
            'countries'=> Country::has('artistpermit')->get(),
            'new_request'=> Permit::has('artist')->where('permit_status', 'new')->count(),
            'pending_request'=> Permit::has('artist')->where('permit_status', 'modified')->count(),
            'approved_permit'=> Permit::lastMonth(['active'])->count(),
            'rejected_permit'=> Permit::lastMonth(['rejected'])->count(),
            'cancelled_permit'=> Permit::lastMonth(['cancelled'])->count(),
            'active_permit'=> Permit::lastMonth(['active', 'approved-unpaid', 'rejected', 'expired', 'modification request'])->count()
        ]);
    }

    public function search(Request $request)
    {
      $permit = Permit::where('reference_number', 'like', $request->q.'%')->get();
        return response()->json($permit);
    }

    public function download(Permit $permit)
    {
      $data['company_details'] = $permit->owner->user_id;
      $data['artist_details'] = $permit->artistPermit()->with('artist', 'profession', 'nationality')->get();
      $data['permit_details'] = $permit;

      $permitNumber = $permit->permit_number;

      $pdf = PDF::loadView('permits.artist.permit_print', $data, [], [
          'title' => 'Artist Permit',
          'default_font_size' => 10
      ]);
      return $pdf->stream('Permit-' . $permitNumber . '.pdf');
    }

    public function show(Permit $permit)
    {
    	return view('admin.artist_permit.show', ['permit'=>$permit, 'page_title'=>$permit->reference_no]);
    }

    public function applicationDetails(Request $request, Permit $permit)
    {
        if(!$request->session()->has('user')){$request->session()->put('user', ['time_start'=> Carbon::now()]);}

        //UPDATE LOCK ARTIST PERMIT
        $permit->update([
          'lock' => Carbon::now(),
          'lock_user_id' => $request->user()->user_id
        ]);

        return view('admin.artist_permit.application-details', [
        	'page_title'=> 'artist permit details',
          'permit'=>$permit,
          'roles'=>Roles::where('type', 0)->get()
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
               break;
              case 'rejected';
                $request['type'] = 1;
                 $permit->comment()->create($request->all());
              break;
              case 'send_back':
                $request['type'] = 1;
                $request['action'] = 'modification request';
               $permit->comment()->create($request->all());
              break;
              case 'need approval':


              //ADD TO APPROVALS
              // $approval = $permit->getPermitApproval()->create([
              //   'type' => 'artist',
              //   'created_by' => $request->user()->user_id
              // ]);


              // if ($request->is_manual_schedule) {

                // $user = User::availableInspector($permit->issued_date)->first();



                // $approval->approver()->create(['user_id'=>$user->user_id]);
              // }




              // $approval = $permit->approval()->create(['type'=>'artist', 'inspection_id'=>$permit->permit_id, 'schedule_date'=>'']);


              // dd($user);

               $request['type'] = 1;

               $permit->comment()->create($request->all());
               if($request->role){
                foreach ($request->role as $role_id) {
                  $permit->comment()->create([
                    'action'=>'pending',
                    'role_id'=>$role_id,
                    'user_id'=> null,
                    'comment'=> null,
                  ]);
                }
               }
              break;
              //INSPECTOR AND MANAGER APPROVAL
              case 'checked':

                  $status = $user->roles()->first()->role_id == 4 ? 'inspector' : 'manager';

                  $comment = $permit->comment()->where([
                    'action' => 'pending',
                    'role_id' => $user->roles()->first()->role_id
                  ])->first();

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

                  //CHANGE THE STATUS THAT WILL IDENTIFY IF IT IS FROM INSPECTOR OR MANAGER
                  $request['action'] = 'checked-'.$status;

              break;

           }
             $permit->update(['permit_status'=>$request->action]);

        DB::commit();
	      $result = ['success', ' Permit has been rejected successfully ', 'Success'];
      } catch (\Exception $e) {
      	DB::rollBack();
	      $result = ['error', $e->getMessage(), 'Error'];
      }
	    return redirect()->route('admin.artist_permit.index')->with('message', $result);
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
         // $permit->update(['permit_status'=>'processing']);

//	      if($permit->artistPermit()->where('artist_permit_status', 'reject')->count()){
//
//	      }
//
         // dd($request->all());
         $artistpermit->update(['artist_permit_status'=>$request->artist_permit_status]);

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
         $result = ['error', $e->getMessage(), 'Error'];
      }

       return redirect()->route('admin.artist_permit.applicationdetails', $permit->permit_id)->with(['message'=>$result]);
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
      	if(strtolower($artist_permit_document->requirement->requirement_name)  == 'medical certificate'){ return 'Not Required';}
        return $artist_permit_document->issued_date->format('d-M-Y');
      })
      ->editColumn('expired_date', function($artist_permit_document){
	      if(strtolower($artist_permit_document->requirement->requirement_name) == 'medical certificate'){ return 'Not Required';}
        return $artist_permit_document->expired_date->format('d-M-Y');
      })
      ->addColumn('name', function($artist_permit_document){
         return  $artist_permit_document->requirement->requirement_name;
      })
      ->rawColumns(['action', 'document_name'])
      ->make(true);

      $data = $artist_permit_document->getData(true);

      $data['data'][] = [
          'document_name' => '<a href="'.asset('/storage/'.$artistpermit->thumbnail).'" data-fancybox data-caption="'.ucwords($artistpermit->artist->fullname).' - Photo">Artist Photo</a>',
          'issued_date'=> 'Not Required',
          'expired_date'=> 'Not Required',
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
    		$artist_permit = $permit->artistPermit()->orderBy('updated_at')->get();

    		return Datatables::of($artist_permit)
			    ->addColumn('nationality', function($artist_permit){
			    	if(!$artist_permit->country){ return null; }
			    	return ucwords($artist_permit->country->nationality_en);
			    })
			    ->addColumn('age', function($artist_permit){
			    	return $artist_permit->age;
			    })
			    ->addColumn('fullname', function($artist_permit){
			    	return ucwords($artist_permit->fullname);
			    })
			    ->addColumn('profession', function($artist_permit){
			    	if(!$artist_permit->profession){ return null; }
			    	return ucwords($artist_permit->profession->name_en);
			    })
			    ->addColumn('person_code', function($artist_permit){
			    	return $artist_permit->artist->person_code;
			    })
			    ->editColumn('artist_status', function($artist_permit){
			    	$class_name = 'default';
			    	$status = $artist_permit->artist_permit_status;
			    	if($artist_permit->artist_permit_status == 'unchecked'){ $class_name = 'warning'; }
			    	if($artist_permit->artist_permit_status == 'disapproved'){ $class_name = 'danger'; }
			    	if($artist_permit->artist_permit_status == 'approved'){ $class_name = 'success'; }
			    	return ' <span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($artist_permit->artist_permit_status).'</span>';
			    })
			    ->addColumn('is_allowed_multiple_permit', function($artist_permit){
			    	return $artist_permit->profession->is_multiple ? true : false;
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
            $html = '<button class="btn btn-secondary btn-sm btn-elevate btn-document kt-margin-r-5">Document <span class="kt-badge kt-badge--brand kt-badge--outline kt-badge--sm">'.($artist_permit->artistPermitDocument()->count()+1).'</span></button>';
            $html .= '<button class="btn btn-secondary btn-sm btn-elevate btn-comment-modal">Comment <span class="kt-badge kt-badge--brand kt-badge--outline kt-badge--sm">'.$artist_permit->comments()->count().'</span></button>';
            return $html;
          })
			    ->rawColumns(['artist_status', 'existing_permit', 'action'])
			    ->make(true);
        }
    }

    public  function permitHistory(Request $request, Permit $permit)
    {
      $permit_number = $permit->permit_number;
      if($permit->request_type == 'renew'){ $permit_number = explode('-', $permit_number); }

    	$permit = Permit::has('artist')
		    ->whereNotIn('permit_status', ['cancelled', 'draft','unprocessed'])
		    ->whereNotNull('permit_number')
		    ->where('permit_number','like', $permit_number[0].'%')
		    ->get();
    	return DataTables::of($permit)
		    ->addColumn('applied_date', function($permit){
		    	if(!$permit->created_at){ return null;}
		    	return $permit->created_at->format('d-M-Y');
		    })
		    ->editColumn('issued_date', function($permit){
		    	if(!$permit->issued_date){ return null;}
		    	return $permit->issued_date->format('d-M-Y');
		         })
		       ->editColumn('expired_date', function($permit){
		    	if(!$permit->expired_date){ return null;}
		    	return $permit->expired_date->format('d-M-Y');
		          })
               ->addColumn('artist_number', function($permit){
                return $permit->artist()->count();
                  })
		       ->addColumn('permit_status', function ($permit){
		    	return permitStatus($permit->permit_status);
		         })
		       ->addColumn('action', function ($permit){
		    	return '<a href="'.route('admin.artist_permit.show', $permit->permit_id).'" class="btn btn-sm btn-secondary btn-elevate">Details</a>';
		         })
		       ->rawColumns(['permit_status', 'action'])
		       ->make(true);
                 }

            public function applicationCommentDataTable(Request $request, Permit $permit, ArtistPermit $artistpermit)
             {
    	     $comments = $artistpermit->comments()->orderBy('created_at', 'desc')->get();
    	     return DataTables::of($comments)
		    ->addColumn('comment', function ($comments){
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
      ->when($request->request_type, function ($q) use ($request){
        $q->where('request_type', $request->request_type);
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
          $q->where('action', 'pending')->where('role_id', $request->user()->roles()->first()->role_id);
        });
      })
      ->latest();

      $table = Datatables::of($permit)
      ->addColumn('artist_number', function($permit){
        $total = $permit->artistpermit()->count();
        $check = $permit->artistpermit()->where('artist_permit_status', '!=', 'unchecked')->count();
        if($permit->permit_status == 'active' || $permit->permit_status == 'expired'){ return 'Active '.$check.' of '.$total; }
        return 'Checked '.$check.' of '.$total;
      })
        ->editColumn('permit_status', function($permit){ return permitStatus($permit->permit_status); })
	    ->editColumn('reference_number', function($permit){ return '<span class="kt-font-bold">'.$permit->reference_number.'</span>'; })
	    ->addColumn('applied_date', function($permit){
        return '<span class="text-underline" title="'.$permit->created_at->format('l d-M-Y h:i A').'">'.humanDate($permit->created_at).'</span>';
      })
      ->editColumn('permit_start', function($permit){
        if(!$permit->issued_date) return null;
        return $permit->issued_date->format('d-M-Y');
      })
      ->addColumn('company_name', function($permit) use ($request){
          return $request->user()->LanguageId == 1 ? ucfirst($permit->owner->company->name_en) : $permit->owner->company->name_ar;
      })
      ->addColumn('company_type', function($permit){
            return;
		         $class_name = 'default';
		         if(strtolower($permit->company->company_type) == 'private'){$class_name = 'success'; }
		         if(strtolower($permit->company->company_type) == 'government'){$class_name = 'danger'; }
		         if(strtolower($permit->company->company_type) == 'individual'){$class_name = 'info'; }
		         return '<span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($permit->company->company_type).'</span>';
	         })
	         ->editColumn('request_type', function($permit){
	         	return ucwords($permit->request_type).' Application';
	         })
           ->addColumn('action', function($permit){
            // $html = ' <div class="dropdown dropdown-inline">';
            // $html .= '   <button type="button" class="btn btn-secondary btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" >';
            // $html .= '     <i class="flaticon-more-1"></i>';
            // $html .= '     </button>';
            //       <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="http://raktda.test/event/1"><i class="la la-calendar-check-o"></i>Event Details</a>        <a class="dropdown-item" target="_blank" href="http://raktda.test/event/1/download"><i class="la la-download"></i>Download Permit</a>       <div class="dropdown-divider"></div>          <a href="javascript:void(0)" class="dropdown-item cancel-modal"><i class=" text-danger la la-minus-circle"></i> Cancel Permit</a>         </div>          </div>
            return '<button class="btn btn-outline-danger btn-sm kt-margin-r-5">' . __('Cancel') . '</button><a href="'.route('admin.artist_permit.download', $permit->permit_id).'" target="_blank" class="btn btn-download btn-sm btn-elevate btn-outline-success">' . __('Download') . '</a>';
           })
           ->addColumn('inspection_url', function($permit){
            return route('tasks.artist_permit.details', $permit->permit_id);
           })
	         ->rawColumns(['request_type', 'reference_number', 'company_type', 'permit_status', 'action' , 'applied_date'])
	         ->make(true);
           $table = $table->getData(true);
           $table['new_count'] = Permit::has('artist')->where('permit_status', 'new')->count();
           $table['pending_count'] = Permit::has('artist')->where('permit_status', 'modified')->count();
           $table['cancelled_count'] = Permit::has('artist')->where('permit_status', 'cancelled')->count();

           return response()->json($table);
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
