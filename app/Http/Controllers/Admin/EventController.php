<?php

namespace App\Http\Controllers\Admin;

use DB;
use PDF;
use Auth;
use Calendar;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event.index', ['page_title' => 'Event Permit']);
    }

    public function calendar(Request $request)
    {
        $user = Auth::user();
        $events = Event::whereIn('status', ['active', 'expired'])->get();
        $events = $events->map(function ($event) use ($user) {
            return [
                'title' => $user->LanguageId == 1 ? $event->name_en : $event->name_ar,
                // 'start'=> Carbon::createFromTimestamp($event->issued_date.$event->time_start),
                'start' => date('Y-m-d', strtotime($event->issued_date)) . ' ' . date('H:m', strtotime($event->time_start)),
                'end' => date('Y-m-d', strtotime($event->expired_date)) . ' ' . date('H:m', strtotime($event->time_end)),
                'id' => $event->event_id,
                'url' => route('admin.event.show', $event->event_id) . '?tab=event-calendar',
                'description' => 'Venue : ' . $venue = $user->LanguageId == 1 ? $event->venue_en : $event->venue_ar,
                // 'allDay'=> false,
                'className' => eventType($event->type->name_en)
            ];
        });
        return response()->json($events);
    }


    public function submit(Request $request, Event $event)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $request['user_id'] = $user->user_id;
            $request['checked_at'] = Carbon::now();
            $event->check()->where('event_id', $event->event_id)->delete();
            $event->check()->create($request->all());

            if ($request->status == 'rejected'  || $request->status == 'need modification') {
                $request['role_id'] = $user->roles()->first()->role_id;
                if ($request->comment) {
                    $comment = $event->comment()->create($request->all());
                }
                $request['type'] = 1;
                $comment->approve()->create(array_merge($request->all(), ['event_id' => $event->event_id]));
                $event->update(['status' => $request->status]);
            }

            if ($request->status == 'approved-unpaid') {
                $comment = $event->comment()->create($request->all());
                $request['role_id'] = $user->roles()->first()->role_id;
                $request['type'] = $type = 1;
                $comment->approve()->create(array_merge($request->all(), ['event_id' => $event->event_id]));
                $event->update(['status' => $request->status]);
            }

            if ($request->status == 'need approval') {
                $request['role_id'] = $user->roles()->first()->role_id;
                $request['type']  = 0;
                $comment = $event->comment()->create($request->all());
                $comment->approve()->create(array_merge($request->all(), ['event_id' => $comment->event_id]));

                foreach ($request->approver as $role_id) {
                    $request['role_id'] = $role_id;
                    $request['status'] = 'pending';
                    $request['user_id'] = null;
                    $event->approve()->create($request->all());
                }
                $event->update(['status' => 'need approval']);
            }


            DB::commit();
            $result = ['success', ucfirst($event->name_en) . ' Successfully checked', 'Success'];
        } catch (Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
            DB::rollBack();
        }
        return redirect('/event#new-request')->with('message', $result);
    }

    public function updateLock(Request $request, Event $event)
    {
        if ($request->ajax()) {
            $event->update(['last_check_by' => Auth::user()->user_id, 'lock' => Carbon::now()]);
        }
    }

    public function download(Event $event)
    {
        $data['company_details'] = $event->owner->company;
        $data['event_details'] = $event;

        $pdf = PDF::loadView('permits.event.print', $data, [], [
            'title' => 'Event Permit',
            'default_font_size' => 10
        ]);
        return $pdf->stream('Event-Permit.pdf');
    }


    public function application(Request $request, Event $event)
    {
        $this->authorize('view', $event);
        $event->update(['last_check_by' => Auth::user()->user_id, 'lock' => Carbon::now(), 'status' => 'processing']);
        $existing_event = Event::where('event_id', '!=', $event->event_id)
            ->whereIn('status', ['processing', 'active', 'approved-unpaid'])
            ->whereBetween('time_end', [$event->time_start, $event->time_end])
            ->whereBetween('expired_date', [$event->issued_date, $event->expired_date])->get();


        return view('admin.event.application', [
            'page_title' => 'Event Application',
            'event' => $event,
            'existing_event' => $existing_event
        ]);
    }

    public function show(Request $request, Event $event)
    {
        return view('admin.event.show', ['page_title' => '', 'event' => $event, 'tab' => $request->tab]);
    }


    public function applicationDatatable(Request $request, Event $event)
    {
        $event = $event->requirements()->get();
        $user = Auth::user();
        //		dd($event->first()->pivot);
        return DataTables::of($event)
            ->addColumn('name', function ($event) use ($user) {
                $name = $user->LanguageId == 1 ? $event->requirement_name : $event->requirement_name_ar;
                return '<a href="' . asset('/storage/' . $event->pivot->path) . '"  data-fancybox data-fancybox data-caption="' . $name . '">' . $name . '</a>';
            })
            ->addColumn('issued_date', function ($event) {
                if ($event->dates_required && $event->issued_date) {
                    return $event->issued_date->format('d-M-Y');
                }
                return 'Not Required';
            })
            ->addColumn('expired_date', function ($event) {
                if ($event->dates_required && $event->expired_date) {
                    return $event->expired_date->format('d-M-Y');
                }
                return 'Not Required';
            })
            ->rawColumns(['name'])
            ->make(true);
        //		}
    }

    public function dataTable(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {


            $user = Auth::user();
            //			$start = $request->start;
            //			$length = $request->length;
            $events = Event::when($request->type, function ($q) use ($request) {
                $q->whereHas('owner', function ($q) use ($request) {
                    $q->where('type', $request->type);
                });
            })
                ->when($request->status, function ($q) use ($request) {
                    $q->whereIn('status', $request->status);
                })
                ->where('status', '!=', 'draft')
                ->orderBy('updated_at', 'desc');

            return DataTables::of($events)
                ->addColumn('establishment_name', function ($event) {
                    return $event->owner->type != 2 ? $event->owner->company->company_name : null;
                })
                ->addColumn('owner', function ($event) use ($user) {
                    if ($user->LanguageId == 1) {
                        return ucwords($event->owner->NameEn);
                    }
                    return $event->owner->NameAr;
                })
                ->addColumn('event_name', function ($event) use ($user) {
                    if ($user->LanguageId == 1) {
                        return ucwords($event->name_en);
                    }
                    return $event->name_ar;
                })
                ->addColumn('type', function ($event) {
                    return ucwords(userType($event->owner->type));
                })
                ->editColumn('created_at', function ($event) {
                    return $event->created_at->format('d-M-Y');
                })
                ->addColumn('start', function ($event) {
                    return $event->issued_date . '  ' . $event->time_start;
                })
                ->editColumn('status', function ($event) {
                    return permitStatus($event->status);
                })
                ->addColumn('action', function ($event) {
                    if ($event->status == 'rejected') {
                        return null;
                    }
                    return '<a href="' . route('admin.event.download', $event->event_id) . '" target="_blank" class="btn btn-download btn-sm btn-elevate btn-light"><i class="la la-download"></i> download</a>';
                })
                ->rawColumns(['status', 'action'])
                //				 ->setTotalRecords($totalRecords)s
                ->make(true);
        }
    }
}
