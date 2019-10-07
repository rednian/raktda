<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Artist;
use App\ArtistPermit;
use App\Permit;
use App\Transaction;
use App\ArtistPermitTransaction;
use Auth;


class PaymentController extends Controller
{

    // Make Payment Function

    public function make_payment($id)
    {
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('permit_id', $id)->first();
        return view('permits.artist.payment.payment', $data_bundle);
    }

    // Payment Gateway


    public function payment_gateway(Permit $permit)
    {
        $id = $permit->permit_id;
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('permit_id', $id)->first();
        return view('permits.artist.payment.payment_gateway', $data_bundle);
    }

    public function generatePermitNumber()
    {
        // $last_permit_d = Permit::latest()->first();
        $last_permit_d = Permit::orderBy('created_at', 'desc')->where('permit_number', 'not like', '%-%')->first();

        if (!isset($last_permit_d->permit_number)) {
            $new_permit_no = sprintf("AP%04d",  1);
        } else {
            $last_pn = $last_permit_d->permit_number;
            $n = substr($last_pn, 2);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_permit_no = sprintf("AP%0" . $x . "d", $n + 1);
        }
        return $new_permit_no;
    }


    public function payment(Request $request, Permit $permit)
    {
        $transArr = Transaction::create([
            'transaction_type' => 'artist',
            'transaction_date' => Carbon::now(),
            'company_id' => Auth::user()->EmpClientId,
        ]);

        foreach ($permit->artistPermit() as $artist) {
            $transArr->artistPermitTransaction()->create([
                'vat' => $artist->profession->amount * 0.05,
                'amount' => $artist->profession->amount,
                'artist_permit_id' => $artist->artist_permit_id,
                'transaction_id' => $transArr->transaction_id
            ]);
        }

        $permit_number = $this->generatePermitNumber();

        $issued_date = strtotime($permit->issued_date);
        $expired_date = strtotime($permit->exprired_date);
        $today_date = strtotime(date('Y-m-d'));

        $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);

        if ($issued_date <= $today_date) {
            $new_issued_date = date('Y-m-d');
            $new_expiry_date = date('Y-m-d', strtotime($new_issued_date . ' + ' . $diff . ' days'));
            $permit->update(['issued_date' =>  $new_issued_date, 'expired_date' => $new_expiry_date]);
        }

        $permit->update(['permit_status' => 'active', 'permit_number' => $permit_number]);

        if ($transArr) {
            $result = ['success', 'Payment Done Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return redirect('company/happiness_center/' . $permit->permit_id);
    }

    public function happiness_center($id)
    {
        return view('permits.artist.happinessmeter', ['id' => $id]);
    }

    public function submit_happiness(Request $request)
    {
        $id = $request->permit_id;
        $rating = $request->rating;

        // $device = Device::findOrFail($id);

        $artists = ArtistPermit::findOrFail($id);

        $artists->update([
            'meter' => $rating
        ]);

        return view('permits.happinessmeter', ['id' => $id]);
    }
}
