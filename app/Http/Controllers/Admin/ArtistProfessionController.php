<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function isexist(Request $request)
    {
        if($request->ajax()){
            $valid = false;
            $profession = Profession::where('prof_name_en',$request->prof_name_en)->exists();
            $valid = $profession ? false : true;
             return response()->json($valid);
        }
    }

 
    public function create()
    {
        return view('admin.settings.artist-type.create');
    }

    public function store(Request $request)
    {
        try {
            $request['created_by'] = Auth::user()->user_id;
            $profession = Profession::create($request->all());
        } catch (Exception $e) {
            
        }
       

        return redirect()->back();   
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
