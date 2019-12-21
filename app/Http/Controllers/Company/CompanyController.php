<?php

namespace App\Http\Controllers\Company;

use DB;
use App\User;
use App\Company;
use Carbon\Carbon;
use App\CompanyRequirement;
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
      try {
         DB::beginTransaction();
         $company = Company::create(array_merge($request->all(), ['status'=>'draft']));
         $request['password'] = Hash::make($request->password);
         $user = $company->user()->create(array_merge($request->all(), ['IsActive'=> 0, 'type'=> 1]));
         DB::commit();
         return redirect(URL::signedRoute('company.edit', ['company' => $company->company_id]));
      } catch (Exception $e) {
         DB::rollBack();
         return redirect()->back()->with('error', $e->getMessage());
      }
   }

   public function edit(Request $request, Company $company)
   {
       return view('permits.company.edit', ['company'=>$company]); 
   }

   public function update(Request $request, Company $company)
   {
      try {

         DB::beginTransaction();

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
             break;
          case 'submitted':


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
            // $company->reference_number = $this->generateTransactionCode();
            $company->status =  $company->application_date ? 'pending': 'new';
            $company->application_date = $company->application_date ? $company->application_date : Carbon::now();
            $company->save();

            break;
         }



         if($company->contact->exists()){
             $company->contact()->update([
                 'contact_name_en'=>$request->contact_name_en,
                 'contact_name_ar'=>$request->contact_name_ar,
                 'designation_en'=>$request->designation_en,
                 'designation_ar'=>$request->designation_ar,
                 'emirate_id_expired_date'=> date('Y-m-d', strtotime($request->emirate_id_expired_date)),
                 'emirate_id_issued_date'=>date('Y-m-d', strtotime($request->emirate_id_issued_date)),
                 'emirate_identication'=>$request->emirate_identication,
                 'email'=>$request->email,
                 'mobile_number'=>$request->mobile_number,
                 ]);
         }  
         else{
             $company->contact()->create($request->all());
         }



         // if ($request->has('file')) {
         //    $name = explode(' ', $company->name_en);
         //    $name = implode('_', $name);
         //    $path = 'public/'.$name;

         //    $company->requirement()->delete();
         //    Storage::deleteDirectory($path);
         //    foreach ($request->file as $requirement_id => $upload) {
         //          $requirement_name = explode(' ', $upload['name']);
         //          $requirement_name = strtolower(implode('_', $requirement_name));

         //       if (!empty($upload['file'])) {
         //       foreach ($upload['file'] as $index => $file) {
         //          $filename = $requirement_name.'_'.$index.'.'.$file->getClientOriginalExtension();
         //          Storage::putFileAs($path, $file, $filename);
         //          $company->requirement()->create([
         //             'page_number'=>$index+1, 
         //             'issued_date'=>$upload['issued_date'],
         //             'expired_date'=>$upload['expired_date'],
         //             'requirement_id'=>$requirement_id,
         //             'path'=>$path.'/'.$requirement_name.'_'.$index.'.'.$file->getClientOriginalExtension(),
         //          ]);

         //       }
         //       }
         
         //    }
         // }

         DB::commit();
      } catch (Exception $e) {
         DB::rollBack();
         $result = ['danger', $e->getMessage(), 'Error'];
      }

      return redirect()->back();
             
      
   }

   private function generateTransactionCode()
   {
    

    if (Company::exists()) {
      $reference_number = Company::latest()->first()->reference_number;

    }
    else{
     
    }

   }

   public function isexist(Request $request)
   {
      if($request->username){
         $result =  User::where('username', $request->username)->exists() ?  false : true;
      }
      if($request->email){
         $result =  User::where('email', $request->email)->exists() ?  false : true;
      }

      return response()->json(['valid'=>$result]);
   }

   public function requirementDatatable(Request $request, Company $company)
   {
    return DataTables::of($company->requirement()->get())->make(true);
   }
}
