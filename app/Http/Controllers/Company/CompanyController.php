<?php

namespace App\Http\Controllers\Company;

use App\Company;
use App\User;
use Illuminate\Http\Request;
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
      $company = Company::create(array_merge($request->all(), ['status'=>'draft']));
      $request['password'] = Hash::make($request->password);
      if ($user = $company->user()->create(array_merge($request->all(), ['IsActive'=> 0]))) {
         return redirect()->back()->with('success', 'Your RAKTDA account has been made, please verify it by clicking the activation link that has send to'.$user->email);
      }
      else{
         return redirect()->back()->with('error', 'Your RAKTDA account has been made, please verify it by clicking the activation link that has send to '.$user->email);
      }
   }

   public function edit(Request $request, Company $company)
   {
       return view('permits.company.edit', ['company'=>$company]); 
   }

   public function isexist(Request $request)
   {
      if($request->username){
         $result =  User::where('username', $request->username)->exists() ?  true : false;
      }
      if($request->email){
         $result =  User::where('email', $request->email)->exists() ?  true : false;
      }

      return response()->json(['valid'=>$result]);
   }
}
