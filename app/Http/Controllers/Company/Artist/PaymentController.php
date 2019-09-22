<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Artist;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;


class PaymentController extends Controller
{

    // Make Payment Function

    public function make_payment($id)
    {
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('permit_id', $id)->first();
        return view('permits.artist.payment.payment', $data_bundle);
    }

    // Payment Gateway


    public function payment_gateway($id)
    {
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('permit_id', $id)->first();
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


    public function pay_fee($id)
    {
        $permit_number = $this->generatePermitNumber();
        Permit::where('permit_id', $id)->update(['permit_status' => 'active', 'permit_number' => $permit_number]);
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
