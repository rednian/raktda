<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
   public function index()
   {
      $new_company = Company::where('status', 'new')->count();

      return view('admin.company.index',[
         'page_title'=> 'Company',
         'new_company'=> Company::where('status', 'new')->count(),
         'approved'=> Company::where('status', 'active')->count(),
         'blocked'=> Company::where('status', 'blocked')->count(),
      ]);
   }

   public function submit(Request $request, Company $company)
   {
      dd($request->all());
      switch ($request->status) {
         case 'active':
            $company->update(['status'=>$request->status]);
            break;
         case 'need modification':
            $company->update(['status'=>$request->status]);
            break; 
         case 'rejected':
            $company->update(['status'=>$request->status]);
            break;
         // case 'need approval':
         //    $company->update(['status'=>$request->status]);
         //    break;
            
         
         default:
            # code...
            break;
      }
   }

   public function application(Request $request, Company $company)
   {
      return view('admin.company.application', [
         'company'=>$company,
         'page_title'=> ucfirst($request->user()->LanguageId == 1 ? $company->name_en : $company->name_ar).' | application'
      ]);
   }

   public function show(Request $request, Company $company)
   {
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
         return $request->user()->LanguageId == 1 ?  ucfirst($companyRequirement->requirement->requirement_name) : $companyRequirement->requirement->requirement_name_ar;
      })
      ->addColumn('count', function($companyRequirement) use ($array, $counter){
       
      })
      ->editColumn('issued_date', function($companyRequirement){
         return $companyRequirement->issued_date ? date('d-F-Y', strtotime($companyRequirement->issued_date)) : '-'; 
      })
       ->editColumn('expired_date', function($companyRequirement){
          return $companyRequirement->expired_date ? date('d-F-Y', strtotime($companyRequirement->expired_date)) : '-'; 
      })
      ->make(true);
   }


   public function dataTable(Request $request)
   {
      $company = Company::when($request->status, function($q) use ($request){
         $q->whereIn('status', $request->status);
      })
      ->when($request->type, function($q) use ($request){
         $q->where('type', $request->type);
      })
      ->orderBy('application_date','DESC')
      ->orderBy('status')
      ->get();

      return DataTables::of($company)
      ->addColumn('name', function($company) use ($request){
         return $request->user()->LanguageId == 1 ? ucfirst($company->name_en) : $company->name_ar;
      })
      ->editColumn('type', function($company){
         return ucwords($company->type);
      })
      ->addColumn('status', function($company){
         return permitStatus($company->status);
      })
      ->addColumn('date', function($company){
         return '<span class="text-underline" title="'.$company->application_date->format('h:i A, l | d-F-Y').'">'.humanDate($company->application_date).'</span>';
      })
      ->rawColumns(['date', 'status'])
      ->make(true);
   }
}
