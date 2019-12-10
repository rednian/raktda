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
            return Datatables::of(Event::with('company'))
                ->addColumn('event_id', function (Event $user) {
                    return '';
                })
                ->addColumn('reference_number', function (Event $user) {
                    return $user->reference_number;
                })
                ->addColumn('name_en', function (Event $user) {
                    return $user->name_en;
                })
                ->addColumn('description_en', function (Event $user) {
                    return $user->description_en;
                })
                ->addColumn('venue_en', function (Event $user) {
                    return $user->venue_en;
                })
                ->addColumn('address', function (Event $user) {
                    return $user->address;
                })
                ->addColumn('company_id', function (Event $user) {
                    return $user->company ?$user->company->name_en:' -- ';
                })
                ->addColumn('issued_date', function (Event $user) {
                    return $user->issued_date;
                })

                ->addColumn('event_type_id', function (Event $user) {
                    return $user->event_type_id;
                })
                ->addColumn('application_type', function (Event $user) {
                    return $user->firm;
                })
                ->addColumn('status', function (Event $user) {
                    return strtoupper($user->status);
                })

                ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                ->make(true);
        }

        public function applied_date(Request $request)
        {
            if($request->applied_date == 1) {
            $users = Event::whereDate('created_at', Carbon::now())->get();
             return Datatables::of($users)
                    ->addColumn('event_id', function (Event $user) {
                        return '';
                    })
                    ->addColumn('reference_number', function (Event $user) {
                        return $user->reference_number;
                    })
                    ->addColumn('name_en', function (Event $user) {
                        return $user->name_en;
                    })
                    ->addColumn('description_en', function (Event $user) {
                        return $user->description_en;
                    })
                    ->addColumn('venue_en', function (Event $user) {
                        return $user->venue_en;
                    })
                    ->addColumn('address', function (Event $user) {
                        return $user->address;
                    })
                    ->addColumn('company_id', function (Event $user) {
                        return $user->company ?$user->company->name_en:' -- ';
                    })
                    ->addColumn('issued_date', function (Event $user) {
                        return $user->issued_date;
                    })

                    ->addColumn('event_type_id', function (Event $user) {
                        return $user->event_type_id;
                    })
                 ->addColumn('application_type', function (Event $user) {
                     return $user->firm;
                 })
                    ->addColumn('status', function (Event $user) {
                        return strtoupper($user->status);
                    })

                    ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                    ->make(true);


        }

            if($request->applied_date == 2) {
                $users = Event::whereDate('created_at', Carbon::yesterday())->get();
                return Datatables::of($users)
                    ->addColumn('event_id', function (Event $user) {
                        return '';
                    })
                    ->addColumn('reference_number', function (Event $user) {
                        return $user->reference_number;
                    })
                    ->addColumn('name_en', function (Event $user) {
                        return $user->name_en;
                    })
                    ->addColumn('description_en', function (Event $user) {
                        return $user->description_en;
                    })
                    ->addColumn('venue_en', function (Event $user) {
                        return $user->venue_en;
                    })
                    ->addColumn('address', function (Event $user) {
                        return $user->address;
                    })
                    ->addColumn('company_id', function (Event $user) {
                        return $user->company ?$user->company->name_en:' -- ';
                    })
                    ->addColumn('issued_date', function (Event $user) {
                        return $user->issued_date;
                    })

                    ->addColumn('event_type_id', function (Event $user) {
                        return $user->event_type_id;
                    })
                    ->addColumn('application_type', function (Event $user) {
                        return $user->firm;
                    })
                    ->addColumn('status', function (Event $user) {
                        return strtoupper($user->status);
                    })

                    ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                    ->make(true);
            }

            if($request->applied_date == 3) {
                $date = new Carbon;
                $date->subWeek();
                $users = Event::where('created_at', '>', $date->toDateTimeString() )->get();
                return Datatables::of($users)
                    ->addColumn('event_id', function (Event $user) {
                        return '';
                    })
                    ->addColumn('reference_number', function (Event $user) {
                        return $user->reference_number;
                    })
                    ->addColumn('name_en', function (Event $user) {
                        return $user->name_en;
                    })
                    ->addColumn('description_en', function (Event $user) {
                        return $user->description_en;
                    })
                    ->addColumn('venue_en', function (Event $user) {
                        return $user->venue_en;
                    })
                    ->addColumn('address', function (Event $user) {
                        return $user->address;
                    })
                    ->addColumn('company_id', function (Event $user) {
                        return $user->company ?$user->company->name_en:' -- ';
                    })
                    ->addColumn('issued_date', function (Event $user) {
                        return $user->issued_date;
                    })

                    ->addColumn('event_type_id', function (Event $user) {
                        return $user->event_type_id;
                    })
                    ->addColumn('application_type', function (Event $user) {
                        return $user->firm;
                    })
                    ->addColumn('status', function (Event $user) {
                        return strtoupper($user->status);
                    })

                    ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                    ->make(true);

            }

            if($request->applied_date == 4) {
                $users = Event::whereDate('created_at', '>', Carbon::now()->subDays(30))->get();
                return Datatables::of($users)
                    ->addColumn('event_id', function (Event $user) {
                        return '';
                    })
                    ->addColumn('reference_number', function (Event $user) {
                        return $user->reference_number;
                    })
                    ->addColumn('name_en', function (Event $user) {
                        return $user->name_en;
                    })
                    ->addColumn('description_en', function (Event $user) {
                        return $user->description_en;
                    })
                    ->addColumn('venue_en', function (Event $user) {
                        return $user->venue_en;
                    })
                    ->addColumn('address', function (Event $user) {
                        return $user->address;
                    })
                    ->addColumn('company_id', function (Event $user) {
                        return $user->company ?$user->company->name_en:' -- ';
                    })
                    ->addColumn('issued_date', function (Event $user) {
                        return $user->issued_date;
                    })

                    ->addColumn('event_type_id', function (Event $user) {
                        return $user->event_type_id;
                    })
                    ->addColumn('application_type', function (Event $user) {
                        return $user->firm;
                    })
                    ->addColumn('status', function (Event $user) {
                        return strtoupper($user->status);
                    })

                    ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                    ->make(true);
            }

            if($request->applied_date == 5) {
                $date = Carbon::today()->subDays(2);
                $users = Event::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
                return Datatables::of($users)
                    ->addColumn('event_id', function (Event $user) {
                        return '';
                    })
                    ->addColumn('reference_number', function (Event $user) {
                        return $user->reference_number;
                    })
                    ->addColumn('name_en', function (Event $user) {
                        return $user->name_en;
                    })
                    ->addColumn('description_en', function (Event $user) {
                        return $user->description_en;
                    })
                    ->addColumn('venue_en', function (Event $user) {
                        return $user->venue_en;
                    })
                    ->addColumn('address', function (Event $user) {
                        return $user->address;
                    })
                    ->addColumn('company_id', function (Event $user) {
                        return $user->company ?$user->company->name_en:' -- ';
                    })
                    ->addColumn('issued_date', function (Event $user) {
                        return $user->issued_date;
                    })

                    ->addColumn('event_type_id', function (Event $user) {
                        return $user->event_type_id;
                    })
                    ->addColumn('application_type', function (Event $user) {
                        return $user->firm;
                    })
                    ->addColumn('status', function (Event $user) {
                        return strtoupper($user->status);
                    })

                    ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                    ->make(true);

            }

            if($request->applied_date == 6) {
                $users = Event::where('created_at', '>', (new Carbon)->submonths(1) )->get();
                return Datatables::of($users)
                    ->addColumn('event_id', function (Event $user) {
                        return '';
                    })
                    ->addColumn('reference_number', function (Event $user) {
                        return $user->reference_number;
                    })
                    ->addColumn('name_en', function (Event $user) {
                        return $user->name_en;
                    })
                    ->addColumn('description_en', function (Event $user) {
                        return $user->description_en;
                    })
                    ->addColumn('venue_en', function (Event $user) {
                        return $user->venue_en;
                    })
                    ->addColumn('address', function (Event $user) {
                        return $user->address;
                    })
                    ->addColumn('company_id', function (Event $user) {
                        return $user->company ?$user->company->name_en:' -- ';
                    })
                    ->addColumn('issued_date', function (Event $user) {
                        return $user->issued_date;
                    })

                    ->addColumn('event_type_id', function (Event $user) {
                        return $user->event_type_id;
                    })
                    ->addColumn('application_type', function (Event $user) {
                        return $user->firm;
                    })
                    ->addColumn('status', function (Event $user) {
                        return strtoupper($user->status);
                    })

                    ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
                    ->make(true);
            }
        }

    public function application_type(Request $request)
    {
    $data=  Event::where('firm','LIKE' ,"%$request->application_type%")->get();
        return Datatables::of($data)
            ->addColumn('event_id', function (Event $user) {
                return '';
            })
            ->addColumn('reference_number', function (Event $user) {
                return $user->reference_number;
            })
            ->addColumn('name_en', function (Event $user) {
                return $user->name_en;
            })
            ->addColumn('description_en', function (Event $user) {
                return $user->description_en;
            })
            ->addColumn('venue_en', function (Event $user) {
                return $user->venue_en;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return $user->company ?$user->company->name_en:' -- ';
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })

            ->addColumn('event_type_id', function (Event $user) {
                return $user->event_type_id;
            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })

            ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
            ->make(true);
    }

    public function status(Request $request)
    {
        $data=  Event::where('status','LIKE' ,"%$request->status%")->get();
        return Datatables::of($data)
            ->addColumn('event_id', function (Event $user) {
                return '';
            })
            ->addColumn('reference_number', function (Event $user) {
                return $user->reference_number;
            })
            ->addColumn('name_en', function (Event $user) {
                return $user->name_en;
            })
            ->addColumn('description_en', function (Event $user) {
                return $user->description_en;
            })
            ->addColumn('venue_en', function (Event $user) {
                return $user->venue_en;
            })
            ->addColumn('address', function (Event $user) {
                return $user->address;
            })
            ->addColumn('company_id', function (Event $user) {
                return $user->company ?$user->company->name_en:' -- ';
            })
            ->addColumn('issued_date', function (Event $user) {
                return $user->issued_date;
            })

            ->addColumn('event_type_id', function (Event $user) {
                return $user->event_type_id;
            })
            ->addColumn('application_type', function (Event $user) {
                return $user->firm;
            })
            ->addColumn('status', function (Event $user) {
                return strtoupper($user->status);
            })

            ->rawColumns(['reference_number','name_en', 'description_en','venue_en','address'])
            ->make(true);
    }
}
