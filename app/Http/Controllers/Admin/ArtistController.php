<?php

namespace App\Http\Controllers\Admin;
use DB;
use DataTables;

use App\Artist;
use App\ArtistPermit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function history(Request $request, ArtistPermit $artistpermit)
    {
        $artist_permit = $artistpermit->datatable()
                                      ->where('artist_permit.artist_id', $artistpermit->artist_id)
                                      ->where('artist_permit.artist_permit_id','!=' ,$artistpermit->artist_permit_id)
                                      ->get();
          return Datatables::of($artist_permit)
                            ->editColumn('issued_date', function($artist_permit){
                                     return date('d-M-Y', strtotime($artist_permit->issued_date));
                            })
                            
                            ->editColumn('expired_date', function($artist_permit){
                                   return $artist_permit->expired_date ? date('d-M-Y', strtotime($artist_permit->expired_date)) : null;
                            })
                            ->make(true);   
    }
}
