<?php

namespace App\Http\Controllers\Company;

use DB;
use Auth;
use App\User;
use App\Company;
use App\Country;
use App\Emirates;
use App\CompanyType;
use App\Permit;
use App\ArtistTempData;
use function Sodium\compare;
use Validator;
use Carbon\Carbon;
use App\CompanyRequirement;
use App\CompanyOtherUpload;
use App\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
   public function create()
   {
      return view('permits.company.create');
   }

   public function account(Request $request, Company $company)
   {
       return view('permits.company.account', ['company'=>$company]);
   }
   public function show(Request $request ,Company $company)
   {
      Permit::where('created_by', Auth::user()->user_id)->update(['is_edit' => 0]);
      ArtistTempData::where('created_by', Auth::user()->user_id )->where('status' , 0)->delete();
      Permit::whereDate('expired_date', '<', Carbon::now())->update(['permit_status' => 'expired']);

      return view('permits.company.show', ['company'=>$company]);
   }


   public function store(Request $request)
   {
       $valid_company = Validator::make($request->all(), [
         'name_en'=> 'required|max:255',
         'trade_license'=> 'required|max:255',
         'trade_license_expired_date'=> 'required|max:255|date|after_or_equal:'.Carbon::now(),
         'address'=> 'required|max:255',
         'area_id'=> 'required|max:255',
         'term_condition' => 'required'
       ]
     )->validate();

       $valid_user = Validator::make($request->all(), [
           'NameEn'=>'required:max:255',
           'username'=>'required:max:255',
           'mobile_number'=>'required:max:255',
           'password'=>'required:max:255',
       ]);


      try {
         DB::beginTransaction();

         $valid_company['company_type_id'] = CompanyType::where('name_en', 'corporate')->first()->company_type_id;
         $company = Company::create(array_merge($valid_company, ['status'=>'draft', 'request_type'=>'new registration'], $this->addressRelated() ));
         $user = $company->user()->create(array_merge(
             $request->all(), ['IsActive'=> 0, 'type'=> 1, 'password'=> bcrypt($request->password)
             ])
         );
         $user->roles()->attach(2);
         $user->sendEmailVerificationNotification();

         DB::commit();
         Auth::login($user);
         $result = ['success', 'Successfully Registered.', 'Success'];
         return redirect(URL::signedRoute('company.edit', ['company' => $company->company_id]))->with('message', $result);
         
       
      } catch (Exception $e) {

         DB::rollBack();
         return redirect()->back()->with('error', $e->getMessage());
      }
   }

   public function edit(Request $request, Company $company)
   {
      foreach ($company->requirement()->whereNull('is_submit')->get() as $requirement) {
          Storage::delete('public/'.$requirement->path);
      }
       
       $company->requirement()->whereNull('is_submit')->delete();

       return view('permits.company.edit', [
        'company'=>$company, 
        'invalid'=> $this->hasRequirement($company),
      ]); 
   }

   public function updateUser(Request $request, Company $company) {
      try {
        DB::beginTransaction();
        $company->user()->update([
            'NameAr' => $request->acccount_name_ar,
            'NameEn' => $request->acccount_name_en,
            'email' => $request->account_email,
            'mobile_number' => $request->account_mobile
        ]);
        
        DB::commit();
        $result = ['success', 'Update Successfully', 'Success'];
      } catch (Exception $e) {
        DB::rollBack();
        $result = ['danger', $e->getMessage(), 'Error'];
      }

      return redirect(URL::signedRoute('company.edit', $company->company_id).'#user-profile')->with(['message'=> $result]);
   }

   public function changePassword(Request $request, Company $company) {
      $old_password = $request->old_password;
      $new_password = $request->new_password ;
      $confirm_password = $request->confirm_password ;

      try {
        DB::beginTransaction();
        if($new_password == $confirm_password){
          $newpassword = Hash::make($request->new_password);
          User::where('user_id', Auth::user()->user_id)->update([
            'password' => $newpassword
          ]);
        }
        DB::commit();
        $result = ['success', 'Password Changed Successfully', 'Success'];
      } catch (Exception $e) {
        DB::rollBack();
        $result = ['danger', $e->getMessage(), 'Error'];
      }

      return redirect()->back()->with(['message'=> $result]);
   }


   private function hasRequirement($company)
   {
    $requirements = Requirement::where('requirement_type', 'company')->whereStatus('1')->get();
    $array = [];
    $data = null;
    if (!is_null($requirements)) {
      foreach ($requirements as $requirement) {
        array_push($array, $company->requirement()->where('requirement_id', $requirement->requirement_id)->exists());
      }
    }
    return in_array(false, $array);
   }



   public function update(Request $request, Company $company)
   {
    if ($company->status == 'rejected') {
      return redirect()->back();
    }
    if ($this->hasRequirement($company) && $request->submit != 'draft') {
      return redirect()->back()->with('message', ['danger', 'Please Upload all the Documents needed', 'Error']);
    }
       $validate = Validator::make($request->all(), [
               'name_en'=> 'required|max:255',
               'name_ar'=> 'required|max:255',
               'trade_license'=> 'required|max:255',
               'trade_license_expired_date'=> 'required|max:255|date',
               'company_email'=> 'required|max:255|email',
               'phone_number'=> 'required|max:255',
               'address'=> 'required|max:255',
               'area_id'=> 'required|max:255',
               'company_description_en'=> 'required|max:255',
               'company_description_ar'=> 'required|max:255',
               'contact_name_en'=> 'required|max:255',
               'contact_name_ar'=> 'required|max:255',
               'designation_en'=> 'required|max:255',
               'designation_ar'=> 'required|max:255',
               'mobile_number'=> 'required|max:255',
               'emirate_identification'=> 'required|max:255',
               'emirate_id_expired_date'=> 'required|max:255',
               'submit'=> 'required|max:255',
           ]
       )->validate();

      try {
         DB::beginTransaction();
          $company->requirement()->update(['is_submit'=>1]);
          switch ($request->submit){
              case 'submitted':
                  //new registration
                  if ($company->request_type == 'new registration' && $company->status == 'draft'){
                      $company->update(array_merge(
                          $request->all(),
                          [
                              'reference_number'=> empty($company->reference_number) ?  $this->getReferenceNumber($company) : $company->reference_number,
                              'status'=> 'new',
                              'application_date'=> empty($company->application_date ) ? Carbon::now() : $company->application_date
                          ],
                          $this->addressRelated()
                      ));
                      $company->request()->create(['type'=>'new registration', 'user_id'=>$request->user()->user_id]);
                  }

                  //bounce back
                if ($company->request_type == 'new registration' && $company->status == 'back'){
                    $company->update(array_merge($request->all(), ['status'=>'pending', 'request_type'=>'amendment request']));
                    $company->request()->create(['type'=>'bounced back request', 'user_id'=>$request->user()->user_id]);
                }

                //renew
                if ($company->request_type == 'new registration' && $company->status == 'back'){
                    $company->update(array_merge($request->all(), ['status'=>'pending', 'request_type'=>'renew trade license request']));
                    $company->request()->create(['type'=>'renew trade license request', 'user_id'=>$request->user()->user_id]);
                }





//                  dd($company);

                  $result = ['success', 'Successfully submitted!', 'Success'];
                  break;
              case 'draft':
                  $company->update($request->all());
                 $result = ['success', 'Draft saved!', 'Success'];
                  break;
          }




         switch ($request->submit) {
           case 'draft':

             break;
          case 'submitted':


            break;
         }


         if($company->contact()->exists()){
             $company->contact()->update([
                 'contact_name_en'=>$request->contact_name_en,
                 'contact_name_ar'=>$request->contact_name_ar,
                 'designation_en'=>$request->designation_en,
                 'designation_ar'=>$request->designation_ar,
                 'emirate_id_expired_date'=> date('Y-m-d', strtotime($request->emirate_id_expired_date)),
                 'emirate_id_issued_date'=> date('Y-m-d', strtotime($request->emirate_id_issued_date)),
                 'emirate_identification'=>$request->emirate_identification,
                 'email'=>$request->email,
                 'mobile_number'=>$request->mobile_number,
                 ]);
         }  
         else{
          
             $company->contact()->create($request->all());
         }


         DB::commit();
         return redirect(URL::signedRoute('company.show', $company->company_id))->with('message', $result);
      } catch (Exception $e) {
         DB::rollBack();
         $result = ['danger', $e->getMessage(), 'Error'];
          return redirect()->back()->with('message', $result);  
      }

       
   }


   public function deleteFile(Request $request, Company $company)
   {
      if (Storage::delete('public/'.$request->path)) {
        $company->requirement()->where('company_requirement_id', $request->company_requirement_id)->delete();
      };

   }



   public function upload(Request $request, Company $company)
   {
    try {
      DB::beginTransaction();

      $path = 'public/company/'.$company->company_id;
      $requirement_name = explode(' ', $request->requirement_name);
      $requirement_name = strtolower(implode('_', $requirement_name));

     

      if($request->requirement_id == 'other upload'){
        // $company->requirement()->whereType('other')->delete();
        $other = CompanyOtherUpload::first();


        if ($request->files) {

           foreach ($request->files as $upload) {
             foreach ($upload as $page_number => $file) {
                 $filename = $other->name_en.'_'.($page_number+1).'_'.time().'.'.$file->getClientOriginalExtension();


                 Storage::putFileAs($path, $file, $filename);

                 $request['path'] = 'company/'.$company->company_id.'/'.$filename;
                 $request['type'] = 'other';
                  $request['file_type'] = $file->getClientMimeType();
                 $request['requirement_id'] = 1;
                 $request['page_number'] = $page_number+1;
//                 $request['issued_date'] = $request->issued_date ? Carbon::parse($request->issued_date)->format('Y-m-d') :  null;
//                 $request['expired_date'] = $request->expired_date ? Carbon::parse($request->expired_date)->format('Y-m-d') :  null;
                   $company->requirement()->create($request->all());   
             }

           }
        }
      }
      else{

        //remove file if exists.
       if ($company->whereHas('requirement', function($q) use ($request){
           $q->where('requirement_id', $request->requirement_id);
         })->exists()) {
          // $company->requirement()->where('requirement_id', $request->requirement_id)->delete();
        }

        if ($request->files) {

           foreach ($request->files as $upload) {
             foreach ($upload as $page_number => $file) {
                 $filename = $requirement_name.'_'.($page_number+1).'_'.time().'.'.$file->getClientOriginalExtension();

                 Storage::putFileAs($path, $file, $filename);

                 $request['path'] = 'company/'.$company->company_id.'/'.$filename;
                 $request['type'] = 'requirement';
                 $request['file_type'] = $file->getClientMimeType();
                 $request['page_number'] = $page_number+1;
//                 $request['issued_date'] = $request->issued_date ? Carbon::parse($request->issued_date)->format('Y-m-d') :  null;
//                 $request['expired_date'] = $request->expired_date ? Carbon::parse($request->expired_date)->format('Y-m-d') :  null;
                 if($request->requirement_id != 'other upload'){
                   $company->requirement()->create($request->all());
                 }
                 else{
                   // $company->requirement()->create([]);
                 }
                 
             }

           }
        }
         
      }

      
      DB::commit();
      $result = ['success', '', 'Success'];
    } catch (Exception $e) {
      DB::rollBack();
     $result = ['danger', $e->getMessage(), 'Error'];
    }
    return response()->json(['message'=> $result]);
      
   }

   public function uploadedDatatable(Request $request, Company $company)
   {
      $user = $request->user()->LanguageId;
      $requirement = Requirement::has('company')->where('requirement_type', 'company')->count();

      return DataTables::of($company->requirement()->get())
      ->addColumn('name', function($upload) use ($user){
        if($upload->type == 'requirement'){
            $name =  $user == 1 ? ucwords($upload->requirement->requirement_name) : ucwords($upload->requirement->requirement_name_ar);
        }
        else{
          $name =  __('Other Upload');
        }
        return $name;
      })->editColumn('issued_date', function($data){
        return; 
      })->editColumn('expired_date', function($data){
      //  return $data->expired_date ? $data->expired_date->format('d-F-Y') : '-'; 
      return ;
      })->addColumn('file', function($data){
        if ($data->type == 'requirement') {
          $name = $data->requirement->requirement_name;
        }
        else{
          $name = __('Other Upload');
        }
        $html = '<a href="'.asset('/storage/'.$data->path).'"data-fancybox data-fancybox data-caption="'.$name.'">';
        $html .= $name;
        $html .= '</a>';
        return $html;
      })
      ->addColumn('count', function($data) use ($requirement){
        return $requirement.'  PAGE';
      })
      ->addColumn('action', function($data) use ($company){
        if(in_array($company->status, ['active', 'blocked'])){ return __('Delete not allowed'); }
        return '<button type="button" class="btn btn-sm btn-remove btn-secondary">'.__('REMOVE').'</button>';
      })
      ->rawColumns(['file', 'action'])
      ->make(true);
   }
   


   public function isexist(Request $request)
   {
      if($request->username){
         $result =  User::where('username', $request->username)->exists() ?  false : true;
      }
      if($request->email){
         $result =  User::where('email', $request->email)->exists() ?  false : true;
      }

      if($request->mobile_number){
         $result =  User::where('mobile_number', $request->mobile_number)->exists() ?  false : true;
      }

      if($request->name_en){
         $result =  Company::where('name_en', $request->name_en)
         ->where('status', '!=', 'rejected')
         ->exists() ?  false : true;
      }

      if($request->name_ar){
         $result =  Company::where('name_en', $request->name_ar)
         ->where('status', '!=', 'rejected')
         ->exists() ?  false : true;
      }

      if($request->trade_license){
         $result =  Company::where('trade_license', $request->trade_license)
         ->where('status', '!=', 'rejected')
         ->exists() ?  false : true;
      }

      return response()->json(['valid'=>$result]);
   }

   public function commentDatatable(Request $request, Company $company)
   {
    return DataTables::of($company->comment()->latest())
   
    ->addColumn('remark', function($comment) use ($request){
      return $request->user()->LanguageId == 1 ? ucfirst($comment->comment_en) : $comment->comment_ar; 
    })
    ->editColumn('action', function($comment){
      return ucfirst($comment->action);
    })
    ->addColumn('date', function($comment){
      return '<span class="text-underline"  title="'.$comment->created_at->format('l | h:i A, d-F-Y ').'">'.humanDate($comment->created_at).'</span>';
    })
    ->rawColumns(['date'])
    ->make(true);
   }



   public function requirements(Request $request)
   {
      $requirement = Requirement::where('requirement_type', 'company')
        ->whereStatus(1)
        ->orderBy('requirement_name')
        ->get()
        ->map(function($v){
        return [
            'requirement_name'=> ucfirst($v->requirement_name),
            'requirement_id'=> $v->requirement_id,
            'dates_required'=> $v->dates_required,
          ];
      });

      return response()->json($requirement->all());
   }

   private function addressRelated()
   {
    return [
      'emirate_id'=>Emirates::where('name_en' ,'Ras Al Khaimah')->first()->id,
      'country_id'=>Country::where('name_en' ,'United Arab Emirates')->first()->country_id,
      'company_type_id'=>CompanyType::where('name_en' ,'corporate')->first()->company_type_id,
    ];
   }

   private function getReferenceNumber($company)
   {
    if (Company::exists()) {
         $last_reference = Company::where('company_id', '!=', $company->company_id)
         ->where('status', '!=', 'draft')->orderBy('company_id', 'desc')
         ->first()->reference_number;
         
         $reference_number = explode('-', $last_reference);
         $reference_number = $reference_number[2]+1 ;
         $reference_number = 'EST-'.date('Y').'-'.str_pad($reference_number, 4, 0, STR_PAD_LEFT);
       }
       else{
        $reference_number = 'EST-'.date('Y').'-0001';
       }
       return $reference_number;
   }



}
