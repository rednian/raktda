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
                return  Carbon::parse($transaction->transaction_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->addIndexColumn()->editColumn('created_at', function ($transaction) {
                if ($transaction->transaction_date) {
                    return  Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                } else {
                    return 'None';
                }
        })->addColumn('transaction_id', function ($transaction) {
            return $transaction->reference_number;
        })->addColumn('amount', function ($transaction) {
            if($transaction->artistPermitTransaction!='' || $transaction->eventTransaction!='') {
               return number_format(($transaction->artistPermitTransaction? $transaction->artistPermitTransaction->sum('amount'):0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount'):0),2);
            }
            return number_format($transaction->amount,2);
        })->addColumn('vat', function ($transaction) {
                return number_format(($transaction->artistPermitTransaction? $transaction->artistPermitTransaction->sum('vat'):0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('vat'):0),2);
        })->addColumn('total', function ($transaction) {
                return number_format(($transaction->artistPermitTransaction? $transaction->artistPermitTransaction->sum('amount')+$transaction->artistPermitTransaction->sum('vat'):0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount')+$transaction->eventTransaction->sum('vat'):0),2);
        })->addColumn('action', function ($transaction)  {
            $transaction->transaction_id;
            return "<button style='height: 22px;line-height: 4px;border-radius: 3px;' class='btn btn-outline-warning btn-sm' onclick='transactionFunction($transaction->transaction_id)'>
  View
</button>";

        })->rawColumns(['action','transaction_id','amount','vat'])->make(true);
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



    public function customEventDate(Request $request){
        $transactions = EventTransaction::whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$request->end_date)->with('event')->whereHas('event', function ($q) {
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



    public function transactionDate(Request $request){

        $transactions = Transaction::when($request->today, function ($q) use ($request) {
            $q->whereDate('transaction_date',Carbon::now());
        })
            ->when($request->lastSeven, function ($q) use ($request) {
                $start=Carbon::now()->subDays(7);
                $end=Carbon::now()->subDays(-1);
                $q->whereDate('transaction_date','>',$start)->whereDate('transaction_date','<',$end);
            })

            ->when($request->lastThirty, function ($q) use ($request) {
                $start=Carbon::now()->subDays(30);
                $end=Carbon::now()->subDays(-1);
                $q->whereDate('transaction_date','>',$start)->whereDate('transaction_date','<',$end);
            })
            ->when($request->thisMonth, function ($q) use ($request) {
                $q->whereMonth('transaction_date', Carbon::now()->month);
            })
            ->when($request->submit, function ($q) use ($request) {
                $start=  Carbon::parse($request->start_date)->format('Y-m-d');
                $end=  Carbon::parse($request->end_date)->format('Y-m-d');
                $q->whereDate('transaction_date','>=',$start)->whereDate('transaction_date','<=',$end);
            })
            ->latest();

        return Datatables::of($transactions)
            ->addColumn('transaction_date', function ($transaction) {
                if ($transaction->transaction_date) {
                    return  Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                } else {
                    return 'None';
                }
            })->addIndexColumn()->editColumn('created_at', function ($transaction) {
                if ($transaction->transaction_date) {
                    return  Carbon::parse($transaction->transaction_date)->format('d-M-Y');
                } else {
                    return 'None';
                }
            })->addColumn('transaction_id', function ($transaction) {
                return $transaction->reference_number;
            })->addColumn('amount', function ($transaction) {
                if($transaction->artistPermitTransaction!='' || $transaction->eventTransaction!='') {
                    return number_format(($transaction->artistPermitTransaction? $transaction->artistPermitTransaction->sum('amount'):0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount'):0),2);
                }
                return number_format($transaction->amount,2);
            })->addColumn('vat', function ($transaction) {
                return number_format(($transaction->artistPermitTransaction? $transaction->artistPermitTransaction->sum('vat'):0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('vat'):0),2);
            })->addColumn('total', function ($transaction) {
                return number_format(($transaction->artistPermitTransaction? $transaction->artistPermitTransaction->sum('amount')+$transaction->artistPermitTransaction->sum('vat'):0) + ($transaction->eventTransaction ? $transaction->eventTransaction->sum('amount')+$transaction->eventTransaction->sum('vat'):0),2);
            })->addColumn('action', function ($transaction) {
                $transaction->transaction_id;
                return "<button style='height: 22px;line-height: 4px;border-radius: 3px;' class='btn btn-outline-warning btn-sm' onclick='transactionFunction($transaction->transaction_id)'>
         View
     </button>";
                    })
            ->rawColumns(['action','transaction_id','amount','vat','transaction_date'])->make(true);
   }
   public function transactionShow($id){
        $page_title='Transaction Report';
       $transaction=Transaction::where('transaction_id',$id)->with('eventTransaction')->with('artistPermitTransaction')->first();
       return view('admin.report.includes.transactionShow',compact('transaction','page_title'));
   }

}
