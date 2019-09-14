<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Procedure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProcedureController extends Controller
{
   
    public function index()
    {
        return view('admin.settings.procedure.index', [
            'page_title'=> 'Procedure',
            'breadcrumb'=> 'procedure.index',
        ]);
    }

   
    public function create()
    {
         return view('admin.settings.procedure.create', [
            'page_title'=> 'Procedure Create',
            'breadcrumb'=> 'procedure.create',
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $procedure = Procedure::create($request->all());
            
            DB::commit();
            $result = ['success', ' Artist has been saved as draft successfully.', 'Success'];
        } catch (Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
            DB::rollBack();
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
