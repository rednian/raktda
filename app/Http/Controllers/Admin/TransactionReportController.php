<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\ArtistPermit;
use App\ArtistPermitTransaction;
use App\Event;
use App\EventTransaction;
use App\Permit;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\DataTables\Facades\DataTables;
use function foo\func;
use function GuzzleHttp\Promise\all;

class TransactionReportController extends Controller
{
    //
    public function artistTransaction()
    {
        return Datatables::of(Transaction::latest())
            ->addColumn('transaction_date', function ($transaction) {
                if ($transaction->transaction_date) {
                    return Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                } else {
                    return 'None';
                }
            })->addIndexColumn()->editColumn('created_at', function ($transaction) {
                if ($transaction->transaction_date) {
                    return Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                } else {
                    return 'None';
                }
            })->addColumn('transaction_id', function ($transaction) {
                return $transaction->reference_number;
            })->addColumn('amount', function ($transaction) {
                if ($transaction->artistPermitTransaction != '' || $transaction->eventTransaction != '') {
                    return number_format(($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') : 0), 2);
                }
                return number_format($transaction->amount, 2);
            })->addColumn('vat', function ($transaction) {
                return number_format(($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('vat') : 0), 2);
            })->addColumn('total', function ($transaction) {
                return number_format(($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0), 2);
            })->addColumn('action', function ($transaction) {
                $transaction->transaction_id;
                return "<button style='height: 22px;line-height: 4px;border-radius: 3px;' class='btn btn-outline-warning btn-sm' onclick='transactionFunction($transaction->transaction_id)'>
  View
</button>";

            })->rawColumns(['action', 'transaction_id', 'amount', 'vat'])->make(true);
    }


    //END ARTIST SECTION

    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    //START EVENT SECTION

    public function eventTransaction()
    {
        $transactions = EventTransaction::with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('company')->with('emirate')->with('country');
        })->with('transaction')->latest();

        return Datatables::of($transactions)
            ->addColumn('reference_number', function (EventTransaction $user) {
                return $user->transaction->reference_number;
            })
            ->addColumn('transaction_type', function (EventTransaction $user) {
                return $user->transaction->transaction_type;
            })
            ->addColumn('company', function (EventTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : '') : ($user->company ? $user->company->name_en : '');
            })
            ->addColumn('vat', function (EventTransaction $artist) {
                return $artist->vat;
            })
            ->addColumn('amount', function (EventTransaction $artist) {
                return $artist->amount;
            })
            ->addColumn('event_name', function (EventTransaction $artist) {
                return Auth()->user()->LanguageId == 1 ? $artist->event->name_en : $artist->event->name_ar;
            })
            ->addColumn('description_en', function (EventTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->event->description_en : $user->event->description_ar;
            })
            ->addColumn('venue_en', function (EventTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->event->venue_en : $user->event->venue_ar;
            })
            ->addColumn('owner_name', function (EventTransaction $user) {
                return $user->event->owner_name;
            })
            ->addColumn('full_address', function (EventTransaction $user) {
                return $user->event->full_address;
            })
            ->addColumn('issued_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->issued_date)->format('d-M-Y');
            })
            ->addColumn('expired_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->expired_date)->format('d-M-Y');

            })
            ->addColumn('transaction_date', function (EventTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            /*       ->addColumn('event_transaction_id', function(EventTransaction $user) {
                       $artistDetails=EventTransaction::where('event_transaction_id',$user->artist_permit_trans_id)->first();

                       return "<button type='button' style='height: 25px;
                                      line-height: 4px;
                                       border-radius: 3px;
                                      border: navajowhite;
                                      box-shadow: 0px 2px 5px -2px #0c0c0c;'  class='btn btn-primary btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                                      View</button>";
                   })*/
            ->rawColumns(['reference_number', 'transaction_type', 'company', 'event_name'/*,'event_transaction_id'*/])
            ->make(true);
    }


    public function customEventDate(Request $request)
    {
        $transactions = EventTransaction::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('company')->with('emirate')->with('country');
        })->with('transaction')->latest();

        return Datatables::of($transactions)
            ->addColumn('reference_number', function (EventTransaction $user) {
                return $user->transaction->reference_number;
            })
            ->addColumn('transaction_type', function (EventTransaction $user) {
                return $user->transaction->transaction_type;
            })
            ->addColumn('company', function (EventTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->company ? $user->company->name_en : '') : ($user->company ? $user->company->name_en : '');
            })
            ->addColumn('vat', function (EventTransaction $artist) {
                return $artist->vat;
            })
            ->addColumn('amount', function (EventTransaction $artist) {
                return $artist->amount;
            })
            ->addColumn('event_name', function (EventTransaction $artist) {
                return Auth()->user()->LanguageId == 1 ? $artist->event->name_en : $artist->event->name_ar;
            })
            ->addColumn('description_en', function (EventTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->event->description_en : $user->event->description_ar;
            })
            ->addColumn('venue_en', function (EventTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->event->venue_en : $user->event->venue_ar;
            })
            ->addColumn('owner_name', function (EventTransaction $user) {
                return $user->event->owner_name;
            })
            ->addColumn('full_address', function (EventTransaction $user) {
                return $user->event->full_address;
            })
            ->addColumn('issued_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->issued_date)->format('d-M-Y');
            })
            ->addColumn('expired_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->expired_date)->format('d-M-Y');

            })
            ->addColumn('transaction_date', function (EventTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            /*       ->addColumn('event_transaction_id', function(EventTransaction $user) {
                       $artistDetails=EventTransaction::where('event_transaction_id',$user->artist_permit_trans_id)->first();

                       return "<button type='button' style='height: 25px;
                                      line-height: 4px;
                                       border-radius: 3px;
                                      border: navajowhite;
                                      box-shadow: 0px 2px 5px -2px #0c0c0c;'  class='btn btn-primary btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                                      View</button>";
                   })*/
            ->rawColumns(['reference_number', 'transaction_type', 'company', 'event_name'/*,'event_transaction_id'*/])
            ->make(true);
    }


    public function transactionDate(Request $request)
    {
        $transactions = Transaction::when($request->today, function ($q) use ($request) {
            $q->whereDate('transaction_date', Carbon::today());
        })
            ->when($request->lastSeven, function ($q) use ($request) {
                $start = Carbon::now()->subDays(7);
                $end = Carbon::now()->subDays(-1);
                $q->whereDate('transaction_date', '>', $start)->whereDate('transaction_date', '<', $end);
            })
            ->when($request->lastThirty, function ($q) use ($request) {
                $start = Carbon::now()->subDays(30);
                $end = Carbon::now()->subDays(-1);
                $q->whereDate('transaction_date', '>', $start)->whereDate('transaction_date', '<', $end);
            })
            ->when($request->thisMonth, function ($q) use ($request) {
                $q->whereMonth('transaction_date', Carbon::now()->month);
            })
            ->when($request->end_date, function ($q) use ($request) {
                $start = Carbon::parse($request->start_date)->format('Y-m-d');
                $end = Carbon::parse($request->end_date)->format('Y-m-d');
                $q->whereDate('transaction_date', '>=', $start)->whereDate('transaction_date', '<=', $end);
            })
            ->when($request->month, function ($q) use ($request) {
                $date = '01-' . $request->month;
                $month = Carbon::parse($date)->month;
                $year = Carbon::parse($date)->year;
                $q->whereMonth('transaction_date', $month)->whereYear('transaction_date', $year);
            })
            ->get();

            return Datatables::of($transactions)
                ->addColumn('transaction_date', function ($transaction) {
                    if ($transaction->transaction_date) {
                        return Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                    } else {
                        return 'None';
                    }
                })->addIndexColumn()->editColumn('created_at', function ($transaction) {
                    if ($transaction->transaction_date) {
                        return Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                    } else {
                        return 'None';
                    }
                })->addColumn('transaction_id', function ($transaction) {
                    return $transaction->reference_number;
                })->addColumn('amount', function ($transaction) {
                    if ($transaction->artistPermitTransaction != '' || $transaction->eventTransaction != '') {
                        return number_format(($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') : 0), 2);
                    }
                    return number_format($transaction->amount, 2);
                })->addColumn('vat', function ($transaction) {
                    return number_format(($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('vat') : 0), 2);
                })->addColumn('total', function ($transaction) {
                    return number_format(($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0), 2);
                })->addColumn('action', function ($transaction) {
                    $transaction->transaction_id;
                    return "<button style='height: 22px;line-height: 4px;border-radius: 3px;' class='btn btn-outline-warning btn-sm' onclick='transactionFunction($transaction->transaction_id)'>
               View
          </button>";
                })
                ->rawColumns(['action', 'transaction_id', 'amount', 'vat', 'transaction_date'])->make(true);
    }

    public function transactionShow($id)
    {
        $page_title = 'Transaction Report';
        $transaction = Transaction::where('transaction_id', $id)->with('eventTransaction')->with(['artistPermitTransaction' => function ($query) {
            $query->with('artistPermit')->get();
        }])->first();
        return view('admin.report.includes.transactionShow', compact('transaction', 'page_title'));
    }

    public function chartData(Request $request)
    {
        if ($request->SelectedYear != '') {
            $date = $request->SelectedYear;
            $jan=Transaction::whereMonth('transaction_date','1')->whereYear('transaction_date',$date)->get();
            $january=[];
            foreach ($jan as $transaction) {
                array_push($january, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $one=array_sum($january);

            $feb=Transaction::whereMonth('transaction_date','2')->whereYear('transaction_date',$date)->get();
            $february=[];
            foreach ($feb as $transaction) {
                array_push($february, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $two=array_sum($february);

            $mar=Transaction::whereMonth('transaction_date','3')->whereYear('transaction_date',$date)->get();
            $march=[];
            foreach ($mar as $transaction) {
                array_push($march, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $three=array_sum($march);

            $apr=Transaction::whereMonth('transaction_date','4')->whereYear('transaction_date',$date)->get();
            $april=[];
            foreach ($apr as $transaction) {
                array_push($april, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $four=array_sum($april);

            $ma=Transaction::whereMonth('transaction_date','5')->whereYear('transaction_date',$date)->get();
            $may=[];
            foreach ($ma as $transaction) {
                array_push($may, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $five=array_sum($may);

            $jun=Transaction::whereMonth('transaction_date','6')->whereYear('transaction_date',$date)->get();
            $june=[];
            foreach ($jun as $transaction) {
                array_push($june, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $six=array_sum($june)  ;
            $jul=Transaction::whereMonth('transaction_date','7')->whereYear('transaction_date',$date)->get();
            $july=[];
            foreach ($jul as $transaction) {
                array_push($july, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $seven=array_sum($july);

            $aug=Transaction::whereMonth('transaction_date','8')->whereYear('transaction_date',$date)->get();
            $august=[];
            foreach ($aug as $transaction) {
                array_push($august, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $eight=array_sum($august);

            $sep=Transaction::whereMonth('transaction_date','9')->whereYear('transaction_date',$date)->get();
            $september=[];
            foreach ($sep as $transaction) {
                array_push($september, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $nine=array_sum($september);

            $oct=Transaction::whereMonth('transaction_date','10')->whereYear('transaction_date',$date)->get();
            $october=[];
            foreach ($oct as $transaction) {
                array_push($october, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $ten=array_sum($october);


            $nov=Transaction::whereMonth('transaction_date','11')->whereYear('transaction_date',$date)->get();
            $november=[];
            foreach ($nov as $transaction) {
                array_push($november, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $eleven=array_sum($november);

            $dec=Transaction::whereMonth('transaction_date','12')->whereYear('transaction_date',$date)->get();
            $december=[];
            foreach ($dec as $transaction) {
                array_push($december, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
            }
            $twelve=array_sum($december);
        }
        $chart_data['label']=  ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $chart_data['data']=[$one,$two,$three,$four,$five,$six,$seven,$eight,$nine,$ten,$eleven,$twelve];
        return json_encode($chart_data);
    }
}
