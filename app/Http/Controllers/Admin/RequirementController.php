<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Requirement;
use App\EventTypeRequirement;
use App\EventType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class RequirementController extends Controller
{

    public function __construct(){
        $this->middleware('signed')->except([
            'store',
            'isexist',
            'update',
            'destroy',
            'datatable',
        ]);
    }

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
        return view('admin.settings.requirement.create', ['page_title'=> 'Add New Requirement', 'type' => $request->t ]);
    }

    public function store(Request $request){

        try{
            $req = Requirement::create(array_merge($request->all(), ['created_by' => $request->user()->user_id ] ));
            $result = ['success', 'New Requirement has been added', 'Success'];

            if($request->submit_type == 'continue'){
                return $request->requirement_type == 'artist' ? redirect(URL::signedRoute('admin.setting.index') . '#artist_requirements')->with('message', $result) : redirect(URL::signedRoute('admin.setting.index') . '#event_requirements')->with('message', $result);
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
                return $request->requirement_type == 'artist' ? redirect(URL::signedRoute('admin.setting.index') . '#artist_requirements')->with('message', $result) : redirect(URL::signedRoute('admin.setting.index') . '#event_requirements')->with('message', $result);
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
        ->editColumn('validity', function($args) use($request){
            if($request->user()->LanguageId == 1){
                return !is_null($args->validity) ? $args->validity . ' month/s' : 'N/A';
            }
            return !is_null($args->validity) ? $args->validity . ' month/s' : __('Not Applicable');
        })
        ->editColumn('term', function($args) use($request){
            if($request->user()->LanguageId == 1){
                return !is_null($args->term) ? ucwords($args->term) . ' Term' : 'N/A';
            }
            return !is_null($args->term) ? __(ucwords($args->term) . ' Term') : __('Not Applicable');
        })
        ->editColumn('dates_required', function($args){
            return $args->dates_required ? __('Yes') : __('No');
        })
        ->editColumn('status', function($args) use($user){
            return $args->status ? '<span class="kt-badge kt-badge--success kt-badge--inline">' . __('Active') . '</span>' : '<span class="kt-badge kt-badge--danger kt-badge--inline">' . __('Inactive') . '</span>';
        })
        ->addColumn('actions', function($args){
            return '<button data-url="' . route('requirements.destroy', $args->requirement_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-delete">' . __('DELETE') . '</button> <button data-url="' . URL::signedRoute('requirements.edit', $args->requirement_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-edit">' . __('EDIT') . '</button>';
        })
        ->addColumn('isInEventType', function($args) use($request){
            if($request->has('event_type_id')){
                if($args->type()->where(['event_type_requirement.event_type_id' => $request->event_type_id])->exists()){
                    return 1;
                }
            }
            return 0;
        })
        ->addColumn('is_required', function($requirement) use($request){

            $checked = '';
            $disabled = 'disabled';
            if($request->has('event_type_id')){
                $rq = EventTypeRequirement::where(['event_type_id' => $request->event_type_id, 'requirement_id' => $requirement->requirement_id])->first();

                if($rq){
                    $disabled = '';
                    $checked = $rq->is_mandatory == 1 ? 'checked' : '';
                }
            }

            return '<span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
                        <label>
                            <input ' . $disabled . ' ' . $checked . ' data-id="' . $requirement->requirement_id . '" type="checkbox" name="is_required" value="1" class="requirement_is_required"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;"></b>
                            <span></span>
                        </label>
                    </span>';

        })
        ->rawColumns(['status', 'actions', 'is_required'])
        ->make(true);
    }

}
