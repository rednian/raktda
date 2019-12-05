<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    //

    public function reports(){

        $artist = Artist::all();

        return view('admin.report.index', [
            'page_title'=> 'Reports Dashboard',
            'permit'=>$artist
        ]);
    }

    public function artist_reports(){
        return Datatables::of(Artist::with('artistPermit'))
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

    public function search_artist(Request $request){
      if ($request->ajax()) {
          if ($request->filter_search != '' && $request->search_artist != '') {
              if ($request->filter_search==1){
                  $artist = Artist::with('artistPermit')->where('person_code','LIKE', $request->search_artist)->get();
                  return Datatables::of($artist)
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
              if ($request->filter_search==2){
                  $artist = Artist::with('artistPermit')->where('artist_status','LIKE', $request->search_artist)->get();
                  return Datatables::of($artist)
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
                  $artist=Artist::whereHas('artistPermit',function ($q) use ($request){
                      $q->whereHas('profession', function($q) use ($request) {

                          return $q->where('name_en', 'LIKE', '%'. $request->artist_search . '%');
                      })->get();
                      }) ;
               //   dd($artist);

                  return Datatables::of($artist)
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

                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }
              if ($request->filter_search==5){
                  $artist = Artist::with('artistPermit')->where('person_code','LIKE', $request->search_artist)->get();
                  dd($artist);
              }
          }
      }
    }
}
