<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\ArtistPermit;
use App\ArtistPermitTransaction;
use App\Event;
use App\EventTransaction;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use function foo\func;

class TransactionReportController extends Controller
{
    //
    public function artistTransaction()
    {
        $artisttransactions = ArtistPermitTransaction::with('transaction')->orderBy('created_at', 'desc')->get();
        $eventtransactions = EventTransaction::with('transaction')->orderBy('created_at', 'desc')->get();
        $transactions = $artisttransactions->merge($eventtransactions);

        return Datatables::of($transactions)

            ->editColumn('transaction_date', function ($transaction) {
            if ($transaction->created_at) {
                return  Carbon::parse($transaction->created_at)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->addIndexColumn()->editColumn('created_at', function ($transaction) {
            if ($transaction->created_at) {
                return  Carbon::parse($transaction->created_at)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->editColumn('transaction_id', function ($transaction) {
            return $transaction->transaction->reference_number;
        })->editColumn('amount', function ($transaction) {
            return number_format($transaction->amount,2);
        })->editColumn('vat', function ($transaction) {
            return number_format($transaction->vat,2);
        })->editColumn('total', function ($transaction) {
            return number_format($transaction->amount + $transaction->vat,2);
        })->addColumn('action', function ($transaction)  {
            $transaction_id=$transaction->transaction->transaction_id;
            return "<button style='height: 22px;line-height: 4px;border-radius: 3px;' class='btn btn-outline-warning btn-sm' onclick='transactionFunction($transaction_id)'>
  View
</button>";

        })->rawColumns(['action','transaction_id','amount','vat'])->make(true);
    }

    public function sevenDaysArtist(){
        $start=Carbon::now()->subDays(7);
        $end=Carbon::now()->subDays(-1);
        $transactions = ArtistPermitTransaction::where('created_at', '>', $start)->where('created_at', '<', $end)->with('artistPermit')->whereHas('artistPermit', function ($q) {
              $q->with('artist')->with('permit');
        })
            ->whereHas('transaction', function ($query) {
                $query->with('company');
            })->with('transaction')
            ->get();
        return Datatables::of($transactions)
            ->addColumn('reference_number', function (ArtistPermitTransaction $user) {
                return $user->transaction->reference_number;
            })
            ->addColumn('transaction_type', function (ArtistPermitTransaction $user) {
                return $user->transaction->transaction_type;
            })
            ->addColumn('company', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->transaction->company ? $user->transaction->company->name_en : '') : ($user->transaction->company ? $user->transaction->company->name_en : '');
            })
            ->addColumn('permit_status', function (ArtistPermitTransaction $user) {
                return $user->permit ? $user->permit->permit_status : '';
            })
            ->addColumn('permit_number', function (ArtistPermitTransaction $user) {
                return $user->permit ? $user->permit->permit_number : '';
            })
            ->addColumn('vat', function (ArtistPermitTransaction $artist) {
                return $artist->vat;
            })
            ->addColumn('amount', function (ArtistPermitTransaction $artist) {
                return $artist->amount;

            })
            ->addColumn('artist_name', function (ArtistPermitTransaction $artist) {
                return Auth()->user()->LanguageId == 1 ? ($artist->artistPermit->firstname_en . ' ' . $artist->artistPermit->lastname_en) : ($artist->artistPermit->firstname_ar . ' ' . $artist->artistPermit->lastname_ar);
            })
            ->addColumn('profession', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->artistPermit->profession->name_en) : ($user->artistPermit->profession->name_ar);
            })
            ->addColumn('nationality', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->artistPermit->country->nationality_en : $user->artistPermit->country->nationality_ar;
            })
            ->addColumn('mobile_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->mobile_number;
            })
            ->addColumn('passport_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->passport_number;
            })
            ->addColumn('passport_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->passport_expire_date)->format('d-M-Y');
            })
            ->addColumn('uid_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->uid_number;
            })
            ->addColumn('uid_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->uid_expire_date)->format('d-M-Y');

            })
            ->addColumn('transaction_date', function (ArtistPermitTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            /*    ->addColumn('artist_permit_trans_id', function(ArtistPermitTransaction $user) {
                    $artistDetails=ArtistPermitTransaction::where('artist_permit_trans_id',$user->artist_permit_trans_id)->first();

                    return "<button type='button' style='height: 25px;
                                   line-height: 4px;
                                    border-radius: 3px;
                                   border: navajowhite;
                                   box-shadow: 0px 2px 5px -2px #0c0c0c;'  class='btn btn-primary btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                                   View</button>";
                })*/
            ->rawColumns(['reference_number', 'transaction_type', 'permit_number', 'permit_status', 'company', 'artist_name'/*,'artist_permit_trans_id'*/])
            ->make(true);
    }

    public function thirtyDaysartist(){
        $start=Carbon::now()->subDays(30);
        $end=Carbon::now()->subDays(-1);

        $transactions = ArtistPermitTransaction::where('created_at', '>', $start)->where('created_at', '<', $end)->with('artistPermit')->whereHas('artistPermit', function ($q) {
            $q->with('artist')->with('permit');
        })
            ->whereHas('transaction', function ($query) {
                $query->with('company');
            })->with('transaction')
            ->get();
        return Datatables::of($transactions)
            ->addColumn('reference_number', function (ArtistPermitTransaction $user) {
                return $user->transaction->reference_number;
            })
            ->addColumn('transaction_type', function (ArtistPermitTransaction $user) {
                return $user->transaction->transaction_type;
            })
            ->addColumn('company', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->transaction->company ? $user->transaction->company->name_en : '') : ($user->transaction->company ? $user->transaction->company->name_en : '');
            })
            ->addColumn('permit_status', function (ArtistPermitTransaction $user) {
                return $user->permit ? $user->permit->permit_status : '';
            })
            ->addColumn('permit_number', function (ArtistPermitTransaction $user) {
                return $user->permit ? $user->permit->permit_number : '';
            })
            ->addColumn('vat', function (ArtistPermitTransaction $artist) {
                return $artist->vat;
            })
            ->addColumn('amount', function (ArtistPermitTransaction $artist) {
                return $artist->amount;

            })
            ->addColumn('artist_name', function (ArtistPermitTransaction $artist) {
                return Auth()->user()->LanguageId == 1 ? ($artist->artistPermit->firstname_en . ' ' . $artist->artistPermit->lastname_en) : ($artist->artistPermit->firstname_ar . ' ' . $artist->artistPermit->lastname_ar);
            })
            ->addColumn('profession', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->artistPermit->profession->name_en) : ($user->artistPermit->profession->name_ar);
            })
            ->addColumn('nationality', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->artistPermit->country->nationality_en : $user->artistPermit->country->nationality_ar;
            })
            ->addColumn('mobile_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->mobile_number;
            })
            ->addColumn('passport_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->passport_number;
            })
            ->addColumn('passport_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->passport_expire_date)->format('d-M-Y');
            })
            ->addColumn('uid_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->uid_number;
            })
            ->addColumn('uid_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->uid_expire_date)->format('d-M-Y');

            })
            ->addColumn('transaction_date', function (ArtistPermitTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            /*    ->addColumn('artist_permit_trans_id', function(ArtistPermitTransaction $user) {
                    $artistDetails=ArtistPermitTransaction::where('artist_permit_trans_id',$user->artist_permit_trans_id)->first();

                    return "<button type='button' style='height: 25px;
                                   line-height: 4px;
                                    border-radius: 3px;
                                   border: navajowhite;
                                   box-shadow: 0px 2px 5px -2px #0c0c0c;'  class='btn btn-primary btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                                   View</button>";
                })*/
            ->rawColumns(['reference_number', 'transaction_type', 'permit_number', 'permit_status', 'company', 'artist_name'/*,'artist_permit_trans_id'*/])
            ->make(true);
    }

    public function customDaysartist(Request $request){

        dd('dfxgbfxc');
        $transactions = ArtistPermitTransaction::whereDate('created_at', '>', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->with('artistPermit')->whereHas('artistPermit', function ($q) {
            $q->with('artist')->with('permit');
        })
            ->whereHas('transaction', function ($query) {
                $query->with('company');
            })->with('transaction')
            ->get();
        return Datatables::of($transactions)
            ->addColumn('reference_number', function (ArtistPermitTransaction $user) {
                return $user->transaction->reference_number;
            })
            ->addColumn('transaction_type', function (ArtistPermitTransaction $user) {
                return $user->transaction->transaction_type;
            })
            ->addColumn('company', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->transaction->company ? $user->transaction->company->name_en : '') : ($user->transaction->company ? $user->transaction->company->name_en : '');
            })
            ->addColumn('permit_status', function (ArtistPermitTransaction $user) {
                return $user->permit ? $user->permit->permit_status : '';
            })
            ->addColumn('permit_number', function (ArtistPermitTransaction $user) {
                return $user->permit ? $user->permit->permit_number : '';
            })
            ->addColumn('vat', function (ArtistPermitTransaction $artist) {
                return $artist->vat;
            })
            ->addColumn('amount', function (ArtistPermitTransaction $artist) {
                return $artist->amount;

            })
            ->addColumn('artist_name', function (ArtistPermitTransaction $artist) {
                return Auth()->user()->LanguageId == 1 ? ($artist->artistPermit->firstname_en . ' ' . $artist->artistPermit->lastname_en) : ($artist->artistPermit->firstname_ar . ' ' . $artist->artistPermit->lastname_ar);
            })
            ->addColumn('profession', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? ($user->artistPermit->profession->name_en) : ($user->artistPermit->profession->name_ar);
            })
            ->addColumn('nationality', function (ArtistPermitTransaction $user) {
                return Auth()->user()->LanguageId == 1 ? $user->artistPermit->country->nationality_en : $user->artistPermit->country->nationality_ar;
            })
            ->addColumn('mobile_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->mobile_number;
            })
            ->addColumn('passport_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->passport_number;
            })
            ->addColumn('passport_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->passport_expire_date)->format('d-M-Y');
            })
            ->addColumn('uid_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->uid_number;
            })
            ->addColumn('uid_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->uid_expire_date)->format('d-M-Y');

            })
            ->addColumn('transaction_date', function (ArtistPermitTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d-M-Y');
            })
            /*    ->addColumn('artist_permit_trans_id', function(ArtistPermitTransaction $user) {
                    $artistDetails=ArtistPermitTransaction::where('artist_permit_trans_id',$user->artist_permit_trans_id)->first();

                    return "<button type='button' style='height: 25px;
                                   line-height: 4px;
                                    border-radius: 3px;
                                   border: navajowhite;
                                   box-shadow: 0px 2px 5px -2px #0c0c0c;'  class='btn btn-primary btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                                   View</button>";
                })*/
            ->rawColumns(['reference_number', 'transaction_type', 'permit_number', 'permit_status', 'company', 'artist_name'/*,'artist_permit_trans_id'*/])
            ->make(true);
    }


    //END ARTIST SECTION

    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    //START EVENT SECTION

    public function eventTransaction()
    {
        $transactions = EventTransaction::with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('company')->with('emirate')->with('country');
        })->with('transaction')->get();

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
       })->with('transaction')->get();

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

    public function sevenDaysEvent(){
        $start = Carbon::now()->subDays(7);
        $end = Carbon::now()->subDays(-1);
        $transactions = EventTransaction::where('created_at', '>', $start)->where('created_at', '<', $end)->with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('company')->with('emirate')->with('country');
        })->with('transaction')->get();

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
    public function thirtyDaysEvent(){
        $start = Carbon::now()->subDays(30);
        $end = Carbon::now()->subDays(-1);
        $transactions = EventTransaction::where('created_at', '>', $start)->where('created_at', '<', $end)->with('event')->whereHas('event', function ($q) {
            $q->with('type')->with('company')->with('emirate')->with('country');
        })->with('transaction')->get();

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
    public function transactionShow($id){
        $transaction=Transaction::where('transaction_id',$id)->with('eventTransaction')->with('artistPermitTransaction')->first();
    //  dd($transaction);
        $page_title='Transaction Report';
        return view('admin.report.includes.transactionShow',compact('transaction','page_title'));
    }
}
