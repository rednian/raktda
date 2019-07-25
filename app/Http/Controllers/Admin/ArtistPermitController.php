<?php

namespace App\Http\Controllers\Admin;

use DB;
use DataTables;
use App\ArtistPermit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistPermitController extends Controller
{
    public function index()
    {
        $data['companies'] = ArtistPermit::dataTable()->where('permit_status', '!=', 'pending')->groupBy('permit.company_id')->get();
        $data['breadcrumb'] = 'artist.index';
        $data['page_title'] = 'Artist Permit Dashboard';
        return view('admin.artist_permit.index', $data);
    }

    public function dataTable(Request $request)
    {   
        if($request->ajax()){
             $artist_permit = ArtistPermit::dataTable()
                                ->when($request->company_id, function($q) use ($request){
                                    $q->where('permit.company_id', $request->company_id);
                                })
                                ->when($request->permit_status, function($q) use ($request){
                                    $q->where('permit.permit_status', $request->permit_status);
                                })
                                ->where('permit_status', '!=', 'pending')
                                ->groupBy('artist_permit.artist_id')
                                ->get();
            
            return Datatables::of($artist_permit)->make(true);   
        }
       
    }
}
