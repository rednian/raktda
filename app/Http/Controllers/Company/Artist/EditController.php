<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;
use App\ArtistPermit;
use App\Requirement;
use App\PermitType;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Areas;
use App\VisaType;
use App\ArtistTempData;

class ArtistController extends Controller
{

    public function edit_permit($id)
    {
        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('permit_id', $id)->first();

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
        $data_bundle['staff_comments'] = PermitComment::where('permit_id', $id)->get();
        return view('permits.artist.edit.edit_permit', $data_bundle);
    }

    public function edit_artist($from, $id)
    {
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('demonym')->sort();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['visa_types'] = VisaType::all();
        $data_bundle['artist_details'] = ArtistTempData::with('permitType', 'ArtistTempDocument')->where('id', $id)->first();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'permitType')->where('artist_permit_id', $id)->first();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        $data_bundle['from'] = $from;
        return view('permits.artist.edit_artist', $data_bundle);
    }

    public function edit_edit_artist($artist_permit_id)
    {
        $check_exists = ArtistPermitCheck::where('artist_permit_id', $artist_permit_id)->exists();
        if ($check_exists) {
            $result = ArtistPermitCheck::with('checklist')->where('artist_permit_id', $artist_permit_id)->latest()->first();
            // $result = ArtistPermitChecklist::where('artist_permit_check_id', $check_id)->get();
        } else {
            $result = null;
        }
        $data_bundle['field_list'] = $result;
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('demonym')->sort();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['visa_types'] = VisaType::all();
        $data_bundle['areas'] = Areas::all();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'artistPermitDocument', 'permitType', 'permit')->where('artist_permit_id', $artist_permit_id)->first();
        $data_bundle['artist_details'] = ArtistTempData::with('permitType', 'artistPermitDocument')->where('artist_permit_id', $artist_permit_id)->first();
        return view('permits.artist.edit.edit_edit_artist', $data_bundle);
    }


    public function get_error_fields_list(Request $request)
    {
        $artist_permit_id = $request->artist_permit_id;
        $check_exists = ArtistPermitCheck::where('artist_permit_id', $artist_permit_id)->exists();
        if ($check_exists) {
            $result = ArtistPermitCheck::with('checklist')->where('artist_permit_id', $artist_permit_id)->latest()->first();
            // $result = ArtistPermitChecklist::where('artist_permit_check_id', $check_id)->get();
        } else {
            $result = null;
        }
        return $result;
    }

    public function update_checklist($id)
    {
        ArtistPermitCheck::where('artist_permit_id', $id)->update(['status' => 1]);
    }
}
