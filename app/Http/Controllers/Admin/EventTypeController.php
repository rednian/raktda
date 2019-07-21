<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\EventType;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventTypeController extends Controller
{

    public function index()
    {
        return view('admin.settings.event-type.index');
    }

    public function datatable(Request $request)
    {
        if($request->ajax()){
            $eventType =  EventType::all();
            return Datatables::of($eventType)->make(true);
        }
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
         return view('admin.settings.event-type.create');
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
