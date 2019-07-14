<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistProfessionController extends Controller
{

    public function index()
    {
        return abort(404);
    }

    public function datatable()
    {
        $profession =  Profession::all();
        return Datatables::of($profession)->make(true);
    }

    public function isexist(Request $request)
    {
        if ($request->ajax()) {
            $profession = Profession::where('prof_name_en', $request->prof_name_en)->exists();
            return response()->json(($profession ? false : true));
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
            $profession = Profession::create($request->all());
            $result = ['success', 'Artists profession has been save successfully ', 'Success'];
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
        //
    }
}
