<?php

namespace App\Http\Controllers\Admin;

use App\EventType;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class EventTypeController extends Controller
{

    public function index()
    {
        return view('admin.settings.event-type.index');
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
		    	if($user->LanguageId == 1){ return ucwords($type->name_en); }
		    	return $type->name_ar;
		    })
		    ->editColumn('amount', function($type){
		    	if($type->amount){ return number_format($type->amount, 2).' AED';}
		    	return null;
		    })
		    ->addColumn('description', function($type) use ($user){
		    		if($user->LanguageId == 1){ return ucfirst($type->description_en); }
		    		return $type->description_ar;
		    })
		    ->setTotalRecords($totalRecords)
		    ->make(true);


    }

    public function isexist(Request $request)
    {
        if($request->ajax()){
            $eventType = EventType::where('event_type_en',$request->event_type_en)->exists();
             return response()->json(($eventType ? false : true));
        }
    }

 
    public function create()
    {
         return view('admin.settings.event.create', ['page_title'=>'Create Event Type']);
    }

    public function store(Request $request)
    {
        try {
            $request['created_by'] = Auth::user()->user_id;
            $eventType = EventType::create($request->all());
             $result = ['success', 'Event Permit Type has been save successfully ', 'Success'];
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
