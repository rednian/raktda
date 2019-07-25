<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Company;
use App\Artist;
use App\Permit;
use App\ArtistPermit;
use App\Requirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index(Request $request)
    { 
        $permit = Permit::getBystatus('pending')->get();
        dd($permit);
        
        $data['companies'] = ArtistPermit::artistPermit($request)->groupBy('artist_permit.company_id')->orderBy('company_name',)->get();
        $data['breadcrumb'] = 'artist.index';
        $data['page_title'] = 'Artist Permit Dashboard';
        return view('admin.artist_permit.index', $data);
    }

    public function applicationDetails(Request $request, $id)
    {
        $artistPermit = ArtistPermit::with('artist')->find($id);
        $company = Company::find($artistPermit->company_id);
        $data['artist_permit'] = $artistPermit;
        $data['company'] = $company;
        $data['breadcrumb'] = ['artist.application.details', $artistPermit];
        $data['page_title']  = 'Artist Permit Application Details'; 

        return view('admin.artist_permit.application-details', $data);
    }

    public function submit_artist(Request $request)
    {
        return $request->all();
    }

    public function artistDetails(Request $request, $id)
    {   
        $artistPermit = ArtistPermit::with('artist', 'artist.requirement')->find($id);
        $company = Company::find($artistPermit->company_id);
        $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();

        return view('admin.artist_permit.artist_detail',[
                                'artist_permit'=>$artistPermit, 
                                'company'=>$company,
                                'requirements'=>$requirements
                            ]);
    }

    public function artistDocuments(Request $request, ArtistPermit $artistPermit)
    {
        
         $company = Company::find($artistPermit->company_id);
        return view('admin.artist_permit.artist_documents', ['artist_permit'=>$artistPermit, 'company'=>$company]);
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
        $artists = Artist::dataTable()->get();
        dd($artists);
    } 
}
