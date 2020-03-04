<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use Auth;
use PDF;
use App\Transaction;
use App\EventTransaction;
use App\ArtistPermitTransaction;
use App\ArtistTempData;
use App\Permit;
use App\Event;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        return view('permits.reports.transactions');
    }

    public function transactions(Request $request)
    {
        if($request->ajax())
        {
            $made_from = $request->made_from;
            $date = $request->date;
            $company = Auth::user()->EmpClientId;
            $user = Auth::user()->user_id;
            // $artisttransactions = ArtistPermitTransaction::with(['transaction' => function($q) use($company, $user){
            //     $q->where([
            //         'company_id' => $company,
            //         'created_by' => $user
            //         ]);
            // }])->when($made_from, function($q) use ($made_from){
            //     $q->whereHas('transaction', function($q) use ($made_from){
            //         $q->where('transaction_type', $made_from);
            //     });
            // })->when($date, function ($q) use ($date){
            //     $q->whereHas('transaction', function($q) use ($date){
            //     $q->whereDate('created_at', '>=', Carbon::parse($date['start'])->startOfDay()->toDateTimeString())
            //         ->whereDate('created_at', '<=', Carbon::parse($date['end'])->endOfDay()->toDateTimeString());
            //     });
            // })->orderBy('created_at', 'desc')->get();

            // $eventtransactions = EventTransaction::with(['transaction' => function($q) use($company, $user){
            //     $q->where([
            //         'company_id' => $company,
            //         'created_by' => $user
            //         ]);
            // }])->when($made_from, function($q) use ($made_from){
            //     $q->whereHas('transaction', function($q) use ($made_from){
            //         $q->where('transaction_type', $made_from);
            //     });
            // })->when($date, function ($q) use ($date){
            //     $q->whereHas('transaction', function($q) use ($date){
            //         $q->whereDate('created_at', '>=', Carbon::parse($date['start'])->startOfDay()->toDateTimeString())
            //         ->whereDate('created_at', '<=', Carbon::parse($date['end'])->endOfDay()->toDateTimeString());
            //     });
            // })->orderBy('created_at', 'desc')->get();

            // $transactions = $artisttransactions->merge($eventtransactions);

            $transactions = Transaction::with('artistPermitTransaction', 'eventTransaction')->when($made_from, function($q) use ($made_from){
                    $q->where('transaction_type', $made_from);
            })->when($date, function ($q) use ($date){
                $q->whereDate('created_at', '>=', Carbon::parse($date['start'])->startOfDay()->toDateTimeString())
                    ->whereDate('created_at', '<=', Carbon::parse($date['end'])->endOfDay()->toDateTimeString());
            })->where('company_id', $company)->where('created_by', $user)->orderBy('created_at', 'desc')->get();

            // dd($transactions);

            return Datatables::of($transactions)->editColumn('transaction_date', function ($transaction) {
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
            return $transaction->reference_number;
            })->editColumn('transaction_no', function ($transaction) {
                return $transaction->payment_transaction_id;
            })->editColumn('receipt_no', function ($transaction) {
                return $transaction->payment_receipt_no;
            })->editColumn('amount', function ($transaction) {
               
                if($transaction->artistPermitTransaction()->exists() && $transaction->eventTransaction()->exists() )
                {
                    $total = (double)$transaction->artistPermitTransaction->sum('amount') + (double) $transaction->eventTransaction->sum('amount');
                    return number_format($total,2);
                }else if($transaction->artistPermitTransaction()->exists()) {
                    return number_format($transaction->artistPermitTransaction->sum('amount'),2);
                }else {
                    return number_format($transaction->eventTransaction->sum('amount'),2);
                }
            })->editColumn('vat', function ($transaction) {
                if($transaction->artistPermitTransaction()->exists() && $transaction->eventTransaction()->exists() )
                {
                    $total = (double) $transaction->artistPermitTransaction->sum('vat') + (double) $transaction->eventTransaction->sum('vat');
                    return number_format($total,2);
                }else if($transaction->artistPermitTransaction()->exists()) {
                    return number_format($transaction->artistPermitTransaction->sum('vat'),2);
                }else {
                    return number_format($transaction->eventTransaction->sum('vat'),2);
                }
            })->editColumn('total', function ($transaction) {
                if($transaction->artistPermitTransaction()->exists() && $transaction->eventTransaction()->exists() )
                {
                    $total = (double)$transaction->artistPermitTransaction->sum('amount') + (double) $transaction->eventTransaction->sum('amount') + (double)$transaction->artistPermitTransaction->sum('vat') + (double) $transaction->eventTransaction->sum('vat');
                    return number_format($total,2);
                }else if($transaction->artistPermitTransaction()->exists()) {
                    $total = (double)$transaction->artistPermitTransaction->sum('amount') +(double)$transaction->artistPermitTransaction->sum('vat');
                    return number_format($total,2);
                }else {
                    $total = (double)$transaction->eventTransaction->sum('amount') +(double)$transaction->eventTransaction->sum('vat');
                    return number_format($total,2);
                }
                // $total = (double)$transaction->amount + (double)$transaction->vat;
                // return number_format($total,2);
            })->editColumn('from', function ($transaction) {
                $type = $transaction->transaction_type == 'artist' ? __('Artist') : __('Event');
                return ucwords(__("$type Permit"));
            })->addColumn('action', function ($transaction)  {
                return  '<a href="'  . \Illuminate\Support\Facades\URL::signedRoute('report.view', ['id' => $transaction->transaction_id]) .  '"><button  class="btn btn-sm btn-secondary btn-hover-warning">'.__('View').'</button></a>';
                
            })->rawColumns(['action'])->make(true);
        }
    }

    public function show(Request $request, $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data['transaction'] = Transaction::with('artistPermitTransaction', 'eventTransaction')->where('transaction_id', $id)->latest()->first();

        return view('permits.reports.view_transaction', $data );
    }

    public function showevent(Request $request, $id){
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $event = \App\Event::where('event_id', $id)->latest()->first();
        if ($event->permit) {
            $permit_id = $event->permit->permit_id;
            $artist = \App\Permit::where('permit_id', $permit_id)->with('artistPermit')->where('created_by', Auth::user()->user_id)->first();
        } else {
            $artist = [];
        }
        $data['truck_req'] = \App\Requirement::where('requirement_type', 'truck')->get();
        $data['liquor_req'] = \App\Requirement::where('requirement_type', 'liquor')->get();
        $data['emirates'] = \App\Emirates::all()->sortBy('name_en');
        $data['eventReq'] = $event->requirements()->get();
        $data['event'] = $event;
        $data['artist'] = $artist;
        $data['tab'] =  $request->tab;
        $data['eventImages']  = $event->otherUpload;
    
        return view('permits.reports.show_event', $data);
    }

    public function transactionprint(Request $request, $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $transaction = Transaction::where('transaction_id', $id)->latest()->first();
        $data['transaction'] = $transaction;
        return view('permits.reports.voucher_print', $data);
        // $pdf = PDF::loadView('permits.reports.voucher_print', $data, [], [
        //     'title' => 'Payment Voucher',
        //     'default_font_size' => 10
        // ]);

        // return $pdf->stream('Payment Voucher '.$transaction->transaction_id.'.pdf', "S");
    }

    public function dashboard()
    {
        $user = Auth::user()->user_id ;
        Permit::where('created_by', $user)->update(['is_edit' => 0]);
        ArtistTempData::where('created_by', $user)->where('status' , 0)->delete();
        Permit::whereDate('expired_date', '<', Carbon::now())->update(['permit_status' => 'expired']);

        $permit = Permit::where('created_by', $user);
        $artistTempData = ArtistTempData::where('created_by', $user);
        $event = Event::where('created_by', $user);
        
        $data['artist_applied'] = $permit->whereIn('permit_status',['new', 'modification-request', 'amended', 'approved-unpaid'])->count();
        $data['artist_valid'] = $permit->where('permit_status', 'active')->count();
        $data['artist_drafts'] = $artistTempData->where('status', 5)->distinct('permit_id')->count();
        $data['artist_expired'] = $permit->where('permit_status', 'expired')->count();
        $data['artist_cancelled'] = $permit->whereIn('permit_status',['cancelled', 'rejected'])->count();

        $data['event_applied'] = $event->whereIn('status', ['new', 'amended', 'amended', 'approved-unpaid'])->count();
        $data['event_valid'] = $event->where('status', 'active')->count();
        $data['event_drafts'] = $event->where('status','draft')->count();
        $data['event_expired'] = $event->where('status','expired')->count();
        $data['event_cancelled'] = $event->whereIn('status', ['cancelled', 'rejected'])->count();

        return view('permits.dashboard', $data);
    }

    public function filterdashboard(Request $request)
    {
        $filter_value = $request->filterby;
        $user = Auth::user()->user_id ;
        $permit = Permit::where('created_by', $user);
        $artistTempData = ArtistTempData::where('created_by', $user);
        $event = Event::where('created_by', $user);

        if($filter_value == 'today'){
            $permit->whereDate('created_at', '=', Carbon::today()->toDateString());
            $artistTempData->whereDate('created_at', '=', Carbon::today()->toDateString());
            $event->whereDate('created_at', '=', Carbon::today()->toDateString());
        }else if($filter_value == 'lastweek') {
            $permit->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString());
            $artistTempData->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString());
            $event->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString());
        }else if($filter_value == 'lastthirty') {
            $permit->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString());
            $artistTempData->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString());
            $event->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString());
        }
        
        $data['artist_applied'] = $permit->whereIn('permit_status',['new', 'modification-request', 'amended', 'approved-unpaid'])->count();
        $data['artist_valid'] = $permit->where('permit_status', 'active')->count();
        $data['artist_drafts'] = $artistTempData->where('status', 5)->distinct('permit_id')->count();
        $data['artist_expired'] = $permit->where('permit_status', 'expired')->count();
        $data['artist_cancelled'] = $permit->whereIn('permit_status',['cancelled', 'rejected'])->count();

        $data['event_applied'] = $event->whereIn('status', ['new', 'amended', 'amended', 'approved-unpaid'])->count();
        $data['event_valid'] = $event->where('status', 'active')->count();
        $data['event_drafts'] = $event->where('status','draft')->count();
        $data['event_expired'] = $event->where('status','expired')->count();
        $data['event_cancelled'] = $event->whereIn('status', ['cancelled', 'rejected'])->count();

        return $data;
    }

}