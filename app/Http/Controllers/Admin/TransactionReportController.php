<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\ArtistPermit;
use App\ArtistPermitTransaction;
use App\Event;
use App\EventTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionReportController extends Controller
{
    //
    public function artistTransaction()
    {
        $transactions = ArtistPermitTransaction::with('artistPermit')->whereHas('artistPermit', function ($q) {
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
                return \Carbon\Carbon::parse($user->artistPermit->passport_expire_date)->format('d/m/Y');
            })
            ->addColumn('uid_number', function (ArtistPermitTransaction $user) {
                return $user->artistPermit->uid_number;
            })
            ->addColumn('uid_expire_date', function (ArtistPermitTransaction $user) {
                return \Carbon\Carbon::parse($user->artistPermit->uid_expire_date)->format('d/m/Y');

            })
            ->addColumn('transaction_date', function (ArtistPermitTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d/m/Y');
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
                return \Carbon\Carbon::parse($user->event->issued_date)->format('d/m/Y');
            })
            ->addColumn('expired_date', function (EventTransaction $user) {
                return \Carbon\Carbon::parse($user->event->expired_date)->format('d/m/Y');

            })
            ->addColumn('transaction_date', function (EventTransaction $artist) {
                return \Carbon\Carbon::parse($artist->transaction->transaction_date)->format('d/m/Y');
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
}
