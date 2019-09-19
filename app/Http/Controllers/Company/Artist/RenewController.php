<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;
use Auth;
use App\Artist;
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
        $new_pn = isset($number[1]) ? $number[0] . '-' . sprintf("%02d", (int) $number[1] + 1) : $old_permit_number . '-' . '01';
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
        $data_bundle['profession'] = \App\Profession::all();
        $data_bundle['areas'] = Areas::all();
        return view('permits.artist.renew.edit_artist', $data_bundle);
    }


    public function move_temp_to_permit_renew(Request $request)
    {

        $current_time_string = Carbon::now()->toDateTimeString();
        $user_id = Auth::user()->user_id;

        $permit_id = $request->permit_id;
        $n_permit_number = $request->permit_number;
        $n_work_location = $request->work_location;
        $n_issued_date = $request->issued_date;
        $n_expired_date = $request->expired_date;

        $n_refer_no = $this->generateReferenceNumber();

        $permitTable = Permit::create([
            'permit_number' => $n_permit_number,
            'user_id' => Auth::user()->user_id,
            'reference_number' => $n_refer_no,
            'issued_date' => $n_issued_date,
            'expired_date' => $n_expired_date,
            'work_location' => $n_work_location,
            'permit_status' => 'pending',
            'request_type' => 'new',
            'company_id' => Auth::user()->EmpClientId,
            'created_at' => $current_time_string,
            'created_by' => $user_id
        ]);

        $artist_temp_data = ArtistTempData::with('ArtistTempDocument')->where('permit_id', $permit_id)->get();

        foreach ($artist_temp_data as $data) {

            if ($data->status != 1) {

                $updateArray = array(
                    'permit_type_id' => $data->permit_type_id,
                    'passport_number' => $data->passport_number,
                    'uid_number' => $data->uid_number,
                    'uid_expire_date' => $data->uid_expire_date,
                    'passport_expire_date' => $data->passport_expire_date,
                    'visa_type_id' => $data->visa_type,
                    'visa_number' => $data->visa_number,
                    'visa_expire_date' => $data->visa_expire_date,
                    'sponsor_name_en' => $data->sponsor_name_en,
                    'language_id' => $data->language,
                    'religion_id' => $data->religion,
                    'emirate_id' => $data->city,
                    'fax_number' => $data->fax_number,
                    'po_box' => $data->po_box,
                    'area_id' => $data->area,
                    'address_en' => $data->address_en,
                    'mobile_number' => $data->mobile_number,
                    'phone_number' => $data->phone_number,
                    'email' => $data->email,
                    'identification_number' => $data->emirates_id,
                    'artist_permit_status' => 'active',
                    'created_at' => $current_time_string,
                    'created_by' =>  $user_id
                );


                if ($data->artist_id) {
                    Artist::where('artist_id', $data->artist_id)->update([
                        'firstname_ar' => $data->firstname_ar,
                        'lastname_ar' => $data->lastname_ar,
                        'firstname_en' => $data->firstname_en,
                        'lastname_en' => $data->lastname_en,
                        'gender_id' => $data->gender,
                        'nationality' => $data->nationality,
                        'birthdate' => $data->birthdate,
                        'updated_at' => $current_time_string,
                        'updated_by' => $user_id
                    ]);
                    $artist_id = $data->artist_id;
                } else {
                    $a = Artist::create([
                        'artist_status' => 'active',
                        'person_code' => $this->generatePersonCode(),
                        'firstname_ar' => $data->firstname_ar,
                        'lastname_ar' => $data->lastname_ar,
                        'firstname_en' => $data->firstname_en,
                        'lastname_en' => $data->lastname_en,
                        'gender_id' => $data->gender,
                        'nationality' => $data->nationality,
                        'birthdate' => $data->birthdate,
                        'created_at' => $current_time_string,
                        'created_by' => $user_id
                    ]);
                    $artist_id = $a->artist_id;
                }

                $updateArray['artist_id'] = $artist_id;
                $updateArray['permit_id'] = $permitTable->permit_id;

                $org = explode('/', $data->original);

                if ($org[2] == 'temp') {

                    $pic_ext = '';

                    if ($org[5]) {
                        $ext = explode('.', $org[5]);
                        $pic_ext = $ext[1];
                    }

                    $check_path = 'public/' .  $org[0] . '/artist_permit/' .  $artist_id . '/photos';

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $file_nos = $file_count / 2;
                        $next_file_no = $file_nos + 1;
                    } else {
                        $next_file_no = 1;
                    }

                    $newPath = 'public/' . $org[0] . '/artist_permit/' . $artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
                    $newPathLink = $org[0] . '/artist_permit/' . $artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
                    $newThumbPath = 'public/' . $org[0] . '/artist_permit/' . $artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;
                    $newThumbPathLink = $org[0] . '/artist_permit/' . $artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;

                    $oldPath = 'public/' . $data->original;
                    $oldThumbPath = 'public/' . $data->thumbnail;

                    Storage::move($oldPath, $newPath);
                    Storage::move($oldThumbPath, $newThumbPath);
                } else {
                    $newPathLink = $data->original;
                    $newThumbPathLink = $data->thumbnail;
                }

                $updateArray['original'] = $newPathLink;
                $updateArray['thumbnail'] = $newThumbPathLink;

                $artistPermit =  ArtistPermit::create($updateArray); // created the artist permit


                $requirements = Requirement::where('requirement_type', 'artist')->get();
                $requirement_names = [];
                foreach ($requirements as $req) {
                    array_push($requirement_names, $req->requirement_name);
                }
                $total = $requirements->count();

                for ($j = 1; $j <= $total; $j++) {

                    $artist_temp_document = ArtistTempDocument::where('temp_data_id', $data->id)->where('document_name', $requirement_names[$j - 1])->orderBy('created_at', 'desc')->first();

                    if (!$artist_temp_document->doc_id) {

                        $temp_path = $artist_temp_document->path;
                        $te_pth = explode('/', $temp_path);
                        $ext = '';
                        if ($te_pth[4]) {
                            $ex = explode('.', $te_pth[4]);
                            $ext = $ex[1];
                        }

                        $check_path = 'public/' . $te_pth[0] . '/artist_permit/' . $artist_id;

                        if (Storage::exists($check_path)) {
                            $file_count = count(Storage::files($check_path));
                            $next_file_no = $file_count + 1;
                        } else {
                            $next_file_no = $j;
                        }

                        $newPath = 'public/' . $te_pth[0] . '/artist_permit/' . $artist_id . '/document_' . $next_file_no . '.' . $ext;
                        $newPathLink = $te_pth[0] . '/artist_permit/' . $artist_id . '/document_' . $next_file_no . '.' . $ext;

                        $oldPath = 'public/' . $temp_path;

                        Storage::move($oldPath, $newPath);

                        ArtistPermitDocument::create([
                            'issued_date' => $artist_temp_document->issued_date,
                            'expired_date' => $artist_temp_document->expired_date,
                            'created_at' =>  $current_time_string,
                            'created_by' =>  $user_id,
                            'path' =>  $newPathLink,
                            'document_name' => $artist_temp_document->document_name,
                            'artist_permit_id' => $artistPermit->artist_perit_id
                        ]);
                    }
                }
            }
        }

        if ($permitTable) {
            $message = ['success', 'Permit Applied Successfully', 'Success'];
        } else {
            $message = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $message]);
    }

    function generatePersonCode()
    {

        $last_person_code = Artist::orderBy('artist_id', 'desc')->value('person_code');

        if ($last_person_code == null) {
            $code = 2000;
        } else {
            $code = $last_person_code + 1;
        }

        // call the same function if the barcode exists already
        if ($this->personCodeExists($code)) {
            return $this->generatePersonCode();
        }

        // otherwise, it's valid and can be used
        return $code;
    }

    public function generateReferenceNumber()
    {
        $last_permit_d = Permit::latest()->first();
        if (empty($last_permit_d)) {
            $new_refer_no = sprintf("RNA%04d",  1);
        } else {
            $last_rn = $last_permit_d->reference_number;
            $n = substr($last_rn, 3);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_refer_no = sprintf("RNA%0" . $x . "d", $n + 1);
        }

        return $new_refer_no;
    }
}
