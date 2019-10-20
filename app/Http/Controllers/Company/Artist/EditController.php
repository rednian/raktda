<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Countries;
use App\ArtistPermit;
use App\Requirement;
use App\PermitComment;
use App\ArtistPermitCheck;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Areas;
use App\Permit;
use Carbon\Carbon;
use App\VisaType;
use App\Profession;
use App\ArtistTempData;
use App\ArtistTempDocument;
use Cookie;

class EditController extends Controller
{

    public function edit_permit($id)
    {

        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.profession')->where('permit_id', $id)->first();

        $is_edit =  Permit::where('permit_id', $id)->value('is_edit');

        if ($is_edit == 0) {

            Permit::where('permit_id', $id)->update(["lock" => Carbon::now()->toDateTimeString()]);

            ArtistTempData::where('permit_id', $id)->delete();
            ArtistTempDocument::where('permit_id', $id)->delete();

            foreach ($permit_details->artistPermit as $pd) {

                $artist_temp = ArtistTempData::updateOrCreate([
                    'firstname_en' => $pd->artist['firstname_en'],
                    'firstname_ar' =>  $pd->artist['firstname_ar'],
                    'lastname_en' =>  $pd->artist['lastname_en'],
                    'lastname_ar' =>  $pd->artist['lastname_ar'],
                    'nationality' =>  $pd->artist['country_id'],
                    'gender' =>  $pd->artist['gender_id'],
                    'birthdate' =>  $pd->artist['birthdate'] ? Carbon::parse($pd->artist['birthdate'])->toDateString() : '',
                    'artist_id' => $pd->artist_id,
                    'permit_id' => $pd->permit_id,
                    'profession_id' => $pd->profession_id,
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
                    'artist_permit_status' => $pd->artist_permit_status,
                    'issue_date' => $permit_details->issued_date,
                    'expiry_date' => $permit_details->expired_date,
                    'work_location' => $permit_details->work_location,
                    'company_id' => $permit_details->company_id,
                    'created_by' => $permit_details->created_by,
                ]);

                $permit_doc_details = \App\ArtistPermitDocument::where('artist_permit_id', $pd->artist_permit_id)->orderBy('created_at', 'desc')->get()->unique('requirement_id');


                foreach ($permit_doc_details as $ap) {
                    ArtistTempDocument::create([
                        'status' => 2,
                        'issued_date' => $ap->issued_date,
                        'expired_date' => $ap->expired_date,
                        'path' => $ap->path,
                        'requirement_id' => $ap->requirement_id,
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
        $data_bundle['staff_comments'] = PermitComment::where('permit_id', $id)->where('type', 1)->get();
        return view('permits.artist.edit.edit_permit', $data_bundle);
    }


    public function edit_edit_artist($temp_id)
    {
        $artist_permit_id = ArtistTempData::where('id', $temp_id)->value('artist_permit_id');
        $permit_id = ArtistTempData::where('id', $temp_id)->value('permit_id');

        $result = null;

        if (isset($artist_permit_id)) {
            $check_exists = ArtistPermitCheck::where('artist_permit_id', $artist_permit_id)->exists();
            if ($check_exists) {
                $result = ArtistPermitCheck::with('checklist')->where('artist_permit_id', $artist_permit_id)->latest()->first();
                // $result = ArtistPermitChecklist::where('artist_permit_check_id', $check_id)->get();
            }
        }


        $data_bundle['field_list'] = $result;
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::orderBy('nationality_en', 'asc')->get();
        $data_bundle['visatypes'] = VisaType::orderBy('visa_type_en', 'asc')->get();
        $data_bundle['languages'] = Language::orderBy('name_en', 'asc')->get();
        $data_bundle['religions'] = Religion::orderBy('name_en', 'asc')->get();
        $data_bundle['emirates'] = Emirates::orderBy('name_en', 'asc')->get();
        $data_bundle['areas'] = Areas::orderBy('area_en', 'asc')->get();
        $data_bundle['profession'] = Profession::orderBy('name_en', 'asc')->get();



        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'artistPermitDocument', 'profession', 'permit')->where('permit_id', $permit_id)->first();
        $data_bundle['artist_details'] = ArtistTempData::with('profession')->where('id', $temp_id)->first();
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
