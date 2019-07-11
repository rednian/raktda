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
            $eventType = EventType::where('name_en',$request->name_en)->exists();
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
