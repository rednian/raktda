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


    public function happiness_meter($id)
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
