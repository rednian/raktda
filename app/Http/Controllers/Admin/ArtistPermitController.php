<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use DataTables;
use Carbon\Carbon;

use App\Artist;
use App\Permit;
use App\Company;
use App\ArtistPermit;
use App\ArtistPermitComment;
use App\ArtistPermitRivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ArtistPermitController extends Controller
{

    public function index()
    {
        $companies = ArtistPermit::dataTable()->where('permit_status', '!=', 'pending')->groupBy('permit.company_id')->get();
   
        $data['breadcrumb'] = 'admin.artist_permit.index';
        $data['page_title'] = 'Artist Permit Dashboard';
        return view('admin.artist_permit.index', [
            'page_title'=> 'Artist Permit Dashboard',
            'breadcrumb'=> 'admin.artist_permit.index',
            'companies' =>$companies
        ]);
    }

    public function saveDraft(Request $request, Permit $permit, ArtistPermit $artistpermit)
    {
        $request['user_id'] = Auth::user()->user_id;
        $permit_comment  = ArtistPermitComment::where('artist_permit_id', $artistpermit->artist_permit_id)->get();
        // dd($permit);
        if($permit_comment->count() > 0){
            $artistpermit->comment()->update($request->except('data'));
        }
        else{  
            $permit_comment = $artistpermit->comment()->create($request->except('data')); 
        }
         $artistpermit->artistPermitRivision()->delete();

        if($request->data){
            foreach ($request->data as $value) {
                // $value['artist_permit_comment_id'] = $permit_comment->artist_permit_comment_id;
                $artistpermit->artistPermitRivision()->create($value);
            }
        }
    }

    public function checkApplication(Request $request,Permit $permit,  ArtistPermit $artistpermit)
    {
            return view('admin.artist_permit.check-application',[
            'page_title' => 'Check Artist Details',
            'breadcrumb'=> ['admin.artist_permit.checkApplication', $permit],
            'artist_permit'=> $artistpermit,
        ]);
    }

    public function applicationDetails(Request $request, Permit $permit)
    {
        return view('admin.artist_permit.application-details', [
            'page_title'=>'Artist Permit Application Details',
            'breadcrumb'=>['admin.artist_permit.applicationdetails', $permit],
            'permit' => $permit,
        ]);
    }

    public function applicationDataTable(Request $request, Permit $permit)
    {
        if($request->ajax()){
            $artist_permit = ArtistPermit::dataTable()
                                ->where('artist_permit.permit_id', $permit->permit_id)->get();
              return Datatables::of($artist_permit)
                                ->addColumn('age', function($artist_permit){
                                    return $artist_permit->artist->age;
                                })
                                ->editColumn('status_label', function($artist_permit){
                                    $status = $artist_permit->artist_permit_status;
                                    $class= 'primary';
                                    if($status == 'rejected'){ $class = 'danger'; }
                                    if($status == 'complete'){ $class = 'success'; }
                                    if($status == 'incomple'){ $class = 'warning'; }

                                    return label(['class'=> $class, 'status'=> $status]);
                                   
                                })
                                ->addColumn('ischeck', function($artist_permit){

                                    $rivision_exist = $artist_permit->whereHas('artistPermitRivision', function($q) use ($artist_permit){
                                        $q->where('artist_permit_id', $artist_permit->artist_permit_id);
                                    })->exists();

                                    $is_check = 'empty';

                                    // if($rivision_exist){
                                    //      foreach ($artist_permit->artistPermitRivision as $checklist) {
                                    //          if($checklist->ischeck == 0){ $is_check = 'incomplete'; }
                                    //          return $is_check;
                                    //      }
                                    // }

                                })
                                ->rawColumns(['status_label'])
                                ->make(true);
        }
               
    }


    public function requestDataTable(Request $request)
    {
        if($request->ajax()){
            $artist_permit = ArtistPermit::dataTable()
                                ->select('*', DB::raw('permit.created_at AS submitted_date'), DB::raw('COUNT(artist_permit.artist_id) AS artist_number'))
                                ->where('permit_status', 'pending')
                                ->groupBy('artist_permit.permit_id')
                                ->orderBy('permit.permit_id', 'DESC')
                                ->get();

            return Datatables::of($artist_permit)
                                ->editColumn('submitted_date', function($artist_permit){
                                        return date('d-M-Y', strtotime($artist_permit->submitted_date));
                                })
                                  ->editColumn('issued_date', function($artist_permit){
                                        return date('d-M-Y', strtotime($artist_permit->issued_date));
                                })
                                  ->editColumn('expired_date', function($artist_permit){
                                         return $artist_permit->expired_date ? date('d-M-Y', strtotime($artist_permit->expired_date)) : null;
                                  })
                                ->make(true);   
        }
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
                                ->orderBy('permit.updated_at', 'DESC')
                                ->get();
            
            return Datatables::of($artist_permit)->make(true);   
        }
       
    }

    public function artistDataTable(Request $request)
    {
        $artist = Artist::orderBy('artist_id', 'desc')->get();

        return Datatables::of($artist)
                        ->make(true);
    }
}
