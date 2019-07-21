<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Company;
use App\Artist;
use App\ArtistPermit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index(Request $request)
    { 
        $company = ArtistPermit::artistPermit($request)->groupBy('artist_permit.company_id')->orderBy('company_name',)->get();
        return view('admin.artist_permit.index',['companies'=>$company]);
    }

    public function application(Request $request, ArtistPermit $artistPermit)
    {
        return view('admin.artist_permit.application',['artist_permit'=>$artistPermit]);
    }

 
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
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
        //
    }

    public function datatableRequest(Request $request)
    {
        $permit = ArtistPermit::requestType('new')->orderBy('artist_permit.created_at', 'DESC')->get();
         return Datatables::of($permit)->make(true);   
    }


    public function datatable(Request $request)
    { 
        $permit = ArtistPermit::artistPermit($request)->get();    
        return Datatables::of($permit)->make(true);   
    } 
}
