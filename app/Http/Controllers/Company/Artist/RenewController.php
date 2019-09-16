<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;
use Auth;
use App\ArtistTempData;
use App\ArtistTempDocument;


class RenewController extends Controller
{

    public function renew_permit($id)
    {
        $old_permit_number = Permit::where('permit_id', $id)->latest()->value('permit_number');
        $number = explode('-', $old_permit_number);
        $new_pn = isset($number[1]) ? $number[0] . '-' . $number[1] + 1 : $old_permit_number . '-' . '01';

        $data_bundle['permit_id'] = $id;
        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('permit_id', $id)->first();
        $data_bundle['issued_date'] = $permit_details->expired_date;
        $data_bundle['expired_date'] = date('Y/m/d', strtotime('+30 days', strtotime($permit_details->expired_date)));
        $data_bundle['work_location'] = $permit_details->work_location;
        $row_exists = ArtistTempData::where('permit_id', $id)->exists();

        if (!$row_exists) {
            foreach ($permit_details->artistPermit as $pd) {
                ArtistTempData::create([
                    'firstname_en' => $pd->artist['firstname_en'],
                    'firstname_ar' =>  $pd->artist['firstname_ar'],
                    'lastname_en' =>  $pd->artist['lastname_en'],
                    'lastname_ar' =>  $pd->artist['lastname_ar'],
                    'nationality' =>  $pd->artist['nationality'],
                    'gender' =>  $pd->artist['gender'],
                    'birthdate' =>  $pd->artist['birthdate'] ? Carbon::parse($pd->artist['birthdate'])->toDateString() : '',
                    'artist_id' => $pd->artist_id,
                    'permit_id' => $pd->permit_id,
                    'permit_type_id' => $pd->permit_type_id,
                    'original' => $pd->permit_id,
                    'thumbnail' => $pd->permit_id,
                    'passport_number' => $pd->passport_number,
                    'uid_number' => $pd->uid_number,
                    'uid_expire_date' => $pd->uid_expire_date ? Carbon::parse($pd->uid_expire_date)->toDateString() : '',
                    'passport_expire_date' => $pd->passport_expire_date ? Carbon::parse($pd->passport_expire_date)->toDateString() : '',
                    'visa_type' => $pd->visa_type,
                    'visa_number' => $pd->visa_number,
                    'visa_expire_date' => $pd->visa_expire_date ? Carbon::parse($pd->visa_expire_date)->toDateString() : '',
                    'sponsor_name_en' => $pd->sponsor_name_en,
                    'sponsor_name_ar' => $pd->sponsor_name_ar,
                    'language' => $pd->language,
                    'religion' => $pd->religion,
                    'city' => $pd->city,
                    'fax_number' => $pd->fax_number,
                    'po_box' => $pd->po_box,
                    'area' => $pd->area,
                    'address_en' => $pd->address_en,
                    'address_ar' => $pd->address_ar,
                    'mobile_number' => $pd->mobile_number,
                    'phone_number' => $pd->phone_number,
                    'status' => 0,
                    'email' => $pd->email,
                    'emirates_id' => $pd->emirates_id,
                    'artist_permit_id' => $pd->artist_permit_id,
                    'person_code' => $pd->artist['person_code']
                ]);
            }
        }

        $data_bundle['permit_details'] =  Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('permit_id', $id)->first();
        $data_bundle['artist_details'] = ArtistTempData::where('permit_id', $id)->where('status', 0)->get();
        $data_bundle['new_permit_num'] = $new_pn;
        return view('permits.artist.renew.renew_permit', $data_bundle);
    }


    public function move_temp_to_permit_renew(Request $request)
    {
        $permit_number = $request->permit_number;

        $permit_id = $request->permit_id;

        $artist_temp_data = ArtistTempData::with('ArtistTempDocument')->where('permit_id', $permit_id)->get();

        $last_permit_d = Permit::latest()->first();
        $new_refer_no = sprintf("%04d", $last_permit_d->reference_number  ? $last_permit_d->reference_number + 1 : 1);

        $permit = Permit::create([
            'work_location' => $request->work_location,
            'issued_date' => $request->issued_date ? Carbon::parse($request->issued_date)->toDateString() : '',
            'expired_date' => $request->expired_date ? Carbon::parse($request->expired_date)->toDateString() : '',
            'permit_number' => $permit_number,
            'reference_number' => $new_refer_no,
            'permit_status' => 'pending',
            'request_type' => 'new',
            'user_id' => Auth::user()->user_id,
            'created_by' => Auth::user()->user_id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'company_id' => Auth::user()->EmpClientId
        ]);

        // $artists_of_permit = ArtistPermit::with('permit')->where('permit_id', $permit_id)->get();

        foreach ($artist_temp_data as $data) {
            if ($data->status == 1) {
                ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update([
                    'artist_permit_status' => 'inactive'
                ]);
            } else {

                $updateArray = [
                    // 'artist_id' => $data->artist_id,
                    // 'permit_id' => $data->permit_id,
                    'permit_type_id' => $data->permit_type_id,
                    'original' => $data->original,
                    'thumbnail' => $data->thumbnail,
                    'passport_number' => $data->passport_number,
                    'uid_number' => $data->uid_number,
                    'uid_expire_date' => $data->uid_expire_date ? Carbon::parse($data->uid_expire_date)->toDateString() : '',
                    'passport_expire_date' => $data->passport_expire_date ? Carbon::parse($data->passport_expire_date)->toDateString() : '',
                    'visa_type' => $data->visa_type,
                    'visa_number' => $data->visa_number,
                    'visa_expire_date' => $data->visa_expire_date ? Carbon::parse($data->visa_expire_date)->toDateString() : '',
                    'sponsor_name_en' => $data->sponsor_name_en,
                    'language' => $data->language,
                    'religion' => $data->religion,
                    'city' => $data->city,
                    'fax_number' => $data->fax_number,
                    'po_box' => $data->po_box,
                    'area' => $data->area,
                    'address_en' => $data->address_en,
                    'mobile_number' => $data->mobile_number,
                    'phone_number' => $data->phone_number,
                    'email' => $data->email,
                    'emirates_id' => $data->emirates_id,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'updated_by' => Auth::user()->user_id
                ];

                if ($data->artist_permit_id) {
                    $artistPermit =  ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update($updateArray);
                    $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                    $artist_old_documents = ArtistPermitDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                } else {
                    $artistPermit =   ArtistPermit::create($updateArray);
                    $artistPermit->created_at = Carbon::now()->toDateTimeString();
                    $artistPermit->created_by =  Auth::user()->user_id;
                    $artistPermit->save();

                    $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->id)->get();
                }

                foreach ($artist_temp_document as $atd) {
                    ArtistPermitDocument::create([
                        'issued_date' => $atd->issued_date != null ? Carbon::parse($atd->issued_date)->toDateString() : '',
                        'expired_date' => $atd->expired_date != null ? Carbon::parse($atd->expired_date)->toDateString() : '',
                        'created_at' =>  Carbon::now()->toDateTimeString(),
                        'created_by' =>  Auth::user()->user_id,
                        'path' =>  $atd->path,
                        'document_name' => $atd->document_name,
                        'artist_permit_id' => $artistPermit->artist_permit_id
                    ]);

                    if ($data->artist_permit_id) {
                        foreach ($artist_old_documents as $aod) {
                            ArtistPermitDocument::where('permit_document_id', $aod->permit_document_id)->update(['status' => 'inactive']);
                        }
                    }
                }
            }
        }

        if ($permit) {
            $message = ['success', 'Permit Re-Submitted Successfully', 'Success'];
        } else {
            $message = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $message]);
    }
}
