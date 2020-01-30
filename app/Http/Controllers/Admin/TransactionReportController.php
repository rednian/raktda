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

    public function eventTransactionDatatable()
    {
        $transactions = EventTransaction::wherehas('transaction')->with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('country');
        })->with('transaction')->get();

        return Datatables::of($transactions)
            ->addColumn('reference_number', function (EventTransaction $user) {
               return $user->transaction->reference_number;
            })
            ->addColumn('event_name', function (EventTransaction $user) {
                return Auth()->user()->LanguageId==1? $user->event->name_en:$user->event->name_ar;
            })
            ->addColumn('transaction_date', function (EventTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            ->addColumn('issued_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->issued_date)->format('d-M-Y');
            })
            ->addColumn('expired_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->expired_date)->format('d-M-Y');

            })
            ->addColumn('vat', function (EventTransaction $artist) {
                return number_format($artist->vat,2);
            })
            ->addColumn('amount', function (EventTransaction $artist) {
                return number_format($artist->amount,2);
            })
            ->addColumn('total', function (EventTransaction $artist) {
                return number_format($artist->amount+$artist->vat,2);
            })
            ->addColumn('event_type', function (EventTransaction $artist) {
                $data=Auth()->user()->LanguageId==1 ? $artist->event->type->name_en:   $artist->event->type->name_ar;
                $pieces = explode(" ", $data);
                return $pieces[0];            })
            ->addColumn('application_type', function (EventTransaction $user) {
                return $user->event->firm;
            })

            ->rawColumns(['reference_number', 'event_type', 'total','application_type', 'event_name'])
            ->make(true);
    }

    public function eventTransaction(){

            $transactions = EventTransaction::wherehas('transaction')->with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('country');
            })->with('transaction')->get();

         $page_title='Event Transactions';
           return view('admin.report.includes.event-transactions',compact('transactions','page_title'));

    }


    public function eventTransactionDateRange(Request $request)
    {
        $transactions = EventTransaction::when($request->selectEventTypeId,function ($id) use ($request) {
                $id->wherehas('transaction',function ($trans){
                    $start = Carbon::now()->format('y-m-d');
                    $trans->whereDate('transaction_date','<',$start);
                })->with('event')->whereHas('event', function ($q) use ($request) {
                    $q->whereHas('type', function ($query) use ($request) {
                        $query->where('event_type_id', $request->selectEventTypeId);
                    })->with('country');
                });
        })
         -> when($request->end_date,function($date) use ($request){
           $date-> wherehas('transaction',function ($query) use ($request){
               $start = Carbon::parse($request->start_date)->format('y-m-d');
               $end = Carbon::parse($request->end_date)->format('y-m-d');
               $query->whereDate('transaction_date', '>', $start)->whereDate('transaction_date', '<', $end)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'));
             })->with('event');
           })
       ->with('transaction')->get();



        return Datatables::of($transactions)
            ->addColumn('reference_number', function (EventTransaction $user) {
                return $user->transaction->reference_number;
            })
            ->addColumn('event_name', function (EventTransaction $user) {
                return Auth()->user()->LanguageId==1? $user->event->name_en:$user->event->name_ar;
            })
            ->addColumn('transaction_date', function (EventTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            ->addColumn('issued_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->issued_date)->format('d-M-Y');
            })
            ->addColumn('expired_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->expired_date)->format('d-M-Y');

            })
            ->addColumn('vat', function (EventTransaction $artist) {
                return number_format($artist->vat,2);
            })
            ->addColumn('amount', function (EventTransaction $artist) {
                return number_format($artist->amount,2);
            })
            ->addColumn('total', function (EventTransaction $artist) {
                return number_format($artist->amount+$artist->vat,2);
            })
            ->addColumn('event_type', function (EventTransaction $artist) {
                $data=Auth()->user()->LanguageId==1 ? $artist->event->type->name_en:   $artist->event->type->name_ar;
                $pieces = explode(" ", $data);
                return $pieces[0];
            })
            ->addColumn('application_type', function (EventTransaction $user) {
                return $user->event->firm;
            })

            ->rawColumns(['reference_number', 'event_type', 'total','application_type', 'event_name'])
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
                ->rawColumns(['action', 'transaction_id', 'amount', 'vat','total', 'transaction_date'])->make(true);
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

        if ($request->month != '') {
            $date= '01-'.$request->month;
            $days= date('t', strtotime($date));
            $month=date('m', strtotime($date));
            $year= date('Y', strtotime($date));
            $array=[];
            $day=[];
             $total=[];

            for ($i=1;$i<=$days;$i++){
                 $trans = Transaction::whereDay('transaction_date',str_pad($i,2,0,STR_PAD_LEFT))->whereMonth('transaction_date', $month)->whereYear('transaction_date', $year)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                 array_push($array,$trans);
                 array_push($day,str_pad($i,2,0,STR_PAD_LEFT));

                $amount=[];
                 foreach ($trans as $transaction) {
                    array_push($amount, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                 }
                 $myData=array_sum($amount);
                 array_push($total,$myData);
/*               $trans = Transaction::whereMonth('transaction_date', $month)->whereYear('transaction_date', $year)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();*/

            }
            $chart_data['label'] =$day;
            $chart_data['data'] =$total;


            return json_encode($chart_data);
        }
            if ($request->SelectedYear != '') {
                $date = $request->SelectedYear;
                $jan = Transaction::whereMonth('transaction_date', '1')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $january = [];
                foreach ($jan as $transaction) {
                    array_push($january, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $one = array_sum($january);

                $feb = Transaction::whereMonth('transaction_date', '2')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $february = [];
                foreach ($feb as $transaction) {
                    array_push($february, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $two = array_sum($february);

                $mar = Transaction::whereMonth('transaction_date', '3')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $march = [];
                foreach ($mar as $transaction) {
                    array_push($march, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $three = array_sum($march);

                $apr = Transaction::whereMonth('transaction_date', '4')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $april = [];
                foreach ($apr as $transaction) {
                    array_push($april, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $four = array_sum($april);

                $ma = Transaction::whereMonth('transaction_date', '5')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $may = [];
                foreach ($ma as $transaction) {
                    array_push($may, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $five = array_sum($may);

                $jun = Transaction::whereMonth('transaction_date', '6')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $june = [];
                foreach ($jun as $transaction) {
                    array_push($june, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $six = array_sum($june);
                $jul = Transaction::whereMonth('transaction_date', '7')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $july = [];
                foreach ($jul as $transaction) {
                    array_push($july, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $seven = array_sum($july);

                $aug = Transaction::whereMonth('transaction_date', '8')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $august = [];
                foreach ($aug as $transaction) {
                    array_push($august, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $eight = array_sum($august);

                $sep = Transaction::whereMonth('transaction_date', '9')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $september = [];
                foreach ($sep as $transaction) {
                    array_push($september, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $nine = array_sum($september);

                $oct = Transaction::whereMonth('transaction_date', '10')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $october = [];
                foreach ($oct as $transaction) {
                    array_push($october, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $ten = array_sum($october);


                $nov = Transaction::whereMonth('transaction_date', '11')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $november = [];
                foreach ($nov as $transaction) {
                    array_push($november, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $eleven = array_sum($november);

                $dec = Transaction::whereMonth('transaction_date', '12')->whereYear('transaction_date', $date)->whereDate('transaction_date', '<', Carbon::now()->format('y-m-d'))->get();
                $december = [];
                foreach ($dec as $transaction) {
                    array_push($december, ($transaction->artistPermitTransaction ? $transaction->artistPermitTransaction->sum('amount') + $transaction->artistPermitTransaction->sum('vat') : 0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount') + $transaction->eventTransaction->sum('vat') : 0));
                }
                $twelve = array_sum($december);
            }
            $chart_data['label'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $chart_data['data'] = [$one, $two, $three, $four, $five, $six, $seven, $eight, $nine, $ten, $eleven, $twelve];
            return json_encode($chart_data);
    }
}
