<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\Company;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class EventReportController extends Controller
{
    public function event_reports()
    {
        $events = Event::where('status', 'active')
            ->whereDate('expired_date', '>', Carbon::now())->with('company')->with('type')->latest();

        return Datatables::of($events)
            ->addColumn('reference_number', function (Event $user) {
                return $user->reference_number ? $user->reference_number : '';
            })
            ->addColumn('name_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? Auth()->user()->LanguageId == 1 ? $user->name_en : $user->name_ar : $user->name_ar;
            })
            ->addColumn('description_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->description_en : $user->description_ar;
            })
            ->addColumn('venue_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->venue_en : $user->venue_ar;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : ' -- ') : ($user->company ? $user->company->name_ar : ' -- ');
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })
            ->addColumn('expired_date', function (Event $user) {
                $datetime1 = new \DateTime($user->issued_date);
                $datetime2 = new \DateTime($user->expired_date);
                $interval = $datetime1->diff($datetime2);
                return $interval->d;
            })
            ->addColumn('event_type_id', function (Event $user) {
                return Auth()->user()->LanguageId ? ($user->type ? $user->type->name_en : '') : ($user->type ? $user->type->name_ar : '');
            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })
            ->addColumn('event_id', function (Event $user) {
                if ($user->status == 'active') {
                    return "<button type='button' style='height: 25px;
                    line-height: 4px;
                    border-radius: 3px;'
                    class='btn btn-outline-warning btn-sm event_button_modal{{$user->event_id}}'  onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                    View</button>";
                } else {
                    return "<button type='button' style='height: 25px;
                    line-height: 4px;
                    border-radius: 3px; '
                   class='btn btn-danger btn-sm event_button_modal{{$user->event_id}}'  onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                 View</button>";
                }
            })
            ->rawColumns(['reference_number', 'name_en', 'description_en', 'venue_en', 'address', 'event_id'])
            ->make(true);
    }


    public function events(Request $request)
    {
        $events = Event::when($request->events == 'active', function ($q) {
            $q->where('status', 'active')
                ->whereDate('expired_date', '>', Carbon::now())->with('company')->with('type')->get();

        })
            ->when($request->events == 'all', function ($q) {
                $q->/*where('status','active')
                    ->where('expired_date', '>', Carbon::now())->*/ with('company')->with('type')->get();

            })
            ->when($request->events == '+60', function ($q) {
                $end = Carbon::now()->subDays(-60);
                $start = Carbon::now();
                $q->where('issued_date', '>', $start)->where('issued_date', '<', $end)->where('expired_date', '>', $start)->where('status', 'active')->with('company')->with('type')->latest();

            })
            ->when($request->events == '-30', function ($q) {
                $start = Carbon::now()->subDays(30);
                $end = Carbon::now();
                $q->where('issued_date', '>', $start)->where('issued_date', '<', $end)->with('company')->with('type')->latest();

            })
            ->when($request->events == '+30', function ($q) {
                $end = Carbon::now()->subDays(-30);
                $start = Carbon::now();
                $q->where('issued_date', '>', $start)->where('issued_date', '<', $end)->where('expired_date', '>', $start)->where('status', 'active')->with('company')->with('type')->latest();
            });

        return Datatables::of($events)
            ->addColumn('reference_number', function (Event $user) {

                return $user->reference_number ? $user->reference_number : '';
            })
            ->addColumn('name_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? Auth()->user()->LanguageId == 1 ? $user->name_en : $user->name_ar : $user->name_ar;
            })
            ->addColumn('description_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->description_en : $user->name_ar;
            })
            ->addColumn('venue_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->venue_en : $user->venue_ar;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : ' -- ') : ($user->company ? $user->company->name_ar : ' -- ');
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })
            ->addColumn('expired_date', function (Event $user) {
                $datetime1 = new \DateTime($user->issued_date);
                $datetime2 = new \DateTime($user->expired_date);
                $interval = $datetime1->diff($datetime2);
                return $interval->d;
            })
            ->addColumn('event_type_id', function (Event $user) {
                return Auth()->user()->LanguageId ? ($user->type ? $user->type->name_en : '') : ($user->type ? $user->type->name_ar : '');

            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })
            ->addColumn('event_id', function (Event $user) {
                return "<button type='button' style='height: 25px;
                    line-height: 4px;
                   border-radius: 3px;
                    
                    '
                   class='btn btn-outline-warning btn-sm event_button_modal{{$user->event_id}}'  onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                 View</button>";
            })
            ->rawColumns(['reference_number', 'name_en', 'description_en', 'venue_en', 'address', 'event_id'])
            ->make(true);
    }


    public function applied_date(Request $request)
    {
        $users = Event::when($request->applied_date == 1, function ($q) {
            $q->where('status', 'active')
                ->whereDate('expired_date', '>', Carbon::now())->with('company')->with('type')->whereDate('issued_date', Carbon::now())->with('type')->latest();

        })
            ->when($request->applied_date == 2, function ($q) {
                $q->whereDate('issued_date', Carbon::yesterday())->where('status', 'active')
                    ->whereDate('expired_date', '>', Carbon::now())->with('company')->with('type')->latest();

            })
            ->when($request->applied_date == 3, function ($q) {
                $from = Carbon::now();
                $to = Carbon::now()->subDays(7)->toDateTimeString();
                $q->whereDate('issued_date', '>', $from)->where('status', 'active')
                    ->whereDate('issued_date', '<', $to)->with('company')->with('type')->whereDate('expired_date', '<', Carbon::now())->latest();

            })
            ->when($request->applied_date == 4, function ($q) {
                $from = Carbon::now();
                $to = Carbon::now()->subDays(30)->toDateTimeString();
                $q->whereDate('issued_date', '>', $from)->where('status', 'active')->whereDate('issued_date', '<', $to)
                    ->whereDate('expired_date', '>', Carbon::now())->with('company')->with('type')->latest();

            })
            ->when($request->applied_date == 5, function ($q) {
                $q->where('status', 'active')
                    ->whereMonth('expired_date', '>', Carbon::now())->with('company')->whereMonth('issued_date', Carbon::now()->month)
                    ->with('type')->whereYear('issued_date', Carbon::now()->year)->get();
            })
            ->when($request->applied_date == 6, function ($q) {
                $lastMonth = Carbon::now()->subMonth()->month;
                $q->whereMonth('issued_date', $lastMonth)->whereYear('issued_date', Carbon::now()->year)->whereDate('expired_date', '>', Carbon::now())->with('type')->get();

            })
            ->when($request->applied_date == '', function ($q) {
                $q->where('status', 'active')
                    ->whereDate('expired_date', '>', Carbon::now())->with('company')->with('type')->latest();
            });


        return Datatables::of($users)
            ->addColumn('reference_number', function (Event $user) {
                return $user->reference_number ? $user->reference_number : '';
            })
            ->addColumn('name_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->name_en : $user->name_ar;
            })
            ->addColumn('description_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->description_en : $user->description_ar;
            })
            ->addColumn('venue_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->venue_en : $user->venue_ar;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : ' -- ') : ($user->company ? $user->company->name_ar : ' -- ');
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })
            ->addColumn('expired_date', function (Event $user) {
                $datetime1 = new \DateTime($user->issued_date);
                $datetime2 = new \DateTime($user->expired_date);
                $interval = $datetime1->diff($datetime2);
                return $interval->d;
            })
            ->addColumn('event_type_id', function (Event $user) {
                return Auth()->user()->LanguageId ? ($user->type ? $user->type->name_en : '') : ($user->type ? $user->type->name_ar : '');
            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })
            ->addColumn('event_id', function (Event $user) {
                return "<button type='button' style='height: 25px;
                    line-height: 4px;
                    border-radius: 3px;
                    
                    '
                   class='btn btn-outline-warning btn-sm event_button_modal{{$user->event_id}}'  onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                 View</button>";
            })
            ->rawColumns(['reference_number', 'name_en', 'description_en', 'venue_en', 'address', 'event_id'])
            ->make(true);
    }

    public function application_type(Request $request)
    {
        $data = Event::where('status', 'active')
            ->whereDate('expired_date', '>', Carbon::now())->with('company')->where('firm', 'LIKE', "%$request->application_type%")->with('type')->latest();
              return Datatables::of($data)
            ->addColumn('reference_number', function (Event $user) {
                 return $user->reference_number?$user->reference_number:'';
            })
            ->addColumn('name_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->name_en : $user->name_ar;
            })
            ->addColumn('description_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->description_en : $user->description_ar;
            })
            ->addColumn('venue_en', function (Event $user) {
                return Auth()->user()->LanguageId ? $user->venue_en : $user->venue_ar;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : ' -- ') : ($user->company ? $user->company->name_ar : ' -- ');
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })
            ->addColumn('expired_date', function (Event $user) {
                $datetime1 = new \DateTime($user->issued_date);
                $datetime2 = new \DateTime($user->expired_date);
                $interval = $datetime1->diff($datetime2);
                return $interval->d;
            })
            ->addColumn('event_type_id', function (Event $user) {
                return Auth()->user()->LanguageId ? ($user->type ? $user->type->name_en : '') : ($user->type ? $user->type->name_ar : '');

            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })
            ->addColumn('event_id', function (Event $user) {
                return "<button type='button' style='height: 25px;
                 line-height: 4px;
                   border-radius: 3px;
                    
                    '
                   class='btn btn-outline-warning btn-sm event_button_modal{{$user->event_id}}'   onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                 View</button>";
            })
            ->rawColumns(['reference_number', 'name_en', 'description_en', 'venue_en', 'address', 'event_id'])
            ->make(true);
    }

    public function status(Request $request)
    {
        $data = Event::where('status', 'active')
            ->whereDate('expired_date', '>', Carbon::now())->with('company')->where('status', 'LIKE', "%$request->status%")->with('type')->latest();
        return Datatables::of($data)
            ->addColumn('reference_number', function (Event $user) {
                 return $user->reference_number?$user->reference_number:'';
            })
            ->addColumn('name_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->name_en : $user->name_ar;
            })
            ->addColumn('description_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->description_en : $user->description_ar;
            })
            ->addColumn('venue_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->venue_en : $user->venue_ar;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : ' -- ') : ($user->company ? $user->company->name_ar : ' -- ');
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })
            ->addColumn('expired_date', function (Event $user) {
                $datetime1 = new \DateTime($user->issued_date);
                $datetime2 = new \DateTime($user->expired_date);
                $interval = $datetime1->diff($datetime2);
                return $interval->d;
            })
            ->addColumn('event_type_id', function (Event $user) {
                return Auth()->user()->LanguageId ? ($user->type ? $user->type->name_en : '') : ($user->type ? $user->type->name_ar : '');

            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })
            ->addColumn('event_id', function (Event $user) {
                return "<button type='button' style='height: 25px;
                 line-height: 4px;
                   border-radius: 3px;
                    
                    '
                   class='btn btn-outline-warning btn-sm event_button_modal{{$user->event_id}}' onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                 View</button>";
            })
            ->rawColumns(['reference_number', 'name_en', 'description_en', 'venue_en', 'address', 'event_id'])
            ->make(true);
    }

    public function establishment(Request $request)
    {
        $data = Event::where('status', 'active')
            ->whereDate('expired_date', '>', Carbon::now())->with('company')->where('company_id',$request->establishment)->with('type')->get();

        return Datatables::of($data)
            ->addColumn('reference_number', function (Event $user) {
                return $user->reference_number?$user->reference_number:'';
            })
            ->addColumn('name_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->name_en : $user->name_ar;
            })
            ->addColumn('description_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->description_en : $user->description_ar;
            })
            ->addColumn('venue_en', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? $user->venue_en : $user->venue_ar;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : ' -- ') : ($user->company ? $user->company->name_ar : ' -- ');
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })
            ->addColumn('expired_date', function (Event $user) {
                $datetime1 = new \DateTime($user->issued_date);
                $datetime2 = new \DateTime($user->expired_date);
                $interval = $datetime1->diff($datetime2);
                return $interval->d;
            })
            ->addColumn('event_type_id', function (Event $user) {
                return Auth()->user()->LanguageId ? ($user->type ? $user->type->name_en : '') : ($user->type ? $user->type->name_ar : '');

            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })
            ->addColumn('event_id', function (Event $user) {
                return "<button type='button' style='height: 25px;
                 line-height: 4px;
                   border-radius: 3px;
                    
                    '
                   class='btn btn-outline-warning btn-sm event_button_modal{{$user->event_id}}' onclick='onclickevent($user->event_id)' data-toggle='modal' data-target='#event_modal_$user->event_id'>
                 View</button>";
            })
            ->rawColumns(['reference_number', 'name_en', 'description_en', 'venue_en', 'address', 'event_id'])
            ->make(true);
    }


    public function getEvent($id)
    {
        $page_title = 'Reports Dashboard';
        $event = Event::where('event_id', $id)->with('country')->with('type')->with('emirate')->first();
        return view('admin.report.includes.eventShow', compact('event', 'page_title'));
    }
}
