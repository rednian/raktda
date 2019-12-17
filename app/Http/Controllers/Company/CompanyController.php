<?php

namespace App\Http\Controllers\Company;

use DB;
use App\User;
use App\Company;
use App\CompanyRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
         switch ($request->submit){
             case 'submit':

                 break;
             case 'draft':
                  $company->update($request->all());
                  if($company->contact->exists()){
                      $company->contact()->update([
                          'contact_name_en'=>$request->contact_name_en,
                          'contact_name_ar'=>$request->contact_name_ar,
                          'designation_en'=>$request->designation_en,
                          'designation_ar'=>$request->designation_ar,
                          'emirate_id_expired_date'=>$request->emirate_id_expired_date,
                          'emirate_id_issued_date'=>$request->emirate_id_issued_date,
                          'emirate_identication'=>$request->emirate_identication,
                          'email'=>$request->email,
                          'mobile_number'=>$request->mobile_number,
                          ]);
                  }
                  else{
                      $company->contact()->create($request->all());
                  }

                 break;
         }


         if ($request->has('file')) {
            $name = explode(' ', $company->name_en);
            $name = implode('_', $name);
            $path = 'public/'.$name;

            $company->requirement()->delete();
            Storage::deleteDirectory($path);
            foreach ($request->file as $requirement_id => $upload) {
                  $requirement_name = explode(' ', $upload['name']);
                  $requirement_name = strtolower(implode('_', $requirement_name));

               if (!empty($upload['file'])) {
               foreach ($upload['file'] as $index => $file) {
                  $filename = $requirement_name.'_'.$index.'.'.$file->getClientOriginalExtension();
                  Storage::putFileAs($path, $file, $filename);
                  $company->requirement()->create([
                     'page_number'=>$index+1, 
                     'issued_date'=>$upload['issued_date'],
                     'expired_date'=>$upload['expired_date'],
                     'requirement_id'=>$requirement_id,
                     'path'=>$path.'/'.$requirement_name.'_'.$index.'.'.$file->getClientOriginalExtension(),
                  ]);

               }
               }
         
            }
         }

         DB::commit();
               dd($request->all());
      } catch (Exception $e) {
         DB::rollBack();
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
}
