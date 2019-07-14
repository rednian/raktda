<?php

namespace App\Http\Controllers\Admin;

use App\Permit;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{

    public function datatable()
    {
        $permit = Permit::join('permit_detail', 'permit_detail.permit_id', '=', 'permit.permit_id')
                    ->join('artist_permit', 'artist_permit.permit_detail_id', '=', 'permit_detail.permit_detail_id')
                    ->join('artist', 'artist_permit.artist_id', '=', 'artist.artist_id')
                    //->join('artist_document', 'artist_document.artist_id', '=', 'artist.artist_id')
                   // ->join('artist_type', 'artist_permit.artist_type_id', '=', 'artist_type.artist_type_id')
                   ->join('bls.company', 'bls.company.company_id', '=', 'permit_detail.company_id')
                    ->where('permit_type', 'artist')->get();
        return Datatables::of($permit)->make(true);   
    }   

//--------------------------------------------------------------------------
// Resource below
//--------------------------------------------------------------------------

    public function index()
    {
        return view('admin.artist_permit.index');
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
}
