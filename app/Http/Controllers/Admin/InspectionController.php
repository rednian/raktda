<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Approval;
use App\Permit;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\URL;

class InspectionController extends Controller
{

   public function __construct(){
      $this->middleware('signed')->except([
         'artist_permit',
         'getEvents',
         'getEventsDatatable',
         'submitInspection'
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

  public function getEvents(Request $request){

    $start = Carbon::parse($request->start)->startOfDay()->toDateTimeString();
    $end = Carbon::parse($request->end)->endOfDay()->toDateTimeString();

    $events = Approval::when($request->user_id, function($q) use($request){
        $q->whereHas('approver', function($q1) use($request){
          $q1->where('user_id', $request->user_id);
        });
    })->where('schedule_date_start', '<=', $end)->where('schedule_date_end', '>=', $start)->get();

    $events = $events->map(function($event) use ($request){
        $rc = $event->approver()->get('user_id')->toArray();
        $rc = Arr::flatten($rc);
        return [
            'id' => $event->approval_id,
            'title' => $event->permit->reference_number,
            'start' => $event->schedule_date_start,
            'end' => $event->schedule_date_end,
            'resourceIds' => $rc,
            'backgroundColor'=> '#b45454',
            'textColor' => '#fff !important',
            'description' => $event->permit->reference_number,
            'url' => '#'
        ];
    });

    return response()->json($events);
  }

  public function getEventsDatatable(Request $request){

      // dd($request->date);

      $data = Approval::when($request->status, function($q) use($request){
          $q->where('approval_status', $request->status);
      })->when($request->type, function($q) use($request){
          $q->where('type', $request->type);
      })->when($request->date, function($q) use($request){
          $q->where('schedule_date_start', '<=', Carbon::parse($request->date['end'])->endOfDay()->toDateTimeString())
          ->where('schedule_date_end', '>=', Carbon::parse($request->date['start'])->startOfDay()->toDateTimeString());
      })->when($request->user_id, function($q) use($request){
          $q->whereHas('approver', function($q1) use($request){
            $q1->where('user_id', $request->user_id);
          });
      })->orderBy('approval_id', 'DESC');

      return Datatables::of($data)->addColumn('ref_no', function($event){
          return $event->type == 'event' ? $event->permit->reference_number : '';
      })->editColumn('type', function($event){
          return ucwords($event->type);
      })->addColumn('inspectors', function($event){
          $rc = $event->approver;
          $inspectors = '';
          foreach ($rc as $key => $value) {
              $inspectors .= $value->getUser->NameEn . ', ';
          }

          return substr($inspectors, 0, -2);
      })->addColumn('schedule', function($event){
          return Carbon::parse($event->schedule_date_start)->format('d-M-Y h:i A');
      })->addColumn('status', function($event){
          return ucwords($event->approval_status);
      })->addColumn('view_url', function($event){
          return URL::signedRoute('inspection.show', ['inspection' => $event->approval_id]);
      })->addColumn('company', function($event){
          // return $event->type == 'event' ? $event->permit->company->name_en : '';
          return $event->type == 'event' && $event->permit->owner->type != 2 ? $event->permit->owner->company->name_en : null;
      })
      ->addColumn('owner', function($event) use ($request){
          if ($request->user()->LanguageId == 1) {
            return ucwords($event->permit->owner->NameEn);
          }
          return $event->permit->owner->NameAr;
      })
      ->make(true);
  }

   public function index(Request $request){

      $inspectors = User::areInspectors()->get();
      $inspectors = $inspectors->map(function($inspector) use ($request){
          return [
              'id' => $inspector->user_id,
              'title' => $request->user()->LanguageId == 1 ? $inspector->NameEn: $inspector->NameAr
              
          ];
      });

      return view('admin.inspection.index', ['page_title' => 'Inspection Appointments', 'resources' => $inspectors, 'view' => $request->v]);
   }

   public function show(Approval $inspection, Request $request){
      return view('admin.inspection.show', ['page_title' => 'Inspection Appointment', 'inspection' => $inspection, 'event' => $inspection->permit ]);
   }

   public function inspect(Approval $inspection, Request $request){
      return view('admin.inspection.inspect', ['page_title' => 'Inspection', 'inspection' => $inspection]);
   }

   public function submitInspection(Approval $inspection, Request $request){
      dd($request->all());
   }
}
