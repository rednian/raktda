<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\ArtistPermit;
use App\Country;
use App\Event;
use App\Profession;
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
                if($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return $artist->profession->name_en;
                    }
                }return 'No Profession';
            })
            ->addColumn('nationality', function(Artist $user) {
              if($user->artistPermit) {
                  foreach ($user->artistPermit as $artist) {
                      return $artist->country->nationality_en;
                  }
              }
              return 'No Nationality';
            })
            ->addColumn('mobile_number', function(Artist $user) {
                if($user->artistPermit){
                foreach ($user->artistPermit as $artist){
                    return $artist->mobile_number;
                }}
                return ' No Nationality';
            })
            ->addColumn('permit_status', function(Artist $user) {
               if($user->artistPermit) {
                   foreach ($user->artistPermit as $artist) {
                       return $artist->permit->permit_status;
                   }
               }
               return 'No Status';
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
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->profession->name_en;
                              }
                          }return 'No Profession';
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->country->nationality_en;
                              }
                          }
                          return 'No Nationality';
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->mobile_number;
                              }}
                          return ' No Nationality';
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->permit->permit_status;
                              }
                          }
                          return 'No Status';
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
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->firstname_en. ' ' .$artist->lastname_en;
                              }
                          }
                          return 'No Artist Name';
                      })
                      ->addColumn('profession', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->profession->name_en;
                              }
                          }return 'No Profession';
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->country->nationality_en;
                              }
                          }
                          return 'No Nationality';
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->mobile_number;
                              }}
                          return ' No Nationality';
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->permit->permit_status;
                              }
                          }
                          return 'No Status';
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }

              if ($request->filter_search==4){

                  $artist = ArtistPermit::with('artist')->with('profession')->where('profession_id',$request->search_artist)->get();

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
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->firstname_en. ' ' .$artist->lastname_en;
                              }
                          }
                          return 'No Artist Name';
                      })
                      ->addColumn('profession', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->profession->name_en;
                              }
                          }return 'No Profession';
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->country->nationality_en;
                              }
                          }
                          return 'No Nationality';
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->mobile_number;
                              }}
                          return ' No Nationality';
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->permit->permit_status;
                              }
                          }
                          return 'No Status';
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }
              if ($request->filter_search==5){
                  $artist = ArtistPermit::where('country_id',$request->search_artist)->with('artist')->with('country')->get();

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
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->firstname_en. ' ' .$artist->lastname_en;
                              }
                          }
                          return 'No Artist Name';
                      })
                      ->addColumn('profession', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->profession->name_en;
                              }
                          }return 'No Profession';
                      })
                      ->addColumn('nationality', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->country->nationality_en;
                              }
                          }
                          return 'No Nationality';
                      })
                      ->addColumn('mobile_number', function(Artist $user) {
                          if($user->artistPermit){
                              foreach ($user->artistPermit as $artist){
                                  return $artist->mobile_number;
                              }}
                          return ' No Nationality';
                      })
                      ->addColumn('permit_status', function(Artist $user) {
                          if($user->artistPermit) {
                              foreach ($user->artistPermit as $artist) {
                                  return $artist->permit->permit_status;
                              }
                          }
                          return 'No Status';
                      })
                      ->rawColumns(['person_code','artist_status','artist_name'])
                      ->make(true);
              }
          }
      }
    }
}
