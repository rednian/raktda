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
use App\Countries;
use App\PermitType;
use App\VisaType;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Areas;
use App\ArtistTempDocument;
use App\Requirement;

class RenewController extends Controller
{

    public function renew_permit($id)
    {
        $old_permit_number = Permit::where('permit_id', $id)->latest()->value('permit_number');
        $number = explode('-', $old_permit_number);
        $new_pn = isset($number[1]) ? $number[0] . '-' . $number[1] + 1 : $old_permit_number . '-' . '01';

        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.permitType')->where('permit_id', $id)->first();

        $is_edit =  Permit::where('permit_id', $id)->value('is_edit');

        if ($is_edit == 0) {

            ArtistTempData::where('permit_id', $id)->delete();
            ArtistTempDocument::where('permit_id', $id)->delete();

            foreach ($permit_details->artistPermit as $pd) {

                $artist_temp = ArtistTempData::updateOrCreate([
                    'firstname_en' => $pd->artist['firstname_en'],
                    'firstname_ar' =>  $pd->artist['firstname_ar'],
                    'lastname_en' =>  $pd->artist['lastname_en'],
                    'lastname_ar' =>  $pd->artist['lastname_ar'],
                    'nationality' =>  $pd->artist['nationality'],
                    'gender' =>  $pd->artist['gender_id'],
                    'birthdate' =>  $pd->artist['birthdate'] ? Carbon::parse($pd->artist['birthdate'])->toDateString() : '',
                    'artist_id' => $pd->artist_id,
                    'permit_id' => $pd->permit_id,
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
                    'is_old_artist' => 2
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
        $data_bundle['new_permit_num'] = $new_pn;
        return view('permits.artist.renew.renew_permit', $data_bundle);
    }

    public function edit_artist($temp_id)
    {
        $permit_id = ArtistTempData::where('id', $temp_id)->value('permit_id');

        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['visa_types'] = VisaType::all();
        $data_bundle['artist_details'] = ArtistTempData::where('id', $temp_id)->first();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'permitType')->where('permit_id', $permit_id)->first();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        return view('permits.artist.renew.edit_artist', $data_bundle);
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
