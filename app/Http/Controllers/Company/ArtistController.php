<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use PragmaRX\Countries\Package\Countries;
use Carbon\Carbon;
use App\Artist;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;
use Auth;
use Excel;
use Yajra\Datatables\Datatables;
use App\Requirement;
use App\Company;
use App\PermitType;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Areas;
use App\ArtistPermitComment;
use App\companyArtistDraft;
use App\VisaType;
use App\PermitComment;
use App\ArtistPermitCheck;
use App\ArtistPermitChecklist;
use App\ArtistTempData;
use App\ArtistTempDocument;
use Intervention\Image\ImageManagerStatic as Image;
use League\Flysystem\Filesystem;

class ArtistController extends Controller
{

    public function update_artist_permit(Request $request)
    {

        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);

        Artist::where('artist_id', $artistDetails[1]['id'])->update([
            'firstname_en' => $artistDetails[1]['fname_en'],
            'firstname_ar' => $artistDetails[1]['fname_ar'],
            'lastname_en' => $artistDetails[1]['lname_en'],
            'lastname_ar' => $artistDetails[1]['lname_ar'],
            'nationality' => $artistDetails[1]['nationality'],
            'passport_number' => $artistDetails[1]['passport'],
            'artist_status' => 'active',
            'uid_number' => $artistDetails[1]['uidNumber'],
            'uid_expiry_date' => $artistDetails[1]['uidExp'] ? Carbon::parse($artistDetails[1]['uidExp'])->toDateString() : '',
            'pp_expiry_date' => $artistDetails[1]['ppExp'] ? Carbon::parse($artistDetails[1]['ppExp'])->toDateString() : '',
            'visa_type' => $artistDetails[1]['visaType'],
            'visa_number' => $artistDetails[1]['visaNumber'],
            'visa_expiry_date' => $artistDetails[1]['visaExp'] ? Carbon::parse($artistDetails[1]['visaExp'])->toDateString() : '',
            'sponser_name' => $artistDetails[1]['spName'],
            'id_no' => $artistDetails[1]['idNo'],
            'language' => $artistDetails[1]['language'],
            'religion' => $artistDetails[1]['religion'],
            'gender' => $artistDetails[1]['gender'],
            'emirate' => $artistDetails[1]['city'],
            'area' => $artistDetails[1]['area'],
            'address' => $artistDetails[1]['address'],
            'birthdate' => $artistDetails[1]['dob'] ? Carbon::parse($artistDetails[1]['dob'])->toDateString() : '',
            'mobile_number' => $artistDetails[1]['mobile'],
            'phone_number' => $artistDetails[1]['landline'],
            'email' => $artistDetails[1]['email'],
            'updated_by' => Auth::user()->user_id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        $artist = Artist::where('person_code', $artistDetails[1]['code'])->first();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        $pic_ext = session('1_ext');

        if (Storage::exists(session('1_pic_file'))) {

            $check_path = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/photos';

            if (Storage::exists($check_path)) {
                $file_count = count(Storage::files($check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
            $newPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
            $newThumbPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;
            $newThumbPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;

            Storage::move(session('1_pic_file'), $newPath);
            Storage::move(session('1_thumb_file'), $newThumbPath);

            session()->forget(['1_pic_file', '1_thumb_file', '1_ext']);
        } else {
            $getArtistPics = ArtistPermit::where('artist_id', $artist->artist_id)->latest()->first();
            $newPathLink = $getArtistPics->original_pic;
            $newThumbPathLink = $getArtistPics->thumbnail_pic;
        }

        ArtistPermit::where('artist_permit_id', $artistDetails[1]['id'])->update([
            'profession' => $artistDetails[1]['profession'],
            'original_pic' => $newPathLink,
            'thumbnail_pic' => $newThumbPathLink,
        ]);

        $requirements = Requirement::where('requirement_type', 'artist')->get();
        $requirement_names = [];
        foreach ($requirements as $req) {
            array_push($requirement_names, $req->requirement_name);
        }
        $total = $requirements->count();

        for ($j = 1; $j <= $total; $j++) {
            if (Storage::exists(session('1_doc_file_' . $j))) {

                $ext = session('1_ext_' . $j);

                $check_path = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id;


                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = $j;
                }

                $newPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $next_file_no . '.' . $ext;
                $newPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $next_file_no . '.' . $ext;


                Storage::move(session('1_doc_file_' . $j), $newPath);
                Storage::delete(session('1_doc_file_' . $j));



                session()->forget(['1_doc_file_' . $j, '1_ext_' . $j]);
            } else {
                $artistsD = ArtistPermitDocument::where('artist_permit_id', $artistDetails[1]['id'])->latest()->first();
                $newPathLink = $artistsD->path;
            }

            ArtistPermitDocument::create([
                'issued_date' => $documentDetails[1][$j] != null ? Carbon::parse($documentDetails[1][$j]['issue_date'])->toDateTimeString() : '',
                'expired_date' => $documentDetails[1][$j] != null ? Carbon::parse($documentDetails[1][$j]['exp_date'])->toDateTimeString() : '',
                'created_at' =>  Carbon::now()->toDateTimeString(),
                'created_by' =>  Auth::user()->user_id,
                'artist_permit_id' => $artistDetails[1]['permit_id'],
                'path' =>  $newPathLink,
                'document_name' => $requirement_names[$j - 1],
                'status' => 'active'
            ]);
        }

        if ($artist) {
            $result = ['success', 'Artist Details Updated Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }
}
