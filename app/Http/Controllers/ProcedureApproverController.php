<?php

namespace App\Http\Controllers;

use App\ProcedureApprover;
use Illuminate\Http\Request;

class ProcedureApproverController extends Controller
{
    public function index()
    {
        return view('admin.settings.procedure.index');
    }


    public function create()
    {
          return view('admin.settings.procedure.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(ProcedureApprover $procedureApprover)
    {
        //
    }


    public function edit(ProcedureApprover $procedureApprover)
    {
        //
    }


    public function update(Request $request, ProcedureApprover $procedureApprover)
    {
        //
    }


    public function destroy(ProcedureApprover $procedureApprover)
    {
        //
    }
}
