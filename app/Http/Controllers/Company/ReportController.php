<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use Auth;
use App\Transaction;
use App\EventTransaction;
use App\ArtistPermitTransaction;
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
            $company = Auth::user()->EmpClientId;
            $user = Auth::user()->user_id;
            $artisttransactions = ArtistPermitTransaction::with(['transaction' => function($q) use($company, $user){
                $q->where([
                    'company_id' => $company,
                    'created_by' => $user
                    ]);
            }])->orderBy('created_at', 'desc')->get();

            $eventtransactions = EventTransaction::with(['transaction' => function($q) use($company, $user){
                $q->where([
                    'company_id' => $company,
                    'created_by' => $user
                    ]);
            }])->orderBy('created_at', 'desc')->get();

            $transactions = $artisttransactions->merge($eventtransactions);

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
            return $transaction->transaction->reference_number;
            })->editColumn('transaction_no', function ($transaction) {
                return $transaction->transaction->payment_transaction_id;
            })->editColumn('receipt_no', function ($transaction) {
                return $transaction->transaction->payment_receipt_no;
            })->editColumn('amount', function ($transaction) {
                return number_format($transaction->amount,2);
            })->editColumn('vat', function ($transaction) {
                return number_format($transaction->vat,2);
            })->editColumn('total', function ($transaction) {
                $total = (double)$transaction->amount + (double)$transaction->vat;
                return number_format($total,2);
            })->editColumn('from', function ($transaction) {
                return ucwords($transaction->transaction->transaction_type);
            })->addColumn('action', function ($transaction)  {
                return  '<a href="'  . \Illuminate\Support\Facades\URL::signedRoute('report.view', ['id' => $transaction->transaction->transaction_id]) .  '"><span  class="kt-badge kt-badge--warning kt-badge--inline kt-margin-b-5">'.__('View').'</span></a>';
                
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

}