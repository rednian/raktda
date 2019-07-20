<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\ArtistType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistProfessionController extends Controller
{

    public function index()
    {
        return view('admin.settings.profession.index');
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
         $ArtistType =  ArtistType::all();
         return Datatables::of($ArtistType)->make(true);   
        }
    }

    public function isexist(Request $request)
    {
        if($request->ajax()){
            $ArtistType = ArtistType::where('artist_type_en',$request->artist_type_en)->exists();
             return response()->json(($ArtistType ? false : true));
        }
    }

 
    public function create()
    {
        return view('admin.settings.profession.create');
    }

    public function store(Request $request)
    {
        try {
            $request['created_by'] = Auth::user()->user_id;
            $ArtistType = ArtistType::create($request->all());
             $result = ['success', 'New Artist Permmit Type has been save successfully ', 'Success'];
        } catch (Exception $e) {
             $result = ['error', $e->getMessage(), 'Error'];
        }
         return redirect()->back()->with('message', $result);  
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        try{
            $ArtistType = ArtistType::find($id);

            if($ArtistType->delete()){
                $ArtistType->update(['deleted_by'=>Auth::user()->user_id]);
                $result = ['success', 'Artist Permit Type has been deleted successfully.', 'Success'];
            }

        }catch(Exception $e){
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return response()->json(['message' => $result]);
    }
}
