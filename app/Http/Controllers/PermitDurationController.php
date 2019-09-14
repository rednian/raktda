<?php

namespace App\Http\Controllers;

use DataTables;

use App\PermitDuration;
use Illuminate\Http\Request;

class PermitDurationController extends Controller
{
    public function index()
    {
        return view('admin.settings.duration.index',[
            'page_title'=> 'Permit Duration',
            'breadcrumb'=>'permit_duration.index'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PermitDuration  $permitDuration
     * @return \Illuminate\Http\Response
     */
    public function show(PermitDuration $permitDuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PermitDuration  $permitDuration
     * @return \Illuminate\Http\Response
     */
    public function edit(PermitDuration $permitDuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PermitDuration  $permitDuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermitDuration $permitDuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PermitDuration  $permitDuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermitDuration $permitDuration)
    {
        //
    }

    public function dataTable(Request $request)
    {
        $duration = PermitDuration::all();
        return DataTables::of($duration)->make(true);   
    }


}
