<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Requirement;
use App\EventType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class RequirementController extends Controller
{
    public function index(){
        return abort(404);
    }

	// public function index()
	// {
	// 	$data = [];
	// 	$requirement = Requirement::where('requirement_type', 'event')->get();
	// 	$requirement = $requirement->map(function($v) use ($data){
	// 		$data['name'] =  Auth::user()->LanguageId == 1 ? $v->requirement_name :  $v->requirement_name_ar;
	// 		$data['requirement_id'] = $v->requirement_id;
	// 		return $data;
	// 	});
	// 	return $requirement;
	// 	return response()->json(['data'=>$requirement]);
	// }

    public function create(Request $request)
    {

        if (!$request->hasValidSignature()) {
            abort(404);
        }

        return view('admin.settings.requirement.create', ['page_title'=> 'Add New Requirement', 'type' => $request->t ]);
    }


    // public function store(Request $request)
    // {
    //     return response()->json(['result'=>true, 'data'=>Requirement::create($request->all())]);
    // }

    // public function isexist(Request $request)
    // {
    // 	if($request->requirement_name){
    // 		$requirement = Requirement::where('requirement_name', $request->requirement_name)->where('requirement_type', 'event')->exists();
    // 		return response()->json(($requirement ? $request->requirement_name. ' already exist.' : true));
    //   }
    // 	else{
    // 		$requirement = Requirement::where('requirement_name_ar', $request->requirement_name_ar)->where('requirement_type', 'event')->exists();
    // 		return response()->json(($requirement ?  $request->requirement_name_ar. ' already exist.' : true));
    //   }

    // }


 //    public function show($id)
 //    {
 //        //
 //    }


 //    public function edit($id)
 //    {
 //        //
 //    }


 //    public function update(Request $request, $id)
 //    {
 //        //
 //    }

 //    public function update_status(Request $request, Requirement $requirement)
 //    {
 //        if($request->ajax()){
 //            try {
 //                if($requirement->update($request->all())){
 //                     $result = ['success', ucfirst($requirement->requirement_type) .' Permit Requirement Status  has been updated successfully.', 'Success'];
 //                }
 //            } catch (Exception $e) {
 //                $result = ['error', $e->getMessage(), 'Error'];
 //            }

 //            return response()->json(['message' => $result]);
 //        }
 //    }


 //    public function destroy(Request $request, Requirement $requirement)
 //    {
 //        if( $request->ajax() ){
 //            try{
 //                if($requirement->delete()){
 //                    $requirement->update(['deleted_by'=>Auth::user()->user_id]);
 //                    $result = ['success', ucfirst($requirement->requirement_type) .' Permit Requirement has been deleted successfully.', 'Success'];
 //                }

 //            }catch(Exception $e){
 //                $result = ['error', $e->getMessage(), 'Error'];
 //            }

 //            return response()->json(['message' => $result]);
 //        }
 //    }

 //    public function datatable(Request $request)
 //    {
 //        if($request->ajax()){
 //            $requirement = Requirement::when($request->requirement_type, function($q) use ($request){
 //                                 $q->where('requirement_type', $request->requirement_type);
 //                                })
 //                                ->when($request->status, function($q) use ($request){
 //                                    $q->where('status', $request->status);
 //                                })
 //                                ->get();

 //             return Datatables::of($requirement)->make(true);
 //        }

 //    }
    public function store(Request $request){

        try{
            $req = Requirement::create(array_merge($request->all(), ['created_by' => $request->user()->user_id ] ));
            $result = ['success', 'New Requirement has been added', 'Success'];

            if($request->submit_type == 'continue'){
                return $request->requirement_type == 'artist' ? redirect('settings#artist_requirements')->with('message', $result) : redirect('settings#event_requirements')->with('message', $result);
            }

        }catch(Exception $e){
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function isexist(Request $request)
    {
        if($request->requirement_name){
            $req = Requirement::when($request->type && $request->type == 'update', function($q) use($request){
                return $q->where('requirement_id', '!=', $request->id);
            })->where('requirement_name', $request->requirement_name)->exists();
            return response()->json(($req ? $request->requirement_name. ' already exist.' : true));
        }
        else{
            $req = Requirement::when($request->type && $request->type == 'update', function($q) use($request){
                return $q->where('requirement_id', '!=', $request->id);
            })->where('requirement_name_ar', $request->requirement_name_ar)->exists();
            return response()->json(($req ? $request->requirement_name_ar. ' already exist.' : true));
        }
    }

    public function edit(Requirement $requirement){
        return view('admin.settings.requirement.edit', ['page_title'=> 'Edit Requirement', 'req' => $requirement]);
    }

    public function update(Request $request, Requirement $requirement){
        try{

            $data = array_merge($request->all(), ['dates_required' => $request->has('dates_required') ? 1 : null, 'status' => $request->has('status') ? 1 : null ]);
            $requirement->update(array_merge( $data, ['updated_by' => $request->user()->user_id ] ));
            $result = ['success', 'Requirement has been saved successfully', 'Success'];

            if($request->submit_type == 'continue'){
                return $request->requirement_type == 'artist' ? redirect('settings#artist_requirements')->with('message', $result) : redirect('settings#event_requirements')->with('message', $result);
            }
        }catch(Exception $e){
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function destroy(Requirement $requirement, Request $request){
        try{
            $requirement->delete();
            $result = ['success', 'Requirement has been deleted', 'Success'];
        }catch(Exception $e){
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return response()->json($result);
    }

    public function datatable(Request $request){

        $user = Auth::user();
        $requirements = Requirement::when($request->type, function($q) use($request){
            $q->where('requirement_type', $request->type);
        })->orderBy('requirement_name')->get();

        return DataTables::of($requirements)
        ->editColumn('requirement_name', function($args) use ($user){
            return $user->LanguageId == 1 ? ucwords($args->requirement_name) : ucwords($args->requirement_name_ar);
        })
        ->editColumn('requirement_description', function($args){
            return Str::limit($args->requirement_description, 20, ' ...');
        })
        ->editColumn('validity', function($args){
            return !is_null($args->validity) ? $args->validity . ' month/s' : 'N/A';
        })
        ->editColumn('term', function($args){
            return !is_null($args->term) ? ucwords($args->term) . ' Term' : 'N/A';
        })
        ->editColumn('dates_required', function($args){
            return $args->dates_required ? 'Yes' : 'No';
        })
        ->editColumn('status', function($args) use($user){
            return $args->status ? '<span class="kt-badge kt-badge--success kt-badge--inline">Active</span>' : '<span class="kt-badge kt-badge--danger kt-badge--inline">Inactive</span>';
        })
        ->addColumn('actions', function($args){
            return '<button data-url="' . route('requirements.destroy', $args->requirement_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-delete">Delete</button> <button data-url="' . route('requirements.edit', $args->requirement_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-edit">Edit</button>';
        })
        ->addColumn('isInEventType', function($args) use($request){
            if($request->has('event_type_id')){
                if($args->type()->where(['event_type_requirement.event_type_id' => $request->event_type_id])->exists()){
                    return 1;
                }
            }
            return 0;
        })
        ->rawColumns(['status', 'actions'])
        ->make(true);
    }

}
