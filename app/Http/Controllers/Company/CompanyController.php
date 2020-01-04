<?php

namespace App\Http\Controllers\Company;

use DB;
use Auth;
use App\User;
use App\Company;
use Carbon\Carbon;
use App\CompanyRequirement;
use App\CompanyOtherUpload;
use App\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

   public function store(Request $request)
   {
    $valid_data = $request->validate([
     'name_en'=>'required|max:255',
     'trade_license'=> 'required|max:255',
     'trade_license_issued_date'=>'required|before_or_equal:'.Carbon::now().'',
     'trade_license_expired_date'=>'required|after:'.Carbon::now().'',
     'phone_number'=>'required|max:15',
     'company_email'=>'required|email:rfc,strict,dns,spoof,filter',
     'country_id'=>'required|integer',
     'emirate_id'=>'required|integer',
     'area_id'=>'required|integer',
     'address'=>'required',
     'NameEn'=>'required',
     'email'=>'required|email:rfc,strict,dns,spoof,filter',
     'mobile_number'=>'required|max:15',
     'username'=>'required|max:255|min:5',
     'g-recaptcha-response' => 'required|captcha',
     'term_condition' => 'required'
    ]);

      try {
         DB::beginTransaction();

         $company = Company::create(array_merge($request->all(), ['status'=>'draft']));
         $request['password'] = Hash::make($request->password);
         $user = $company->user()->create(array_merge($request->all(), ['IsActive'=> 0, 'type'=> 1]));
         DB::commit();
         return redirect(URL::signedRoute('company.edit', ['company' => $company->company_id]))
         ->with('success', 'Registration successful. Please login and verify your email.');
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
       return view('permits.company.edit', ['company'=>$company, 'page_title'=> '']); 
   }

   public function updateUser(Request $request, Company $company) {

     $acccount_name_en = $request->acccount_name_en;
     $acccount_name_ar = $request->acccount_name_ar;
     $account_username = $request->account_username ;
     $account_email = $request->account_email ;
     $account_mobile= $request->account_mobile ;

      try {
        DB::beginTransaction();

        User::where('user_id', Auth::user()->user_id)->update([
          'NameAr' => $acccount_name_ar,
          'NameEn' => $acccount_name_en,
          'username' => $account_username,
          'email' => $account_email,
          'mobile_number' => $account_mobile
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

   public function update(Request $request, Company $company)
   {
    if ($company->status == 'rejected') {
      return redirect()->back();
    }
      try {

         DB::beginTransaction();
          $company->requirement()->update(['is_submit'=>1]);

         if ($request->company_type_id == 1) {
           $request['trade_license'] = null;
           $request['trade_license_issued_date'] = null;
           $request['trade_license_expired_date'] = null;
         }
         else{
          $request['trade_license_issued_date'] =  date('Y-m-d', strtotime($request->trade_license_issued_date));
          $request['trade_license_expired_date'] = date('Y-m-d', strtotime($request->trade_license_expired_date));
         }

         switch ($request->submit) {
           case 'draft':
               $company->update($request->all());
                 $result = ['success', '', 'Success'];
             break;
          case 'submitted':


            if (Company::exists()) {
               $last_reference = Company::where('company_id', '!=', $company->company_id)->where('status', '!=', 'draft')->orderBy('company_id', 'desc')->first()->reference_number;
               $reference_number = explode('-', $last_reference);
               // dd($reference_number);
               $reference_number = $reference_number[2]+1 ;
               $reference_number = 'EST-'.date('Y').'-'.str_pad($reference_number, 4, 0, STR_PAD_LEFT);
             }
             else{
              $reference_number = 'EST-'.date('Y').'-0001';
             } 

            $company = Company::find($company->company_id);
            $company->company_type_id = $request->company_type_id;
            $company->company_email = $request->company_email;
            $company->phone_number = $request->phone_number;
            $company->website = $request->website;
            $company->address = $request->address;
            $company->country_id = $request->country_id;
            $company->emirate_id = $request->emirate_id;
            $company->area_id = $request->area_id;
            $company->trade_license = $request->trade_license;
            $company->trade_license_issued_date = $request->trade_license_issued_date;
            $company->trade_license_expired_date = $request->trade_license_expired_date;
            $company->company_description_en = $request->company_description_en;
            $company->company_description_ar = $request->company_description_ar;
            $company->name_en = $request->name_en;
            $company->name_ar = $request->name_ar;

            if (empty($company->reference_number)) {
            $company->reference_number = $reference_number;
            }

            $company->status =  $company->application_date ? 'pending': 'new';
            $company->application_date = $company->application_date ? $company->application_date : Carbon::now();
            $company->save();

            $result = ['success', '', 'Success'];

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
        $result = ['success', '', 'Success'];
      } catch (Exception $e) {
         DB::rollBack();
         $result = ['danger', $e->getMessage(), 'Error'];
      }

      return redirect()->back()->with('message', $result);    
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

      $path = 'public/'.$company->company_id;
      $requirement_name = explode(' ', $request->requirement_name);
      $requirement_name = strtolower(implode('_', $requirement_name));

     

      if($request->requirement_id == 'other upload'){
        // $company->requirement()->whereType('other')->delete();
        $other = CompanyOtherUpload::first();


        if ($request->files) {

           foreach ($request->files as $upload) {
             foreach ($upload as $page_number => $file) {
                 $filename = $other->name_en.'_'.($page_number+1).'.'.$file->getClientOriginalExtension();

                 Storage::putFileAs($path, $file, $filename);

                 $request['path'] = $company->company_id.'/'.$filename;
                 $request['type'] = 'other';
                  $request['file_type'] = $file->getClientMimeType();
                 $request['requirement_id'] = 1;
                 $request['page_number'] = $page_number+1;
                 $request['issued_date'] = $request->issued_date ? Carbon::parse($request->issued_date)->format('Y-m-d') :  null;
                 $request['expired_date'] = $request->expired_date ? Carbon::parse($request->expired_date)->format('Y-m-d') :  null;
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
                 $filename = $requirement_name.'_'.($page_number+1).'.'.$file->getClientOriginalExtension();

                 Storage::putFileAs($path, $file, $filename);

                 $request['path'] = $company->company_id.'/'.$filename;
                 $request['type'] = 'requirement';
                 $request['file_type'] = $file->getClientMimeType();
                 $request['page_number'] = $page_number+1;
                 $request['issued_date'] = $request->issued_date ? Carbon::parse($request->issued_date)->format('Y-m-d') :  null;
                 $request['expired_date'] = $request->expired_date ? Carbon::parse($request->expired_date)->format('Y-m-d') :  null;
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
      })
      ->editColumn('issued_date', function($data){
        return $data->issued_date ? $data->issued_date->format('d-F-Y') : '-'; 
      })
      ->editColumn('expired_date', function($data){
       return $data->expired_date ? $data->expired_date->format('d-F-Y') : '-'; 
      })
      ->addColumn('file', function($data){
        if ($data->type == 'requirement') {
          $name = $data->requirement->requirement_name;
        }
        else{
          $name = __('Other Upload');
        }
        $html = '<a href="'.asset('/storage/'.$data->path).'"data-fancybox data-fancybox data-caption="'.$name.'">';
        $html .= $name.'_'.$data->page_number;
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

      return response()->json(['valid'=>$result]);
   }


   public function requirements(Request $request)
   {
      $requirement = Requirement::where('requirement_type', 'company')->orderBy('requirement_name')->get();
      return response()->json($requirement);
   }
}
