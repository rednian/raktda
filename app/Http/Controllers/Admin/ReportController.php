<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\ArtistPermit;
use App\Country;
use App\Event;
use App\Permit;
use App\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function reports(){
        $artist = Artist::all();
        $country=Country::pluck('nationality_en','country_id')->all();
        $profession=Profession::pluck('name_en','profession_id')->all();

        return view('admin.report.index', [
            'page_title'=> 'Reports Dashboard',
            'permit'=>$artist,
            'country'=>$country,
            'profession'=>$profession,

            'professions'=>Profession::has('artistpermit')->get(),
            'countries'=> Country::has('artistpermit')->get(),
            'new_request'=> Permit::has('artist')->where('permit_status', 'new')->count(),
            'pending_request'=> Permit::has('artist')->where('permit_status', 'modified')->count(),
            'approved_permit'=> Permit::lastMonth(['active'])->count(),
            'rejected_permit'=> Permit::lastMonth(['rejected'])->count(),
            'cancelled_permit'=> Permit::lastMonth(['cancelled'])->count(),
            'active_permit'=> Permit::lastMonth(['active', 'approved-unpaid', 'rejected', 'expired', 'modification request'])->count()


        ]);
    }

    public function artist_reports(){
        return Datatables::of(Artist::with('artistPermit'))
            ->addColumn('artist_id', function(Artist $user) {
                return '';
            })
            ->addColumn('person_code', function(Artist $user) {
                return $user->person_code;
            })
            ->addColumn('artist_status', function(Artist $user) {
                return $user->artist_status;
            })
            ->addColumn('artist_name', function(Artist $user) {
                if($user->artistPermit){
                foreach ($user->artistPermit as $artist){
                    return $artist->firstname_en. ' ' .$artist->lastname_en;
                }
                }
                return 'No Artist Name';
            })
            ->addColumn('profession', function(Artist $user) {
                foreach ($user->artistPermit as $artist){
                    return $artist->profession->name_en;
                }
            })
            ->addColumn('nationality', function(Artist $user) {
                foreach ($user->artistPermit as $artist){
                    return $artist->country->nationality_en;
                }
            })
            ->addColumn('mobile_number', function(Artist $user) {
                foreach ($user->artistPermit as $artist){
                    return $artist->mobile_number;
                }
            })
            ->addColumn('permit_status', function(Artist $user) {
                foreach ($user->artistPermit as $artist){
                    return $artist->permit->permit_status;
                }
            })
            ->rawColumns(['person_code','artist_status','artist_name'])
            ->make(true);
        }


    public function search_artist(Request $request){
      if ($request->ajax()) {
          if ($request->filter_search != '' && $request->search_artist != '') {
              if ($request->filter_search==1){
                  $artist = Artist::with('artistPermit')->where('person_code','LIKE', "%{$request->search_artist}%")->get();

                  return Datatables::of($artist)
                      ->addColumn('artist_id', function(Artist $user) {
                          return '1';
                      })
                      ->addColumn('person_code', function(Artist $user) {
                          return $user->person_code;
                      })
                      ->addColumn('artist_status', function(Artist $user) {
                          return $user->artist_status;
                      })
                      ->addColumn('artist_name', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->firstname_en. ' ' .$artist->lastname_en;
                          }
                      })
                      ->addColumn('profession', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->profession->name_en;
                          }
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->country->nationality_en;
                          }
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->mobile_number;
                          }
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->permit->permit_status;
                          }
                      })
                      ->rawColumns(['artist_id','person_code','artist_status','artist_name'])
                      ->make(true);
              }
              if ($request->filter_search==2){
                  $artist = Artist::with('artistPermit')->where('artist_status','LIKE', "%{$request->search_artist}%")->get();
                  return Datatables::of($artist)

                      ->addColumn('artist_id', function(Artist $user) {
                          return '';
                      })
                      ->addColumn('person_code', function(Artist $user) {
                          return $user->person_code;
                      })
                      ->addColumn('artist_status', function(Artist $user) {
                          return $user->artist_status;
                      })
                      ->addColumn('artist_name', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->firstname_en. ' ' .$artist->lastname_en;
                          }
                      })
                      ->addColumn('profession', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->profession->name_en;
                          }
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->country->nationality_en;
                          }
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->mobile_number;
                          }
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->permit->permit_status;
                          }
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);

              }
              if ($request->filter_search==3){
                //  dd($request->search_artist);
                  $artist = Artist::whereHas('artistPermit', function($q) use ($request)
                  {
                      $q->where('firstname_en','LIKE' ,"%$request->search_artist%");
                  })->get();

                  return Datatables::of($artist)
                      ->addColumn('artist_id', function(Artist $user) {
                          return '';
                      })
                      ->addColumn('person_code', function(Artist $user) {
                          return $user->person_code;
                      })
                      ->addColumn('artist_status', function(Artist $user) {
                          return $user->artist_status;
                      })
                      ->addColumn('artist_name', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->firstname_en. ' ' .$artist->lastname_en;
                          }
                      })
                      ->addColumn('profession', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->profession->name_en;
                          }
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->country->nationality_en;
                          }
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->mobile_number;
                          }
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          foreach ($user->artistPermit as $artist){
                              return $artist->permit->permit_status;
                          }
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }

              if ($request->filter_search==4){

                  $artist = ArtistPermit::with('artist')->with('profession')->where('profession_id',$request->search_artist)->get();

                  return Datatables::of($artist)
                      ->addColumn('artist_id', function(ArtistPermit $user) {
                          return '';
                      })
                      ->addColumn('person_code', function(ArtistPermit $user) {
                          return $user->artist->person_code;
                      })
                      ->addColumn('artist_status', function(ArtistPermit $user) {
                          return $user->artist->artist_status;
                      })
                      ->addColumn('artist_name', function(ArtistPermit $user) {
                              return $user->firstname_en. ' ' .$user->lastname_en;
                      })
                      ->addColumn('profession', function(ArtistPermit $user) {
                              return $user->profession->name_en;
                      })
                      ->addColumn('nationality', function(ArtistPermit $user) {
                              return $user->country->nationality_en;

                      })
                      ->addColumn('mobile_number', function(ArtistPermit $user) {
                              return $user->mobile_number;
                      })
                      ->addColumn('permit_status', function(ArtistPermit $user) {
                              return $user->permit->permit_status;
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }
              if ($request->filter_search==5){
                  $artist = ArtistPermit::where('country_id',$request->search_artist)->with('artist')->with('country')->get();

                  return Datatables::of($artist)
                      ->addColumn('artist_id', function(ArtistPermit $user) {
                          return '';
                      })
                      ->addColumn('person_code', function(ArtistPermit $user) {
                          return $user->artist->person_code;
                      })
                      ->addColumn('artist_status', function(ArtistPermit $user) {
                          return $user->artist->artist_status;
                      })
                      ->addColumn('artist_name', function(ArtistPermit $user) {
                          return $user->firstname_en. ' ' .$user->lastname_en;
                      })
                      ->addColumn('profession', function(ArtistPermit $user) {
                          return $user->profession->name_en;
                      })
                      ->addColumn('nationality', function(ArtistPermit $user) {
                          return $user->country->nationality_en;
                      })
                      ->addColumn('mobile_number', function(ArtistPermit $user) {
                          return $user->mobile_number;
                      })
                      ->addColumn('permit_status', function(ArtistPermit $user) {
                          return $user->permit->permit_status;
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }
          }
      }
    }

    public function artist_permit_report($id){

        $artist = Artist::findOrFail($id);

        $artist_permit = ArtistPermit::whereHas('permit', function($q){
            $q->whereNotIn('permit_status', ['draft', 'edit']);
        })
            ->where('artist_id', $artist->artist_id)->latest()->first();
        return view('admin.report.artistpermit.show', [
            'page_title' => $artist_permit->fullname.' - details',
            'artist_permit' => $artist_permit,
            'artist'=>$artist
        ]);
    }

    public function dataTable(Request $request)
    {
        if($request->ajax()){

            $limit = $request->length;
            $start = $request->start;

            $permit = Permit::has('artist')
                ->when($request->request_type, function ($q) use ($request){
                    $q->where('request_type', $request->request_type);
                })
                ->when($request->status, function($q) use ($request){
                    $q->whereIn('permit_status', $request->status);
                })
                ->when($request->date, function ($q) use ($request){
                    $date = $request->date;
                    $q->whereDate('created_at', '>=', Carbon::parse($date['start'])->startOfDay()->toDateTimeString())
                        ->whereDate('created_at', '<=', Carbon::parse($date['end'])->endOfDay()->toDateTimeString());
                })
                ->when($request->approval, function($q) use($request){
                    $q->whereHas('comment', function($q) use($request){
                        $q->where('action', 'pending')->where('role_id', $request->user()->roles()->first()->role_id);
                    });
                })
                ->latest();

            $table = Datatables::of($permit)
                ->addColumn('artist_number', function($permit){
                    $total = $permit->artistpermit()->count();
                    $check = $permit->artistpermit()->where('artist_permit_status', '!=', 'unchecked')->count();
                    if($permit->permit_status == 'active' || $permit->permit_status == 'expired'){ return 'Active '.$check.' of '.$total; }
                    return 'Checked '.$check.' of '.$total;
                })
                ->editColumn('permit_status', function($permit){ return permitStatus($permit->permit_status); })
                ->editColumn('reference_number', function($permit){ return '<span class="kt-font-bold">'.$permit->reference_number.'</span>'; })
                ->addColumn('applied_date', function($permit){
                    return '<span class="text-underline" title="'.$permit->created_at->format('l d-M-Y h:i A').'">'.humanDate($permit->created_at).'</span>';
                })
                ->editColumn('permit_start', function($permit){
                    if(!$permit->issued_date) return null;
                    return $permit->issued_date->format('d-M-Y');
                })
                ->addColumn('company_name', function($permit) use ($request){
                    return $request->user()->LanguageId == 1 ? ucfirst($permit->owner->company->name_en) : $permit->owner->company->name_ar;
                })
                ->addColumn('company_type', function($permit){
                    return;
                    $class_name = 'default';
                    if(strtolower($permit->company->company_type) == 'private'){$class_name = 'success'; }
                    if(strtolower($permit->company->company_type) == 'government'){$class_name = 'danger'; }
                    if(strtolower($permit->company->company_type) == 'individual'){$class_name = 'info'; }
                    return '<span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($permit->company->company_type).'</span>';
                })
                ->editColumn('request_type', function($permit){
                    return ucwords($permit->request_type).' Application';
                })
                ->addColumn('action', function($permit){
                    return  '</button><a href="'.route('admin.artist_permit.download', $permit->permit_id).'" target="_blank" class="btn btn-download btn-sm btn-elevate btn-outline-dark">' . __('Details') . '</a>';
                })
                ->addColumn('inspection_url', function($permit){
                    return route('tasks.artist_permit.details', $permit->permit_id);
                })
                ->rawColumns(['request_type', 'reference_number', 'company_type', 'permit_status', 'action' , 'applied_date'])
                ->make(true);
            $table = $table->getData(true);
            $table['new_count'] = Permit::has('artist')->where('permit_status', 'new')->count();
            $table['pending_count'] = Permit::has('artist')->where('permit_status', 'modified')->count();
            $table['cancelled_count'] = Permit::has('artist')->where('permit_status', 'cancelled')->count();

            return response()->json($table);
        }
    }

}
