<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Requirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequirementController extends Controller
{

	public function index()
	{
		$data = [];
		$requirement = Requirement::where('requirement_type', 'event')->get();
		$requirement = $requirement->map(function($v) use ($data){
			$data['name'] =  Auth::user()->LanguageId == 1 ? $v->requirement_name :  $v->requirement_name_ar;
			$data['requirement_id'] = $v->requirement_id;
			return $data;
		});
		return $requirement;
		return response()->json(['data'=>$requirement]);
	}

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return response()->json(['result'=>true, 'data'=>Requirement::create($request->all())]);
    }

    public function isexist(Request $request)
    {
    	if($request->requirement_name){
    		$requirement = Requirement::where('requirement_name', $request->requirement_name)->where('requirement_type', 'event')->exists();
    		return response()->json(($requirement ? $request->requirement_name. ' already exist.' : true));
      }
    	else{
    		$requirement = Requirement::where('requirement_name_ar', $request->requirement_name_ar)->where('requirement_type', 'event')->exists();
    		return response()->json(($requirement ?  $request->requirement_name_ar. ' already exist.' : true));
      }

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

    public function update_status(Request $request, Requirement $requirement)
    {
        if($request->ajax()){
            try {
                if($requirement->update($request->all())){
                     $result = ['success', ucfirst($requirement->requirement_type) .' Permit Requirement Status  has been updated successfully.', 'Success'];
                }
            } catch (Exception $e) {
                $result = ['error', $e->getMessage(), 'Error'];
            }

            return response()->json(['message' => $result]);
        }
    }


    public function destroy(Request $request, Requirement $requirement)
    {
        if( $request->ajax() ){
            try{
                if($requirement->delete()){
                    $requirement->update(['deleted_by'=>Auth::user()->user_id]);
                    $result = ['success', ucfirst($requirement->requirement_type) .' Permit Requirement has been deleted successfully.', 'Success'];
                }

            }catch(Exception $e){
                $result = ['error', $e->getMessage(), 'Error'];
            }

            return response()->json(['message' => $result]);
        }
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $requirement = Requirement::when($request->requirement_type, function($q) use ($request){
                                 $q->where('requirement_type', $request->requirement_type);
                                })
                                ->when($request->status, function($q) use ($request){
                                    $q->where('status', $request->status);
                                })
                                ->get();

             return Datatables::of($requirement)->make(true);
        }

    }

}
