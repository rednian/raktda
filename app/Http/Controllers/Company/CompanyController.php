<?php

namespace App\Http\Controllers\Company;

use DB;
use Auth;
use App\User;
use App\Company;
use Carbon\Carbon;
use App\CompanyRequirement;
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
      try {
         DB::beginTransaction();
         // dd($request->all);
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
          Storage::delete('/public/'.$requirement->path);
      }
      // $company->requirement()->whereNull('is_submit')->delete();
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
        $result = ['success', 'Password Changed Successfully', 'Success'];
      } catch (Exception $e) {
        DB::rollBack();
        $result = ['danger', $e->getMessage(), 'Error'];
      }

      return redirect()->back()->with(['message'=> $result]);
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
               $last_reference = Company::where('company_id', '!=', $company->company_id)->orderBy('company_id', 'desc')->first()->reference_number;
               $reference_number = explode('-', $last_reference);
               // dd($reference_number);
               $reference_number = $reference_number[2]+1 ;
               $reference_number = 'EST-'.date('Y').'-'.str_pad($reference_number, 6, 0, STR_PAD_LEFT);
             }
             else{
              $reference_number = 'EST-'.date('Y').'-00001';
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
    $company->requirement()->where('company_requirement_id', $request->company_requirement_id)->delete();

   }



   public function upload(Request $request, Company $company)
   {
    try {
      DB::beginTransaction();

      $path = 'public/'.$company->company_id;
      $requirement_name = explode(' ', $request->requirement_name);
      $requirement_name = strtolower(implode('_', $requirement_name));

       //remove file if exists.
      if ($company->whereHas('requirement', function($q) use ($request){
          $q->where('requirement_id', $request->requirement_id);
        })->exists()) {
         $company->requirement()->where('requirement_id', $request->requirement_id)->delete();
       }

       if ($request->files) {

          foreach ($request->files as $upload) {
            foreach ($upload as $page_number => $file) {
                $filename = $requirement_name.'_'.($page_number+1).'.'.$file->getClientOriginalExtension();

                Storage::putFileAs($path, $file, $filename);

                $request['path'] = $company->company_id.'/'.$filename;
                $request['page_number'] = $page_number+1;
                if($request->requirement_id != 'other upload'){
                  $company->requirement()->create($request->all());
                }
                else{
                  // $company->requirement()->create([]);
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
      ->addColumn('name', function($data) use ($user){
        return $user == 1 ? ucfirst($data->requirement->requirement_name) : $data->requirement->requirement_name_ar;
      })
      ->editColumn('issued_date', function($data){
        return '';
      })
      ->editColumn('expired_date', function($data){
       return '';
      })
      ->addColumn('file', function($data){
        $html = '<a href="'.asset('/storage/'.$data->path).'"data-fancybox data-fancybox data-caption="'.$data->requirement->requirement_name.'">';
        $html .= $data->requirement->requirement_name.'_'.$data->page_number;
        $html .= '</a>';
        return $html;
      })
      ->addColumn('count', function($data) use ($requirement){
        return $requirement.'  PAGE';
      })
      ->addColumn('action', function($data){
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
