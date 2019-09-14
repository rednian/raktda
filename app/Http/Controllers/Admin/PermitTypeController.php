<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\PermitType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermitTypeController extends Controller
{
    public function index()
    {
        $data['breadcrumb'] = 'permit_type.index';
        $data['page_title'] = 'Permit Type';
        return view('admin.settings.permit_type.index',$data);
    }

    public function isexist(Request $request)
    {
        $permit_type = PermitType::where('name_en', $request->name_en)->exists();
        return response()->json(($permit_type ? false : true));
    }

    public function update_status(Request $request, PermitType $permit_type)
    {
        if($request->ajax()){
            try {
                if($permit_type->update($request->all())){
                     $result = ['success', ucfirst($permit_type->name_en) .' Permit Type Status  has been updated successfully.', 'Success'];
                }
            } catch (Exception $e) {
                $result = ['error', $e->getMessage(), 'Error'];
            }

            return response()->json(['message' => $result]);
        }
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
         $permitType =  PermitType::when($request->permit_type, function($q) use ($request){
                                        $q->where('permit_type', $request->permit_type);
                                    })->when($request->status,function($q) use ($request){
                                         $q->where('status', $request->status);   
                                    })->get();
         return Datatables::of($permitType)->make(true);   
        }

    }


    public function create()
    {
        $data['breadcrumb'] = 'permit_type.create';
        $data['page_title'] = 'New Permit Type';
        return view('admin.settings.permit_type.create',$data);
    }


    public function store(Request $request)
    {
        try {
            $request['created_by'] = Auth::user()->user_id;
            $ArtistType = PermitType::create($request->all());
             $result = ['success', 'New Artist Permmit Type has been save successfully ', 'Success'];
        } catch (Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }

        if($request->exit){
            return redirect()->route('permit_type.index')->with('message', $result);
        }
        return redirect()->back()->with('message', $result);
    }


    public function show($id)
    {
        return abort(404);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request, PermitType $permit_type)
    {
        if( $request->ajax() ){
            try{
                if($permit_type->delete()){
                    $permit_type->update(['deleted_by'=>Auth::user()->user_id]);
                    $result = ['success', ucfirst($permit_type->name_en) .' Permit Type has been deleted successfully.', 'Success'];
                }

            }catch(Exception $e){
                $result = ['error', $e->getMessage(), 'Error'];
            }

            return response()->json(['message' => $result]);
        }
    }
}
