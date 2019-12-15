<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Approval;
use App\Permit;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class InspectionController extends Controller
{

   public function __construct(){
      $this->middleware('signed')->except([
         'artist_permit'
      ]);
   }

	public function artist_permit(Request $request, Permit $permit){

		if(!$request->session()->has('user')){
			$request->session()->put('user', ['time_start'=> Carbon::now()]);
		}

        return view('inspector.tasks.show.artist_permit.show', [
        	'page_title'=> 'artist permit details',
          	'permit'=>$permit,
          	'roles'=>Roles::where('type', 0)->get()
        ]);
	}

   public function index(Request $request){

      $inspectors = User::areInspectors()->get(['user_id', 'NameEn', 'NameAr'])->toArray();
      $resources = [];
      foreach ($inspectors as $key => $value) {
         $resources[] = [
            'id' => $value['user_id'],
            'title' => $request->user()->LanguageId == 1 ? $value['NameEn'] : $value['NameAr']
         ];
      }

      $events = Approval::all();
      $appointments = [];
      foreach ($events as $key => $value) {
         $rc = $value->approver()->get('user_id')->toArray();
         $rc = Arr::flatten($rc);
         $appointments[] = [
            'id' => $value->approval_id,
            'title' => $value->permit->reference_number,
            'start' => $value->schedule_date_start,
            'end' => $value->schedule_date_end,
            'resourceIds' => $rc,
            'backgroundColor'=> '#b45454',
            'textColor' => '#fff !important',
            'description' => $value->permit->reference_number,
            'url' => '#'
         ];
      }
      return view('admin.inspection.index', ['page_title' => 'Inspection Appointments', 'resources' => $resources, 'appointments' => $appointments]);
   }
}
