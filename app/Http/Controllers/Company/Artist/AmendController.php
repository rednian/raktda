<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Countries;
use Carbon\Carbon;
use App\ArtistPermit;
use App\Permit;
use App\Requirement;
use App\PermitType;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Profession;
use App\Areas;
use App\VisaType;
use App\ArtistTempData;
use App\ArtistTempDocument;

class AmendController extends Controller
{

    public function amend_permit($id)
    {
        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.permitType')->where('permit_id', $id)->first();

        $is_edit =  Permit::where('permit_id', $id)->value('is_edit');

        if ($is_edit == 0) {

            ArtistTempData::where('permit_id', $id)->delete();
            ArtistTempDocument::where('permit_id', $id)->delete();

            foreach ($permit_details->artistPermit as $pd) {


                $artist_temp =  ArtistTempData::updateOrCreate([
                    'firstname_en' => $pd->artist['firstname_en'],
                    'firstname_ar' =>  $pd->artist['firstname_ar'],
                    'lastname_en' =>  $pd->artist['lastname_en'],
                    'lastname_ar' =>  $pd->artist['lastname_ar'],
                    'nationality' =>  $pd->artist['nationality'],
                    'gender' =>  $pd->artist['gender_id'],
                    'birthdate' =>  $pd->artist['birthdate'] ? Carbon::parse($pd->artist['birthdate'])->toDateString() : '',
                    'artist_id' => $pd->artist_id,
                    'permit_id' => $pd->permit_id,
                    'profession' => $pd->profession_id,
                    'permit_type_id' => $pd->permit_type_id,
                    'original' => $pd->original,
                    'thumbnail' => $pd->thumbnail,
                    'passport_number' => $pd->passport_number,
                    'uid_number' => $pd->uid_number,
                    'uid_expire_date' => $pd->uid_expire_date ? Carbon::parse($pd->uid_expire_date)->toDateString() : '',
                    'passport_expire_date' => $pd->passport_expire_date ? Carbon::parse($pd->passport_expire_date)->toDateString() : '',
                    'visa_type' => $pd->visa_type_id,
                    'visa_number' => $pd->visa_number,
                    'visa_expire_date' => $pd->visa_expire_date ? Carbon::parse($pd->visa_expire_date)->toDateString() : '',
                    'sponsor_name_en' => $pd->sponsor_name_en,
                    'sponsor_name_ar' => $pd->sponsor_name_ar,
                    'language' => $pd->language_id,
                    'religion' => $pd->religion_id,
                    'city' => $pd->emirate_id,
                    'fax_number' => $pd->fax_number,
                    'po_box' => $pd->po_box,
                    'area' => $pd->area_id,
                    'address_en' => $pd->address_en,
                    'address_ar' => $pd->address_ar,
                    'mobile_number' => $pd->mobile_number,
                    'phone_number' => $pd->phone_number,
                    'status' => 0,
                    'email' => $pd->email,
                    'emirates_id' => $pd->identification_number,
                    'artist_permit_id' => $pd->artist_permit_id,
                    'person_code' => $pd->artist['person_code'],
                    'is_old_artist' => 2,
                    'artist_permit_status' => $pd->artist_permit_status
                ]);

                $permit_details = \App\ArtistPermitDocument::where('artist_permit_id', $pd->artist_permit_id)->orderBy('created_at', 'desc')->get()->unique('document_name');

                foreach ($pd->artistPermitDocument as $ap) {
                    ArtistTempDocument::create([
                        'status' => 2,
                        'issued_date' => $ap->issued_date,
                        'expired_date' => $ap->expired_date,
                        'path' => $ap->path,
                        'document_name' => $ap->document_name,
                        'artist_permit_id' => $ap->artist_permit_id,
                        'permit_id' => $pd->permit_id,
                        'temp_data_id' => $artist_temp->id,
                        'doc_id' => $ap->permit_document_id,
                        'created_at' => $ap->created_at,
                        'updated_at' => $ap->updated_at
                    ]);
                }
            }
        }

        Permit::where('permit_id', $id)->update(['is_edit' => 1]);

        $data_bundle['permit_details'] =  Permit::where('permit_id', $id)->first();
        $data_bundle['artist_details'] = ArtistTempData::where('permit_id', $id)->where('status', 0)->get();
        return view('permits.artist.amend.amend_permit', $data_bundle);
    }

    public function replace_artist($temp_id)
    {
        // $artist_permit_id = ArtistTempData::where('id', $temp_id)->value('artist_permit_id');
        $permit_id = ArtistTempData::where('id', $temp_id)->value('permit_id');

        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::orderBy('country_enNationality', 'asc')->get();
        $data_bundle['visa_types'] = VisaType::orderBy('visa_type_en', 'asc')->get();
        $data_bundle['permitTypes'] = PermitType::orderBy('name_en', 'asc')
            ->where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['languages'] = Language::orderBy('name_en', 'asc')->get();
        $data_bundle['religions'] = Religion::orderBy('name_en', 'asc')->get();
        $data_bundle['emirates'] = Emirates::orderBy('name_en', 'asc')->get();
        $data_bundle['areas'] = Areas::orderBy('area_en', 'asc')->get();
        $data_bundle['profession'] = Profession::orderBy('name_en', 'asc')->get();


        $data_bundle['permit_details'] = Permit::where('permit_id', $permit_id)->first();
        $data_bundle['artist_details'] = ArtistTempData::where('id', $temp_id)->where('status', 0)->first();

        return view('permits.artist.amend.replace_artist', $data_bundle);
    }
}
