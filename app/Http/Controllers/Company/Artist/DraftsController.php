<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Countries;
use Carbon\Carbon;
use App\ArtistPermit;
use App\Permit;
use App\Requirement;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Profession;
use App\Areas;
use Auth;
use App\VisaType;
use App\ArtistTempData;
use App\ArtistTempDocument;

class DraftsController extends Controller
{

    public function save_permit_to_drafts(Request $request)
    {
        $temp_permit_id = $request->temp_permit_id;
        $user_id = Auth::user()->user_id;

        $update = ArtistTempData::where([
            ['permit_id', $temp_permit_id],
            ['created_by', $user_id]
        ])->update([
            'status' => 5
        ]);

        if ($update) {
            $result = ['success', 'Draft Saved Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }


    public function fetch_existing_drafts()
    {
        $user_id = Auth::user()->user_id;
        $drafts = ArtistTempData::with('profession')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->groupBy('permit_id')->get();
        //->has('artistPermitDocument')

        return Datatables::of($drafts)->editColumn('created_at', function ($draft) {
            if ($draft->created_at) {
                return  $draft->created_at;
            } else {
                // return 'none';
            }
        })->editColumn('issued_date', function ($draft) {
            if ($draft->issue_date) {
                return  Carbon::parse($draft->issue_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->editColumn('expired_date', function ($draft) {
            if ($draft->expiry_date) {
                return  Carbon::parse($draft->expiry_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->addColumn('action', function ($permit) {
            return '<a href="' . route('company.view_draft_details', $permit->permit_id) . '"><span class="kt-badge kt-badge--success kt-badge--inline">View</span></a>';
        })->addColumn('details', function ($permit) {
            return '<a href="' . route('company.get_draft_details', $permit->permit_id) . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function get_draft_details($permit_id)
    {
        $user_id = Auth::user()->user_id;
        $data['draft_details'] = ArtistTempData::with('profession')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->where('permit_id', $permit_id)->get();

        return view('permits.artist.view_draft_details', $data);
    }

    public function view_draft_details($id)
    {
        $user_id = Auth::user()->user_id;
        $data['artist_details'] = ArtistTempData::with('profession', 'nationality', 'ArtistTempDocument')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->where('permit_id', $id)->get();

        // $data_bundle['artist_details'] = ArtistTempData::where([
        //     ['permit_id', $id],
        //     ['company_id', Auth::user()->EmpClientId],
        //     ['created_by', Auth::user()->user_id],
        // ])->with('profession', 'nationality', 'ArtistTempDocument')->get();

        $data['permit_id'] = $id;


        return view('permits.artist.new.create', $data);
    }


    public function view_draft($id)
    {
        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.profession')->where('permit_id', $id)->first();

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
        return view('permits.artist.amend.amend_permit', $data_bundle);
    }
}
