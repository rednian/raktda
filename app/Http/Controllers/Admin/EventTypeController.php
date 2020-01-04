<?php

namespace App\Http\Controllers\Admin;

use App\EventType;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\URL;

class EventTypeController extends Controller
{

    public function __construct(){
        $this->middleware('signed')->except([
            'datatable',
            'isexist',
            'store',
            'update',
            'destroy',
        ]);
    }

    public function index()
    {
        return abort('404');
    }

    public function datatable(Request $request)
    {
    	$user = Auth::user();
    	$type = EventType::orderBy('name_en');
    	$start = $request->start;
    	$length = $request->length;
    	$totalRecords = $type->count();
    	$type = $type->offset($start)->limit($length);

    	return DataTables::of($type)
		    ->addColumn('name', function($type) use ($user){
		    	return $user->LanguageId == 1 ? ucwords($type->name_en) : $type->name_ar;
		    })
		    ->editColumn('amount', function($type){
		    	return $type->amount ? number_format($type->amount, 2).' AED' : null;
		    })
		    ->addColumn('description', function($type) use ($user){
		    	return $user->LanguageId == 1 ? ucfirst($type->description_en) : $type->description_ar;
		    })
            ->addColumn('actions', function($type){
                return '<button data-url="' . route('event_type.destroy', $type->event_type_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-delete">' . __('Delete') . '</button> <button data-url="' . URL::signedRoute('event_type.edit', $type->event_type_id) . '" class="btn btn-secondary btn-sm btn-elevate btn-edit">' . __('Edit') . '</button>';
            })
            ->rawCOlumns(['actions'])
		    ->setTotalRecords($totalRecords)
		    ->make(true);
    }

    public function isexist(Request $request)
    {
        if($request->name_en){
            $req = EventType::when($request->type && $request->type == 'update', function($q) use($request){
                return $q->where('event_type_id', '!=', $request->id);
            })->where('name_en', $request->name_en)->exists();
            return response()->json(($req ? $request->name_en. ' already exist.' : true));
        }
        else{
            $req = EventType::when($request->type && $request->type == 'update', function($q) use($request){
                return $q->where('event_type_id', '!=', $request->id);
            })->where('name_ar', $request->name_ar)->exists();
            return response()->json(($req ? $request->name_ar. ' already exist.' : true));
        }
    }

    public function create()
    {
         return view('admin.settings.event.create', ['page_title'=>'Create Event Type']);
    }

    public function store(Request $request)
    {
        try{
            $event_type = EventType::create(array_merge($request->all(), ['created_by' => $request->user()->user_id ] ));
            $result = ['success', 'New Requirement has been added', 'Success'];

            $requirements = [];
            foreach ($request->requirement_id as $key => $value) {
                $requirements[$value] = [
                    'is_mandatory' => $request->has('required') && in_array($value, $request->required) ? 1 : null
                ];
            }

            if($request->has('requirement_id')){
                $event_type->requirements()->sync( (array) $requirements);
            }

            //SAVE SUB CATEGORIES
            if($request->has('sub_name')){
                foreach ($request->sub_name as $key => $value) {
                    if($value['en'] != "" && $value['ar'] != ""){
                        $event_type->subType()->create([
                            'sub_name_en' => $value['en'],
                            'sub_name_ar' => $value['ar']
                        ]);
                    }
                }
            }

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('admin.setting.index') . '#event_types')->with('message', $result);
            }
        }catch(Exception $e){
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(EventType $event_type)
    {
        $required = [];
        $selected = [];

        if($event_type->event_type_requirements()->count() > 0){
            foreach ($event_type->event_type_requirements as $key => $value) {
                $selected[] = $value->requirement_id;
                if($value->is_mandatory){
                    $required[] = $value->requirement_id;
                }
            }
        }
        
        return view('admin.settings.event.edit', ['page_title'=>'Edit Event Type', 'event_type' => $event_type, 'required' => $required, 'selected' => $selected]);
    }


    public function update(Request $request, EventType $event_type)
    {
        try{
            $event_type->update(array_merge($request->all(), ['udpated_by', Auth::user()->user_id] ));
            $result = ['success', 'Event Type has been saved successfully', 'Success'];

            if($request->has('requirement_id')){

                $requirements = [];

                if($request->required){
                    foreach ($request->requirement_id as $key => $value) {
                        $requirements[$value] = [
                            'is_mandatory' => in_array($value, $request->required) ? 1 : null
                        ];
                    }
                }

                $event_type->requirements()->sync( (array) $requirements );
            }else{
                $event_type->requirements()->sync([]);
            }

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('admin.setting.index') . '#event_types')->with('message', $result);
            }

        }catch(Exception $e){
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }


    public function destroy($id)
    {
        try{
            $eventType = EventType::find($id);
                if($eventType->delete()){
                    $eventType->update(['deleted_by'=>Auth::user()->user_id]);
                    $result = ['success', 'Event Permit Type has been deleted successfully.', 'Success'];
                }

            }catch(Exception $e){
                $result = ['error', $e->getMessage(), 'Error'];
            }
            return response()->json(['message' => $result]);
        
    }
}
