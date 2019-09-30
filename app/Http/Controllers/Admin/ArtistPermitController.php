<?php
namespace App\Http\Controllers\Admin;
use DB;
use Auth;
use DataTables;
use Carbon\Carbon;
use CountryState;

use App\Artist;
use App\Permit;
use App\Roles;
use App\Company;
use App\ArtistPermit;
use App\Procedure;
use App\ApproverProcedure;
use App\PermitComment;
use App\ArtistPermitDocument;
use App\ArtistPermitComment;
use function foo\func;
use Illuminate\Http\Request;
use App\ArtistPermitCheck;
use App\ArtistPermitChecklist;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Cloner\Data;

class ArtistPermitController extends Controller
{
    public function index()
    {
	    return view('admin.artist_permit.index', [
            'page_title'=> 'Artist Permit Dashboard',
            'breadcrumb'=> 'admin.artist_permit.index',
        ]);
    }

    public function show(Permit $permit)
    {
    	return view('admin.artist_permit.show', ['permit'=>$permit, 'page_title'=>$permit->reference_no]);
    }

    public function applicationDetails(Request $request, Permit $permit)
    {
      if(!$request->session()->has('user')){$request->session()->put('user', ['time_start'=> Carbon::now()]);}
        return view('admin.artist_permit.application-details', [
        	'page_title'=> 'artist permit details',
          'permit'=>$permit,
//          'type'=>$request->type,
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

            if($request->action){
              $permit_status= null;
              $comment_type = null;
              $approver_status = null;

              if($request->action == 'approve'){ $approver_status = $permit_status = 'approved-unpaid'; $comment_type = 'client'; }
	            if($request->action == 'send_back'){ $approver_status = $permit_status = 'modification request'; $comment_type = 'client'; }
	            if($request->action == 'rejected'){ $approver_status = $permit_status = 'rejected'; $comment_type = 'client'; }
	            if($request->action == 'approval'){ $approver_status = 'need approval'; $comment_type = 'staff'; }

	            $permit_approver = $permit->approver()->create([
		            'role_id'=>  $user->roles->where('NameEn', 'admin')->first()->role_id,
		            'user_id' => $user->user_id,
		            'time_start' => $user_time['time_start'],
		            'time_end' => Carbon::now(),
		            'status'=> $approver_status
	            ]);

	            if ($request->comment) {
		            $permit_comment = $permit->comment()->create($request->all());
		            $permit_comment->approverComment()->attach($permit_approver->permit_approver_id);
	            }

	            $permit->update(['permit_status'=>$permit_status , 'user_id'=>$user->user_id ]);

              if($request->role_id){
                foreach ($request->role_id as $role_id) {
                  $permit->approver()->create(['role_id'=>$role_id, 'status'=>'pending']);
                }
              }

            }
        DB::commit();
	      $result = ['success', ' Permit has been rejected successfully ', 'Success'];
      } catch (Exception $e) {
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
         $permit->update(['permit_status'=>'processing']);

//	      if($permit->artistPermit()->where('artist_permit_status', 'reject')->count()){
//
//	      }
         $artistpermit->update(['artist_permit_status'=>$request->artist_permit_status]);

         //delete the last checklist and replace with recent
	      $artistpermit->check()->where('artist_permit_id', $artistpermit->artist_permit_id)->delete();
         $artist_permit_check = $artistpermit->check()->create(['status'=>0]);

         if($request->comment){
	         $request['permit_id'] = $permit->permit_id;
	         $request['user_id'] = Auth::user()->user_id;
	         $request['type'] = 'client';
	         $comment = $permit->comment()->create($request->all());
	         $artist_permit_check->comment()->attach($comment->permit_comment_id,['artist_permit_id'=>$artistpermit->artist_permit_id]);
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

       return redirect()->route('admin.artist_permit.applicationdetails', $permit->permit_id)->with(['result'=>$result]);
    }

    public function checkApplication(Request $request,Permit $permit,  ArtistPermit $artistpermit)
    {
      $existing_permit = ArtistPermit::whereHas('permit', function($q) use ($permit){
        $q->where('permit_status', '!=', 'pending')
          ->where('permit_id', '!=', $permit->permit_id);
      })->where('artist_id', $artistpermit->artist_id)->get();

        return view('admin.artist_permit.check-application', [
        	'page_title'=>'check artist details',
          'permit'=>$permit, 
          'existing_permit'=>$existing_permit,
          'artist_permit'=>$artistpermit
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
	      if(strtolower($artist_permit_document->requirement->requirement_nam) == 'medical certificate'){ return 'Not Required';}
        return $artist_permit_document->expired_date->format('d-M-Y');
      })
      ->addColumn('name', function($artist_permit_document){
         return  $artist_permit_document->requirement->name_en;
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
			    	if(!$artist_permit->artist->country){ return null; }
			    	return ucwords($artist_permit->artist->country->nationality_en);
			    })
			    ->addColumn('age', function($artist_permit){
			    	return $artist_permit->artist->age;
			    })
			    ->addColumn('fullname', function($artist_permit){
			    	return ucwords($artist_permit->artist->fullname);
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
			    ->rawColumns(['artist_status', 'existing_permit'])
			    ->make(true);
        }       
    }

    public  function permitHistory(Request $request, Permit $permit)
    {
    	$permit = Permit::has('artist')->whereDate('created_at','<', $permit->created_at)
		    ->whereNotIn('permit_status', ['cancelled', 'draft','unprocessed'])
		    ->whereNotNull('permit_number')
		    ->where('permit_number',$permit->permit_number)
		    ->get();
    	return DataTables::of($permit)
		    ->addColumn('applied_date', function($permit){
		    	if(!$permit->created_date){ return null;}
		    	return $permit->created_date->format('d-m-Y h:m a');
		    })
		    ->editColumn('issued_date', function($permit){
		    	if(!$permit->issued_date){ return null;}
		    	return $permit->issued_date->format('d-m-Y');
		    })
		    ->editColumn('expired_date', function($permit){
		    	if(!$permit->expired_date){ return null;}
		    	return $permit->expired_date->format('d-m-Y');
		    })
		    ->addColumn('permit_status', function ($permit){
		    	return permitStatus($permit->permit_status);
		    })
		     ->addColumn('action', function ($permit){
		    	return '<a href="#" class="btn btn-sm btn-warning btn-elevate">Details</a>';
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
			    return $comments->user->employee->emp_name;
		    })
		    ->make(true);
    }

    public function dataTable(Request $request)
    {
     if($request->ajax()){
     	$limit = $request->length;
     	$start = $request->start;

         $permit = Permit::has('artist')
	          ->whereIn('permit_status', $request->status)
	         ->when($request->today, function($q) use ($request){
              $q->where('created_at', 'like', $request->today.'%');
         })
	         ->when($request->issued_date,function ($q) use ($request){
	         	$q->whereDate('issued_date', '<=', $request->issued_date);
	         })
	         ->when($request->request_type, function ($q) use ($request){
	         	$q->where('request_type', $request->request_type);
	         })
	         ->when($request->permit_status, function($q) use ($request){
	         	$q->where('permit_status', $request->permit_status);
	         })
	         ->when($request->permit_start, function ($q) use ($request){
	         	$date = explode('-', $request->permit_start);
	         	$q->whereBetween('issued_date', [ date('Y-m-d', strtotime($date[0])), date('Y-m-d', strtotime($date[1]))]);
	         })
	         ->orderBy('updated_at', 'DESC');

         $totalRecords = $permit->count();
         $permit = $permit->offset($start)->limit($limit);
         return Datatables::of($permit)
	         ->addColumn('artist_number', function($permit){
		         $total = $permit->artistpermit()->count();
		         $check = $permit->artistpermit()->where('artist_permit_status', '!=', 'unchecked')->count();
	         	return 'Checked '.$check.' of '.$total;
	         })
	         ->addColumn('permit_status', function($permit){
	         	return permitStatus($permit->permit_status);
	         })
	         ->editColumn('reference_number', function($permit){
                  return '<span class="kt-font-bold">'.$permit->reference_number.'</span>';
                 })
	         ->addColumn('applied_date', function($permit){
	         	if(!$permit->created_at) return null;
	         	return $permit->created_at->format('d-M-Y h:m a');
	         })
	         ->editColumn('permit_start', function($permit){
	         	if(!$permit->issued_date) return null;
	         	return $permit->issued_date->format('d-M-Y');
	         })
	         ->addColumn('company_name', function($permit){
	         	if($permit->company){
	         		return ucwords($permit->company->company_name);
	         	}
	         	return false;
	         })
	         ->addColumn('trade_license_number', function($permit){
	         	if($permit->company){
	         		return $permit->company->company_trade_license;
	         	}
	         	return false;
	         })
	         ->addColumn('company_type', function($permit){
		         $class_name = 'default';
		         if(strtolower($permit->company->company_type) == 'private'){$class_name = 'success'; }
		         if(strtolower($permit->company->company_type) == 'government'){$class_name = 'danger'; }
		         if(strtolower($permit->company->company_type) == 'individual'){$class_name = 'info'; }
		         return '<span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($permit->company->company_type).'</span>';
	         })
	         ->editColumn('request_type', function($permit){
	         	return ucwords($permit->request_type).' Application';
	         })
	         ->rawColumns(['request_type', 'reference_number', 'company_type', 'permit_status'])
	          ->setTotalRecords($totalRecords)
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
