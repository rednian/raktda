<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use DataTables;
use App\Company;
use App\CompanyType;
use App\Areas;
use App\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
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
         'types'=>  CompanyType::orderBy('name_en')->get(),
         'areas'=>  Areas::has('company')->where('emirates_id', 5)->orderBy('area_en')->get(),
      ]);
   }



   public function submit(Request $request, Company $company)
   {
  	DB::beginTransaction();
      try {
      		$request['user_id'] = $request->user()->user_id;
      	switch ($request->status) {
      	   case 'active':

      	      	$company->update(['status'=>$request->status, 'registered_date'=>Carbon::now(), 'registered_by'=>$request->user()->user_id]);

      	      	$request['action'] = 'approved';
      	      	$company->comment()->create($request->all());
      	      	
      	      	$result = ['success', ucfirst($company->name_en).'has been successfully checked & approved .', 'Success'];
      	      break;
      	   case 'back':
      	      $company->update(['status'=>$request->status]);

      	      $company->comment()->create($request->all());
      	      $result = ['success', ucfirst($company->name_en).'has been successfully checked & bounce back successfully.', 'Success'];
      	      break; 
      	   case 'rejected':
      	      $company->update(['status'=>$request->status]);
      	      $company->comment()->create($request->all());
      	      $result = ['success', ucfirst($company->name_en).' has been successfully checked & approved successfully.', 'Success'];
      	      break;   	
      	     
      	}
      	DB::commit();

      } catch (Exception $e) {
      	$result = ['danger', $e->getMessage(), 'Error'];
		    DB::rollBack();
      	
      }

      return redirect()->route('admin.company.index')->with('message', $result);
      
   }



   public function changeStatus(Request $request, Company $company)
   {
    try {
      DB::beginTransaction();
      $company->update(['status'=>$request->status]);
      $request['user_id'] = $request->user()->user_id;
      $request['action'] = $request->status;
      $company->comment()->create($request->all());
       $result = ['success', ucfirst($company->name_en).' has been '.$request->status.' successfully.', 'Success'];
      DB::commit();
    } catch (Exception $e) {
      $result = ['danger', $e->getMessage(), 'Error'];
      DB::rollBack();
      
    }
    return redirect()->back()->with('message', $result);
   }



   public function commentDatatable(Request $request, Company $company)
   {
   	return DataTables::of($company->comment()->latest())
   	->addColumn('name', function($comment) use ($request){

      $name = $request->user()->LanguageId == 1 ? ucfirst($comment->user->NameEn) : $comment->user->NameAr;
      $role = $request->user()->LanguageId == 1 ? ucfirst($comment->user->roles()->first()->NameEn) : $comment->user->roles()->first()->NameAr;
      return profileName($name, $role);
   	})
   	->addColumn('remark', function($comment) use ($request){
   		return $request->user()->LanguageId == 1 ? ucfirst($comment->comment_en) : $comment->comment_ar; 
   	})
   	->editColumn('action', function($comment){
   		return ucfirst($comment->action);
   	})
   	->addColumn('date', function($comment){
   		return '<span class="text-underline"  title="'.$comment->created_at->format('l | h:i A, d-F-Y ').'">'.humanDate($comment->created_at).'</span>';
   	})
   	->rawColumns(['date', 'name'])
   	->make(true);
   }


   public function application(Request $request, Company $company)
   {
     if (!$request->hasValidSignature()) { abort(401); }
      return view('admin.company.application', [
         'company'=>$company,
         'page_title'=> ucfirst($request->user()->LanguageId == 1 ? $company->name_en : $company->name_ar).' | application'
      ]);
   }



   public function show(Request $request, Company $company)
   {
    
    if (!$request->hasValidSignature()) { abort(401); }

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
         $name =  $request->user()->LanguageId == 1 ?  ucfirst($companyRequirement->requirement->requirement_name) : $companyRequirement->requirement->requirement_name_ar;
         return '<a href="'.asset('/storage/'.$companyRequirement->path).'" data-caption="'.ucfirst($name).'" data-fancybox="gallery"  data-fancybox>'.ucfirst($name).'</a>';
      })
      ->addColumn('requirement', function($companyRequirement) use ($array, $counter){
       return ucfirst($companyRequirement->requirement->requirement_name);
      })
      ->editColumn('issued_date', function($companyRequirement){
         return $companyRequirement->issued_date ? date('d-F-Y', strtotime($companyRequirement->issued_date)) : '-'; 
      })
       ->editColumn('expired_date', function($companyRequirement){
          return $companyRequirement->expired_date ? date('d-F-Y', strtotime($companyRequirement->expired_date)) : '-'; 
      })
       ->rawColumns(['name'])
      ->make(true);
   }

   public function artistpermitDatatable(Request $request, Company $company)
   {
      $permit = $company->permit()->orderBy('expired_date', 'desc')->get();
      $user = $request->user()->LanguageId;

      return DataTables::of($permit)
      ->addColumn('artist_number', function($permit){
        $total = $permit->artistPermit()->count();
        $approved = $permit->artistPermit()->where('artist_permit_status', 'approved')->count();
        return $approved.' approved of '.$total;
      })
      ->addColumn('location', function($permit) use ($user){
        return $user == 1 ? ucfirst($permit->work_location) : $permit->work_location_ar;
      })
      ->addColumn('status', function($permit){
        return ucfirst(permitStatus($permit->permit_status));
      })
      ->addColumn('link', function($permit){
        return URL::signedRoute('admin.artist_permit.show', ['permit' => $permit->permit_id]);
      })
      ->addColumn('duration', function($permit){
        $date = Carbon::parse($permit->expired_date)->diffInDays($permit->issued_date);
        $date = $date !=  0 ? $date : 1;
        $day = $date > 1 ? ' Days': ' Day';
        return $date.$day;
      })
      ->addColumn('term', function($permit){
        return ucfirst($permit->term);
      })
      ->addColumn('request_type', function($permit){
        return ucfirst($permit->request_type);
      })
      ->editColumn('issued_date', function($permit){
        return $permit->issued_date->format('d-F-Y');
      })
      ->editColumn('expired_date', function($permit){
         return $permit->expired_date->format('d-F-Y');
      })
      ->addColumn('has_event', function($permit){
        return $permit->event()->exists() ? 'YES' : 'NO';
      })
      ->rawColumns(['status'])
      ->make(true);
   }


   public function artistDatatable(Request $request, Company $company)
   {
      $artist = Artist::whereHas('permit.owner.company', function($q) use ($company){
         return $q->where('company_id', $company->company_id);
      })->get();

      return DataTables::of($artist)
      ->editColumn('person_code', function($artist){
         return $artist->person_code;
      })
      ->editColumn('artist_status', function($artist){
         return permitStatus($artist->artist_status);
      })
      ->addColumn('name', function($artist) use ($request){
         $artist_permit = $artist->artistpermit()->latest()->first();

         $fname = $request->user()->LanguageId == 1 ? ucwords($artist_permit->firstname_en) : $artist_permit->firstname_ar ;
         $lastname = $request->user()->LanguageId == 1 ? ucwords($artist_permit->lastname_en) : $artist_permit->lastname_ar ;
         $gender = $request->user()->LanguageId == 1 ? $artist_permit->gender->name_en : $artist_permit->gender->name_ar;
        
         return profileName($fname.' '.$lastname, $gender);
      })
      ->addColumn('nationality', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
          $nationality = $request->user()->LanguageId == 1 ? ucfirst($artist_permit->country->name_en) : $artist_permit->country->name_ar; 
          return $nationality;

      })
      ->addColumn('mobile_number', function($artist){
          $artist_permit = $artist->artistpermit()->latest()->first();
          return $artist_permit->mobile_number;

      })
      ->addColumn('email', function($artist){
          $artist_permit = $artist->artistpermit()->latest()->first();
          return $artist_permit->email;

      })
      ->addColumn('birthdate', function($artist){
          $artist_permit = $artist->artistpermit()->latest()->first();
          return $artist_permit->birthdate->format('d-F-Y');
      })
      ->addColumn('age', function($artist){
          $artist_permit = $artist->artistpermit()->latest()->first();
          return $artist_permit->birthdate->age;
      })
      ->addColumn('visa_type', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
          if (!$artist_permit->visatype()->exists()) { return '-'; }
         return $request->user()->LanguageId == 1 ? ucfirst($artist_permit->visatype->visa_type_en) : $artist_permit->visatype->visa_type_ar; 
      })
      ->addColumn('religion', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
          if ( $artist_permit->religion()->exists() ) {
            return  $artist_permit->religion()->exists() ? $artist_permit->religion->name_en : $artist_permit->religion->name_ar;  
          }
          return '-';
         
      })
      ->addColumn('visa_number', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
         return $artist_permit->visa_number ? $artist_permit->visa_number : '-';  
      })
      ->addColumn('visa_expiry', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
         return $artist_permit->visa_expire_date ? $artist_permit->visa_expire_date->format('d-F-Y') : '-';  
      })
       ->addColumn('passport_number', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
         return $artist_permit->passport_number ? $artist_permit->passport_number : '-';  
      })
      ->addColumn('passport_expire', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
         return $artist_permit->passport_expire_date ? $artist_permit->passport_expire_date->format('d-F-Y') : '-';  
      })
      ->addColumn('identification_number', function($artist) use ($request){
          $artist_permit = $artist->artistpermit()->latest()->first();
         return $artist_permit->identification_number ? $artist_permit->identification_number : '-';  
      })
      ->addColumn('address', function($artist) use ($request) {
        $artist_permit = $artist->artistpermit()->latest()->first();
        $address =  $request->user()->LanguageId == 1 ? ucfirst($artist_permit->address_en) : $artist_permit->address_ar;
        $area = $request->user()->LanguageId == 1 ? ucfirst($artist_permit->area->area_en) : $artist_permit->area->area_ar;
        $emirate = $request->user()->LanguageId == 1 ? ucfirst($artist_permit->emirate->name_en) : $artist_permit->emirate->name_ar;
        $country = $request->user()->LanguageId == 1 ? ucfirst($artist_permit->country->name_en) : $artist_permit->country->name_ar;
        return $address.' '.$area.' '.$emirate.' '.$country;
      })
      ->addColumn('link', function($artist){
         return URL::signedRoute('admin.artist.show', ['artist' => $artist->artist_id]);
      })
      ->rawColumns(['artist_status', 'name'])
      ->make(true);
   }



   public function eventDatatable(Request $request, Company $company)
   {
      $events = $company->event()->orderBy('issued_date', 'desc')->get();
      return DataTables::of($events)
      ->addColumn('profile', function($event) use ($request){
         $type = null;
         if (!is_null($event->type)) {
            $type = $request->user()->LanguageId == 1 ? ucfirst($event->type->name_en) : $event->type->name_ar;
         }
         $name = $request->user()->LanguageId == 1 ? ucfirst($event->name_en) : $event->name_ar;

         return profileName($name, $type);
      })
      ->addColumn('duration', function($event){
         return duration($event->issued_date, $event->expired_date);
      })
      ->editColumn('status', function($event){
         return permitStatus($event->status);
      })
      ->editColumn('issued_date', function($event){
         return date('d-F-Y', strtotime($event->issued_date));
      })
      ->editColumn('expired_date', function($event){
         return date('d-F-Y', strtotime($event->expired_date));
      })
      ->addColumn('venue', function($event) use ($request){
         return $request->user()->LanguageId == 1 ? ucfirst($event->venue_en) : $event->venue_ar;
      })
      ->addColumn('time', function($event){
         return $event->time_start.' - '.$event->time_end;
      }) 
      ->addColumn('truck', function($event){
         return $event->truck->count() ? $event->truck()->count() : 0;
      })
      ->addColumn('liquor', function($event){
         return $event->liquor()->count() ? 'YES' : 'NO';
      })
      ->addColumn('artist', function($event){
         return $event->permit()->count() ? $event->permit->artistpermit()->count() : 0;
      })
      ->addColumn('link', function($event){
          return URL::signedRoute('admin.event.show', ['event' => $event->event_id]);
      })
      ->editColumn('firm', function($event){
         return ucfirst($event->firm);
      })
      ->rawColumns(['profile', 'status'])
      ->make(true);

   }



   public function dataTable(Request $request)
   {
      $company = Company::when($request->status, function($q) use ($request){
         $q->whereIn('status', $request->status);
      })
      ->when($request->type, function($q) use ($request){
         $q->where('company_type_id', $request->type);
      })
      ->when($request->area, function($q) use ($request){
         $q->where('area_id', $request->area);
      })
      ->orderBy('updated_at', 'desc')
      ->orderBy('name_en')
      ->get();
      // ->latest();

      return DataTables::of($company)
      ->addColumn('trade_expired_date', function($company){
         // if ($company->type->name_en == 'corporate') {
	         // return '<span class="text-underline" title="'.$company->trade_license_expired_date->format('l, d-F-Y').'">'.humanDate($company->trade_license_expired_date).'</span>';
         // }
         return '-';
      })
      ->addColumn('profile', function($company) use ($request){
         $name = $request->user()->LanguageId == 1 ? ucfirst($company->name_en) : $company->name_ar; 
         $type = $request->user()->LanguageId == 1 ? ucfirst($company->type->name_en) : $company->type->name_ar; 
         return profileName($name, $type);
      })
      ->addColumn('name', function($company) use ($request){
         return $request->user()->LanguageId == 1 ? ucfirst($company->name_en) : $company->name_ar;
      })
      ->addColumn('area', function($company) use ($request){
        return $request->user()->LanguageId == 1 ? ucfirst($company->area->area_en) : $company->area->area_ar; 
      })
      ->addColumn('issued_date', function($company){
         return $company->trade_license_issued_date->format('d-F-Y'); 
      })
       ->addColumn('expired_date', function($company){  
         return $company->trade_license_expired_date->format('d-F-Y'); 
      })
      ->editColumn('type', function($company) use ($request){
         return $request->user()->LanguageId == 1 ? ucfirst($company->type->name_en) : $company->type->name_ar; 
      })
      ->editColumn('registered_date', function($company){
        if($company->registered_date){
          return $company->registered_date->format('d-F-Y');
        }
        return '-';
      })
       ->editColumn('registered_by', function($company) use ($request){
        if(!is_null($company->registered_by)){
        return $request->user()->LanguageId == 1 ? ucfirst($company->registeredBy->NameEn) : $company->registeredBy->NameAr;  
        }
        return '-';
        
      })
      ->editColumn('address', function($company) use ($request){
         $country = $request->user()->LanguageId == 1 ? ucfirst($company->country->name_en) : $company->country->name_ar;
         $emirate = $request->user()->LanguageId == 1 ? ucfirst($company->emirate->name_en) : $company->emirate->name_ar;
         $area = $request->user()->LanguageId == 1 ? ucfirst($company->area->area_en) : $company->area->area_ar;
         return ucfirst($company->address).' '.$area.' '.$emirate.' '.$country;
      })
      ->editColumn('website', function($company){
         return $company->website ? '<a href="'.$company->webiste.'" target="_blank">'.$company->webiste.'</a>' :  '-';
      })
      ->addColumn('status', function($company){
         return permitStatus($company->status);
      })
      ->addColumn('link', function($company){
         return URL::signedRoute('admin.company.show', ['company' => $company->company_id]);
      }) 
      ->addColumn('application_link', function($company){
         return URL::signedRoute('admin.company.application', ['company' => $company->company_id]);
      })
      ->addColumn('date', function($company){
         return '<span class="text-underline" title="'.$company->updated_at->format('h:i A, l | d-F-Y').'">'.humanDate($company->updated_at).'</span>';
      })
      ->addColumn('reason', function($company) use ($request){
        $comment = null;
        if ($company->comment()->exists()) {
          $comment = $company->comment()->latest()->first();
          $comment = $request->user()->LanguageId == 1 ? ucfirst($comment->comment_en) : $comment->comment_ar;
        }
        return $comment;
      })
      ->rawColumns(['date', 'status', 'profile', 'trade_expired_date', 'website'])
      ->make(true);
   }
}
