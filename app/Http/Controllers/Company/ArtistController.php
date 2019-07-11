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




        // $request->validate([
        //     'artist_type' => 'required',
        //     'from_date' => 'required|date',
        //     'to_date' => 'required|date',
        //     'name_en' => 'required',
        //     'name_ar' => 'nullable',
        //     'nationality' => 'required',
        //     'passport' => 'required',
        //     'uid_number' => 'nullable',
        //     'dob' => 'required|date',
        //     'telephone' => 'required|numeric',
        //     'mobile' => 'required|numeric',
        //     'email' => 'required|email',
        // ]);

        // $artist = Artist::create([
        //     'name' => $request->input('name_en'),
        //     'nationality' => $request->input('nationality'),
        //     'passport_number' => $request->input('passport'),
        //     'uid_number' => $request->input('uid_number'),
        //     'birthdate' => $request->input('dob'),
        //     'mobile_number' => $request->input('mobile'),
        //     'phone_number' => $request->input('telephone'),
        //     'email' => $request->input('email'),
        //     'created_by' => 1,
        //     'company_id' => 1,
        // ]);


        $request->validate([
            'doc_type' => 'required',
            'doc_file' => 'file|required',
            'doc_exp_date' => 'required|date',
        ]);

        $extension = $request->file('doc_file')->getClientOriginalExtension();


        $artistDocument = ArtistDocument::create([
            'artist_doc_name' => $request->input('doc_type'),
            'artist_doc_path' => $request->input('doc_file'),
            'artist_doc_expired_date' => $request->input('doc_exp_date'),
            'artist_id' => 1,
            'created_by' =>  Auth::user()->id
        ]);

        $path = $request->file('doc_file')->storeAs(
            $extension,
            $artistDocument->id  . '.' . $extension
        );

        $artistDocument->path = $path;

        //$artist->save();

        $artistDocument->save();

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
