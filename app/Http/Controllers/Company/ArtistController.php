<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profession;
use PragmaRX\Countries\Package\Countries;
use App\Artist;
use App\ArtistDocument;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permits.artist.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_bundle['profession'] = Profession::all();
        $data_bundle['countries'] = Countries::all()->pluck('name.common');

        return view('permits.artist.create', $data_bundle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $request->validate([
            'artist_type'=> 'required',
            'artist_permit_from' => 'required|date',
            'artist_permit_to' => 'required|date',
            'artist_name_en' => 'required',
            'artist_name_ar' => 'nullable',
            'artist_nationality' => 'required',
            'artist_passport' => 'required',
            'artist_uid_number' => 'nullable',
            'artist_dob' => 'required|date',
            'artist_telephone' => 'required|numeric',
            'artist_mobile' => 'required|numeric',
            'artist_email' => 'required|email',
            'artist_upload_doc_type' => 'required',
            'artist_upload_doc_file' => 'file|required',
            'artist_upload_doc_exp_date' => 'required|date'
        ]);

        $artist = Artist::create([
            'name' => $request->input('artist_name_en'),
            'nationality' => $request->input('artist_nationality'),
            'passport_number' => $request->input('artist_passport'),
            'uid_number'=> $request->input('artist_uid_number'),
            'birthdate'=> $request->input('artist_dob'),
            'mobile_number'=> $request->input('artist_mobile'),
            'phone_number'=> $request->input('artist_telephone'),
            'email'=> $request->input('artist_email'),
            'created_by'=> 1,
            'company_id'=> 1,
        ]);

        // $artistDocumet = ArtistDocument::create([
        //       'artist_doc_name' => $request->input('artist_upload_doc_type')  ,
        // ]);

        $artist->save();

        return redirect('artist_permits');


        //return redirect()->back()->with( 'status', 'File uploaded' );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
