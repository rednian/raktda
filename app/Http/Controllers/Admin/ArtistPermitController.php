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
use Illuminate\Http\Request;
use App\ArtistPermitCheck;
use App\ArtistPermitChecklist;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ArtistPermitController extends Controller
{

    public function index()
    {
        // $companies = ArtistPermit::dataTable()->where('permit_status', '!=', 'pending')->groupBy('permit.company_id')->get();
        return view('admin.artist_permit.index', [
            'page_title'=> 'Artist Permit Dashboard',
            'breadcrumb'=> 'admin.artist_permit.index',
            // 'companies' =>$companies
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

              if($request->action == 'approve'){
                  
                  $permit_approver = $permit->approver()->create([
                    'role_id'=>  $user->roles->where('NameEn', 'admin')->first()->role_id,
                    'user_id' => $user->user_id,
                    'time_start' => $user_time['time_start'],
                    'time_end' => Carbon::now(),
                    'status'=> 'processing'
                  ]);

                  $permit->update(['permit_status'=>'approved', 'user_d'=>$user->user_id ]);
                  if ($request->comment) {
                    $permit_comment = $permit->comment()->create($request->all());
                    $permit_comment->approverComment()->attach($permit_approver->permit_approver_id);
                  }


              }

              if($request->role_id){
                foreach ($request->role_id as $role_id) {
                  $permit->approver()-create([
                    'role_id'=>$role_id,
                    'status'=>'pending',

                  ]);
                }
              }
              if($request->action == 'send_back'){
                 $permit_status = 'edit';
                  $comment_type = 'client';
              }

              if($request->action == 'rejected'){
                  $permit->update(['permit_status'=>'rejected', 'user_d'=>$user->user_id ]);
                  if($request->comment){
                    $request['type'] = 'client';
                     $permit_comment = $permit->comment()->create($request->all());


                  }
              }

              // if($request->comment){

              //   $permit->comment()->create($request->all());
              // }

             



            }
        DB::commit();
      } catch (Exception $e) {
          DB::rollBack();
      }
    }


    public function artistChecklist(Request $request, Permit $permit, ArtistPermit $artistpermit)
    {
      try {
         DB::beginTransaction();
         $request['artist_permit_id'] = $artistpermit->artist_permit_id;
         $request['permit_id'] = $permit->permit_id;
         $request['status'] = 0; 
         $request['user_id'] = Auth::user()->user_id;

         $artist_permit_check = ArtistPermitCheck::create($request->all());
         if($request->comment){
           $request['type'] = 'client';
           $permit_comment = $permit->comment()->create($request->all());
           $artist_permit_check->comment()->attach($permit_comment->permit_comment_id,['artist_permit_id'=>$artistpermit->artist_permit_id]);
         }

         if($request->checklist){
           foreach ($request->checklist as $checklist) {
             $checklist['artist_permit_id'] = $artistpermit->artist_permit_id;
             $artist_permit_check->checklist()->create($checklist);
           }
         }

         DB::commit();
          $result = ['success', $artistpermit->artist->fullname.' successfully checked.', 'Success'];

      } catch (Exception $e) {
         DB::rollBack();
         $result = ['error', $e->getMessage(), 'Error'];
      }

       return response()->json(['message' => $result]);
    }

    public function checkApplication(Request $request,Permit $permit,  ArtistPermit $artistpermit)
    {
      $existing_permit = ArtistPermit::whereHas('permit', function($q) use ($permit){
        $q->where('permit_status', '!=', 'pending')
          ->where('permit_id', '!=', $permit->permit_id);
      })->where('artist_id', $artistpermit->artist_id)->get();

        return view('admin.artist_permit.check-application', [
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

        return ' <span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($status).'</span>';
      })
      ->rawColumns(['status'])
     ->make(true);
    }

    public function artistChecklistDocument(Request $request, Permit $permit,  ArtistPermit $artistpermit)
    {
      $artist_permit_document = $artistpermit->artistPermitDocument();

      $artist_permit_document =  Datatables::of($artist_permit_document)
      ->editColumn('document_name', function($artist_permit_document){
        $name = '<a href="'.asset('/storage/'.$artist_permit_document->path).'" data-fancybox data-fancybox data-caption="'.ucwords($artist_permit_document->document_name).'">';
        $name .= ucwords($artist_permit_document->document_name);
        $name .='</a>';
        return $name;
      })
      ->editColumn('issued_date', function($artist_permit_document){
        return $artist_permit_document->issued_date->format('d-M-Y');
      })
      ->editColumn('expired_date', function($artist_permit_document){
        return $artist_permit_document->expired_date->format('d-M-Y');
      })
      ->addColumn('action', function($artist_permit_document){
         $html = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">';
         $html .= '<input type="checkbox" data-check="checklist"  name="'.$artist_permit_document->document_name.'" >';
         $html .= '<span></span>';
         $html .= '</label>';

         return  $html;
      })
      ->rawColumns(['action', 'document_name'])
      ->make(true);
      $data = $artist_permit_document->getData(true);
      $data['data'][] = [
          'document_name' => '<a href="'.asset('/storage/'.$artistpermit->thumbnail).'" data-fancybox data-caption="'.ucwords($artistpermit->artist->fullname).' - Photo">Artist Photo</a>',
          'issued_date'=> 'Not Required',
          'expired_date'=> 'Not Required',
          'action'=> '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default"><input type="checkbox" data-check="checklist"  name="artist photo" ><span></span></label>'
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
    public function applicationDetails(Request $request, Permit $permit)
    {
      if(!$request->session()->has('user')){
          $request->session()->put('user', ['time_start'=> Carbon::now()]);
      }

        return view('admin.artist_permit.application-details', [
          'permit'=>$permit,
          'roles'=>Roles::where('type', 0)->get()
        ]);
    }

    public function applicationDataTable(Request $request, Permit $permit)
    {
        if($request->ajax()){
        
            $artist_permit = ArtistPermit::where('permit_id', $permit->permit_id)->get();


             return Datatables::of($artist_permit)
                     ->addColumn('visa_type', function($artist_permit){
                         return ucwords($artist_permit->artist->visa_type);
                     })
                     ->addColumn('request_type', function($artist_permit){
                         return $artist_permit->permit->request_type;
                      })
                    ->addColumn('nationality', function($artist_permit){
                        return ucwords($artist_permit->artist->nationality);
                     })
                      ->addColumn('type', function($artist_permit){
                          return ucwords($artist_permit->type);
                    })
                    ->addColumn('age', function($artist_permit){
                        return $artist_permit->artist->age;
                    })
                    ->addColumn('fullname', function($artist_permit){
                        return ucwords($artist_permit->artist->fullname);
                    })
                    ->addColumn('profession', function($artist_permit){
                        if(!$artist_permit->permitType){ return null; }
                        return ucwords($artist_permit->permitType->name_en);
                    })
                    ->addColumn('person_code', function($artist_permit){
                        return $artist_permit->artist->person_code;
                    })
                    ->editColumn('artist_status', function($artist_permit){
                     $class_name = 'default';
                     $status = $artist_permit->artist_permit_status;
                     if($artist_permit->artist_permit_status == 'pending'){ $class_name = 'info'; }
                     if($artist_permit->artist_permit_status == 'disapproved'){ $class_name = 'warning'; }
                     if($artist_permit->artist_permit_status == 'approved'){ $class_name = 'success'; }
                      
                      return ' <span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($artist_permit->artist_permit_status).'</span>';
                    })
                    ->addColumn('check', function($artist_permit){
                      return $artist_permit->check()->where('status', 0)->exists();
                    })
                    ->rawColumns(['artist_status', 'check'])
                    ->make(true);
        }       
    }

    public function dataTable(Request $request)
    { 
     if($request->ajax()){
         $permit = Permit::has('artistpermit')
         ->where('permit_status', $request->status)
         ->when($request->today, function($q) use ($request){
              $q->where('created_at', 'like', $request->today.'%');
         })
         ->orderBy('created_at', 'DESC');
         // ->get();

             
         return Datatables::of($permit)
                 ->editColumn('artist_number', function($permit){
                     return $permit->artist->count();
                 })
                 ->editColumn('reference_number', function($permit){
                  return '<span class="kt-font-bold">'.$permit->reference_number.'</span>';
                 })
                   ->editColumn('applied_date', function($permit){
                     if(!$permit->created_at) return null;
                     return $permit->created_at->format('d-M-Y');
                 })
                   ->editColumn('permit_start', function($permit){
                     if(!$permit->issued_date) return null;
                     return $permit->issued_date->format('d-M-Y');
                 })
                 ->editColumn('company_name', function($permit){
                     if($permit->company){
                          return ucwords($permit->company->company_name);
                     }
                     return false;
                  
               })

                   ->editColumn('trade_license_number', function($permit){
                       if($permit->company){
                            return $permit->company->company_trade_license;
                       }
                       return false;
                    
                 })
                 ->editColumn('request_type', function($permit){
                     if(strtolower($permit->request_type) == 'new'){
                          return '<span class="kt-badge kt-badge--info kt-badge--inline">'.ucwords($permit->request_type).'</span>';
                     }
                     if(strtolower($permit->request_type) == 'renew'){
                          return '<span class="kt-badge kt-badge--success kt-badge--inline">'.ucwords($permit->request_type).'</span>';
                     }
                     if(strtolower($permit->request_type) == 'cancel'){
                          return '<span class="kt-badge kt-badge--danger kt-badge--inline">'.ucwords($permit->request_type).'</span>';
                     }
                     if(strtolower($permit->request_type) == 'amend'){
                          return '<span class="kt-badge kt-badge--warning kt-badge--inline">'.ucwords($permit->request_type).'</span>';
                     }
                    
               })
               ->rawColumns(['request_type', 'reference_number'])
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
          return ucwords($artist_permit->permitType->name_en);
       })
       ->editColumn('nationality', function($artist_permit){
            return ucwords($artist_permit->artist->nationality);
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
         if(strtolower($artist_permit->artist->artist_status) == 'active'){
              return '<span class="kt-badge kt-badge--success kt-badge--inline">'.ucwords($artist_permit->artist->artist_status).'</span>';
         }
         if(strtolower($artist_permit->artist->artist_status) == 'block'){
              return '<span class="kt-badge kt-badge--danger kt-badge--inline">'.ucwords($artist_permit->artist->artist_status).'</span>';
         }
     })
      ->editColumn('check', function($artist_permit){
           $html ='<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">';
           $html .= '<input type="checkbox" >';
           $html .=   '<span></span>';
           $html .= '</label>';
           return $html;
     })
       ->editColumn('check', function($artist_permit){
            $html ='<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">';
            $html .= '<input type="checkbox" >';
            $html .=   '<span></span>';
            $html .= '</label>';
            return $html;
      })
      ->rawColumns(['artist_status', 'check'])
     ->make(true);
      }
    }
}
