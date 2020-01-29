<?php

namespace App\Http\Controllers\Admin;

use App\Areas;
use App\Artist;
use App\ArtistPermit;
use App\ArtistPermitTransaction;
use App\ConstantValue;
use App\Country;
use App\Event;
use App\EventTransaction;
use App\Gender;
use App\Permit;
use App\Profession;
use App\VisaType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\DeclareDeclare;
use Yajra\DataTables\Facades\DataTables;
use function foo\func;

class ReportController extends Controller
{
    public function reports()
    {
        $artist = Artist::all();
        $country = Country::wherehas('artistPermit.permit', function ($query) {
            $query->where('permit_status', 'active');
        })->latest();

        $profession = Profession::wherehas('artistPermit.permit', function ($query) {
            $query->where('permit_status', 'active');
        })->latest();

        $areas = Areas::wherehas('artistPermit.permit', function ($query) {
            $query->where('permit_status', 'active');
        })->latest();

        $visa = VisaType::wherehas('artistPermit.permit', function ($query) {
            $query->where('permit_status', 'active');
        })->latest();

        $gender = Gender::wherehas('artistPermit.permit', function ($query) {
            $query->where('permit_status', 'active');
        })->get();

        $artistPermit = ArtistPermit::with('artist')->has('permit')->with('country')->with('profession')->get();
        $artisttransactions = ArtistPermitTransaction::with('transaction')->orderBy('created_at', 'desc')->get();
        $eventtransactions = EventTransaction::with('transaction')->orderBy('created_at', 'desc')->latest();
        $transactions = $artisttransactions->merge($eventtransactions);

        return view('admin.report.index', [
            'page_title' => 'Reports Dashboard',
            'permit' => $artist,
            'country' => $country,
            'profession' => $profession,
            'areas' => $areas,
            'gender' => $gender,
            'visas' => $visa,
            'artistPermit' => $artistPermit,
            'transactions' => $transactions,
            'professions' => Profession::has('artistpermit')->latest(),
            'countries' => Country::has('artistpermit')->latest(),
            'new_request' => Permit::has('artist')->where('permit_status', 'new')->count(),
            'pending_request' => Permit::has('artist')->where('permit_status', 'modified')->count(),
            'approved_permit' => Permit::lastMonth(['active'])->count(),
            'rejected_permit' => Permit::lastMonth(['rejected'])->count(),
            'cancelled_permit' => Permit::lastMonth(['cancelled'])->count(),
            'active_permit' => Permit::lastMonth(['active', 'approved-unpaid', 'rejected', 'expired', 'modification request'])->count()


        ]);
    }

    public function artist_reports()
    {
        $all = [];
        $artists = Artist::has('permit')->has('artistPermit')->with(['permit' => function ($q) {
            $q->where('permit_status', 'active')->whereDate('expired_date', '>', Carbon::now());
        }])->get();

        foreach ($artists as $artist) {
            if ($artist->permit->count() > 0) {
                array_push($all, $artist);
            }
        }
        $myArray = collect($all);
        return Datatables::of($myArray)
            ->addColumn('person_code', function (Artist $user) {
                return $user->person_code;
            })
            ->addColumn('artist_status', function (Artist $user) {
                return $user->artist_status;
            })
            ->addColumn('artist_name', function (Artist $user) {
                if ($user->artistPermit) {

                    foreach ($user->artistPermit as $artist) {
                        return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                    }
                }
                return '';
            })
            ->addColumn('profession', function (Artist $user) {
                foreach ($user->artistPermit as $artist) {
                    return Auth()->user()->LanguageId == 1 ? $artist->profession->name_en : $artist->profession->name_ar;
                }
            })
            ->addColumn('nationality', function (Artist $user) {
                foreach ($user->artistPermit as $artist) {
                    return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                }
            })
            ->addColumn('mobile_number', function (Artist $user) {
                foreach ($user->artistPermit as $artist) {
                    return $artist->mobile_number;
                }
            })
            ->addColumn('permit_status', function (Artist $user) {
                foreach ($user->artistPermit as $artist) {
                    return $artist->permit->permit_status;
                }
            })
            ->addColumn('email', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return $artist->email;
                    }
                }
                return '';
            })
            ->addColumn('identification_number', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return $artist->identification_number;
                    }
                }
                return '';
            })
            ->addColumn('address_en', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return Auth()->user()->LanguageId == 1 ? $artist->address_en : $artist->address_ar;
                    }
                }
                return '';
            })
            ->addColumn('language_id', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return Auth()->user()->LanguageId == 1 ? $artist->language->name_en : $artist->language->name_ar;
                    }
                }
                return '';
            })
            ->addColumn('fax_number', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return $artist->fax_number;
                    }
                }
                return '';
            })
            ->addColumn('po_box', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return $artist->po_box;
                    }
                }
                return '';
            })
            ->addColumn('emirate_id', function (Artist $user) {
                if ($user->artistPermit) {
                    foreach ($user->artistPermit as $artist) {
                        return Auth()->user()->LanguageId == 1 ? $artist->emirate->name_en : $artist->emirate->name_ar;
                    }
                }
                return '';
            })
            ->addColumn('artist_id', function (Artist $user) {
                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                    $q->where('artist_id',$user->artist_id);
                })->where('permit_status','active')->whereDate('expired_date','>',Carbon::now())->get()->count();
                return "<button type='button' style='height: 22px;
                           line-height: 4px;white-space: nowrap;
                           border-radius: 3px'  class='btn btn-outline-warning btn-sm button_modal{{$user->artist_id}}'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                         $permit Permits</button>";
            })
            ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
            ->make(true);
    }

    public function search_active_artist(Request $request){
        if ($request->ajax()) {
               $artist=Artist::when($request->filter_search == ConstantValue::ARTISTNAME, function ($query) use ($request) {
                    $query->wherehas('artistPermit',function ($q) use ($request){
                        $q->where('firstname_en', 'LIKE', "%{$request->search_artist}%");
                    });
              })
             ->when($request->filter_search == ConstantValue::GENDER,function($query) use ($request) {
                 $query->whereHas('artistPermit', function ($q) use ($request) {
                             $q->where('gender_id', $request->search_artist);
                      });
                 })

             ->when($request->filter_search == ConstantValue::PROFESSION,function ($q) use ($request) {
                     $q->whereHas('artistPermit', function ($query) use ($request) {
                         $query->where('profession_id', 'LIKE', "%{$request->search_artist}%");
                      });
                    })

                   ->when($request->filter_search == ConstantValue::AGE,function ($q) use ($request) {
                       if ($request->search_artist == 17) {
                           $q->wherehas('artistPermit', function ($q) {
                               $q->where('birthdate', '>', date('Y-m-d', strtotime('-18 years')));
                           })->with('artistPermit');
                       }
                       if ($request->search_artist == 18) {
                           $q->wherehas('artistPermit', function ($q) {
                               $q->where('birthdate', '<=', date('Y-m-d', strtotime('-18 years')));
                             })->with('artistPermit');
                           }
                       })
                           ->where('artist_status','active')->get();

               return Datatables::of($artist)
                   ->addColumn('person_code', function (Artist $user) {
                       return $user->person_code;
                   })
                   ->addColumn('artist_status', function (Artist $user) {
                       return $user->artist_status;
                   })
                   ->addColumn('artist_name', function (Artist $user) {
                       foreach ($user->artistPermit as $artist) {
                           return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                       }
                   })
                   ->addColumn('profession', function (Artist $user) {
                       foreach ($user->artistPermit as $artist) {
                           return Auth()->user()->LanguageId == 1 ? $artist->profession->name_en : $artist->profession->name_ar;
                       }
                   })
                   ->addColumn('nationality', function (Artist $user) {
                       foreach ($user->artistPermit as $artist) {
                           return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                       }
                   })
                   ->addColumn('mobile_number', function (Artist $user) {
                       foreach ($user->artistPermit as $artist) {
                           return $artist->mobile_number;
                       }
                   })
                   ->addColumn('permit_status', function (Artist $user) {
                       foreach ($user->artistPermit as $artist) {
                           return $artist->permit->permit_status;
                       }

                   })
                   ->addColumn('email', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return $artist->email;
                           }
                       }
                       return '';
                   })
                   ->addColumn('identification_number', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return $artist->identification_number;
                           }
                       }
                       return '';
                   })
                   ->addColumn('address_en', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return Auth()->user()->LanguageId == 1 ? $artist->address_en : $artist->address_ar;
                           }
                       }
                       return '';
                   })
                   ->addColumn('language_id', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return Auth()->user()->LanguageId == 1 ? $artist->language->name_en : $artist->language->name_ar;
                           }
                       }
                       return '';
                   })
                   ->addColumn('fax_number', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return $artist->fax_number;
                           }
                       }
                       return '';
                   })
                   ->addColumn('po_box', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return $artist->po_box;
                           }
                       }
                       return '';
                   })
                   ->addColumn('emirate_id', function (Artist $user) {
                       if ($user->artistPermit) {
                           foreach ($user->artistPermit as $artist) {
                               return Auth()->user()->LanguageId == 1 ? $artist->emirate->name_en : $artist->emirate->name_ar;
                           }
                       }
                       return '';
                   })
                   ->addColumn('artist_id', function (Artist $user) {
                       foreach ($user->artistPermit as $artist)
                           $permit = Permit::wherehas('artistPermit', function ($q) use ($user) {
                               $q->where('artist_id', $user->artist_id);
                           })->where('permit_status', 'active')->whereDate('expired_date', '>', Carbon::today()->toDateString())->get()->count();

                       return "<button type='button' style='height: 22px;
                           line-height: 4px;
                           border-radius: 3px;white-space: nowrap;
                           '  class='btn btn-outline-warning btn-sm button_modal{{$user->artist_id}}'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                         $permit Permits</button>";
                   })
                   ->rawColumns(['artist_id', 'person_code', 'artist_status', 'artist_name'])
                   ->make(true);

    }
               }

    public function search_artist(Request $request)
    {
        if ($request->ajax()) {
            if ($request->filter_search != '' && $request->search_artist != '') {

                if ($request->filter_search == ConstantValue::STATUS) {
                    $artist = Artist::whereHas('artistPermit')->whereHas('permit')->where('artist_status', $request->search_artist)->latest();

                    return Datatables::of($artist)
                        ->addColumn('person_code', function (Artist $user) {
                            return $user->person_code;
                        })
                        ->addColumn('artist_status', function (Artist $user) {
                            return $user->artist_status;
                        })
                        ->addColumn('artist_name', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                            }
                        })
                        ->addColumn('profession', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->profession->name_en : $artist->profession->name_ar;
                            }
                        })
                        ->addColumn('nationality', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                            }
                        })
                        ->addColumn('mobile_number', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->mobile_number;
                            }
                        })
                        ->addColumn('permit_status', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->permit->permit_status;
                            }

                        })
                        ->addColumn('email', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            }
                            return '';
                        })
                        ->addColumn('identification_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('address_en', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->address_en : $artist->address_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('language_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->language->name_en : $artist->language->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('fax_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->fax_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('po_box', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            }
                            return '';
                        })
                        ->addColumn('emirate_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->emirate->name_en : $artist->emirate->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('artist_id', function (Artist $user) {
                            foreach ($user->artistPermit as $artist)
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->where('permit_status','active')->whereDate('expired_date','>',Carbon::today()->toDateString())->get()->count();

                            return "<button type='button' style='height: 22px;
                           line-height: 4px;
                           border-radius: 3px;white-space: nowrap;
                           '  class='btn btn-outline-warning btn-sm button_modal{{$user->artist_id}}'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                         $permit Permits</button>";
                        })
                        ->rawColumns(['artist_id', 'person_code', 'artist_status', 'artist_name'])
                        ->make(true);
                }


                if ($request->filter_search == ConstantValue::GENDER) {
                    $artist = Artist::wherehas('permit', function ($query) {
                        $query->where('permit_status', 'active');
                    })->when($request->search_artist, function ($q) use ($request) {
                        $q->whereHas('artistPermit', function ($query) use ($request) {
                            $query->where('gender_id', $request->search_artist);
                        });
                    })->latest();

                    return Datatables::of($artist)
                        ->addColumn('person_code', function (Artist $user) {
                            return $user->person_code;
                        })
                        ->addColumn('artist_status', function (Artist $user) {
                            return $user->artist_status;
                        })
                        ->addColumn('artist_name', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                            }
                        })
                        ->addColumn('profession', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->profession->name_en : $artist->profession->name_ar;
                            }
                        })
                        ->addColumn('nationality', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                            }
                        })
                        ->addColumn('mobile_number', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->mobile_number;
                            }
                        })
                        ->addColumn('permit_status', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->permit->permit_status;
                            }

                        })
                        ->addColumn('email', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            }
                            return '';
                        })
                        ->addColumn('identification_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('address_en', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->address_en : $artist->address_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('language_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->language->name_en : $artist->language->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('fax_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->fax_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('po_box', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            }
                            return '';
                        })
                        ->addColumn('emirate_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->emirate->name_en : $artist->emirate->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('artist_id', function (Artist $user) {
                            foreach ($user->artistPermit as $artist)
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();

                            return "<button type='button' style='height: 22px;
                           line-height: 4px;
                           border-radius: 3px;white-space: nowrap;'
                             class='btn btn-outline-warning btn-sm button_modal{{$user->artist_id}}'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                          $permit Permits</button>";
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                        ->make(true);

                }


                if ($request->filter_search == ConstantValue::ARTISTNAME) {
                    $artist = Artist::wherehas('permit', function ($query) {
                        $query->where('permit_status', 'active');
                    })->when($request->search_artist, function ($q) use ($request) {
                        $q->whereHas('artistPermit', function ($query) use ($request) {
                            $query->where('firstname_en', 'LIKE', "%{$request->search_artist}%");
                        });
                    })->latest();

                    return Datatables::of($artist)
                        ->addColumn('person_code', function (Artist $user) {
                            return $user->person_code;
                        })
                        ->addColumn('artist_status', function (Artist $user) {
                            return $user->artist_status;
                        })
                        ->addColumn('artist_name', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                            }
                        })
                        ->addColumn('profession', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->profession->name_en : $artist->profession->name_ar;
                            }
                        })
                        ->addColumn('nationality', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                            }
                        })
                        ->addColumn('mobile_number', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->mobile_number;
                            }
                        })
                        ->addColumn('permit_status', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->permit->permit_status;
                            }

                        })
                        ->addColumn('email', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            }
                            return '';
                        })
                        ->addColumn('identification_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('address_en', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->address_en : $artist->address_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('language_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->language->name_en : $artist->language->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('fax_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->fax_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('po_box', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            }
                            return '';
                        })
                        ->addColumn('emirate_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->emirate->name_en : $artist->emirate->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('artist_id', function (Artist $user) {
                            $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                $q->where('artist_id',$user->artist_id);
                            })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();
                            return "<button type='button' style='height: 22px;
                           line-height: 4px;
                           border-radius: 3px;white-space: nowrap;'
                             class='btn btn-outline-warning btn-sm button_modal{{$user->artist_id}}'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                          $permit Permits</button>";
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name', 'identification_number', 'address_en', 'artist_id', 'email'])
                        ->make(true);
                }

                if ($request->filter_search == ConstantValue::PROFESSION) {
                    $artist = Artist::wherehas('permit', function ($query) {
                        $query->where('permit_status', 'active');
                    })->when($request->search_artist, function ($q) use ($request) {
                        $q->whereHas('artistPermit', function ($query) use ($request) {
                            $query->where('profession_id', 'LIKE', "%{$request->search_artist}%");
                        });
                    })->latest();

                    return Datatables::of($artist)
                        ->addColumn('person_code', function (Artist $user) {
                            return $user->person_code;
                        })
                        ->addColumn('artist_status', function (Artist $user) {
                            return $user->artist_status;
                        })
                        ->addColumn('artist_name', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                            }
                        })
                        ->addColumn('profession', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                            }
                        })
                        ->addColumn('nationality', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                            }
                        })
                        ->addColumn('mobile_number', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->mobile_number;
                            }
                        })
                        ->addColumn('permit_status', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->permit->permit_status;
                            }

                        })
                        ->addColumn('email', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            }
                            return '';
                        })
                        ->addColumn('identification_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('address_en', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('language_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('fax_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->fax_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('po_box', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            }
                            return '';
                        })
                        ->addColumn('emirate_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('artist_id', function (Artist $user) {

                            $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                $q->where('artist_id',$user->artist_id);
                            })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();
                            return "<button type='button' style='height: 22px;
                    line-height: 4px;
                   border-radius: 3px;white-space: nowrap;'
                   class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                    $permit Permits</button>";
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name', 'identification_number', 'email', 'address_en', 'artist_id'])
                        ->make(true);
                }
                if ($request->filter_search == ConstantValue::NATIONALITY) {

                    $artist = Artist::wherehas('permit', function ($query) {
                        $query->where('permit_status', 'active');
                    })->when($request->search_artist, function ($q) use ($request) {
                        $q->whereHas('artistPermit', function ($query) use ($request) {
                            $query->where('country_id', 'LIKE', "%{$request->search_artist}%");
                        });
                    })->latest();
                    return Datatables::of($artist)
                        ->addColumn('person_code', function (Artist $user) {
                            return $user->person_code;
                        })
                        ->addColumn('artist_status', function (Artist $user) {
                            return $user->artist_status;
                        })
                        ->addColumn('artist_name', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                            }
                        })
                        ->addColumn('profession', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                            }
                        })
                        ->addColumn('nationality', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                            }
                        })
                        ->addColumn('mobile_number', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->mobile_number;
                            }
                        })
                        ->addColumn('permit_status', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->permit->permit_status;
                            }

                        })
                        ->addColumn('email', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            }
                            return '';
                        })
                        ->addColumn('identification_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('address_en', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('language_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('fax_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->fax_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('po_box', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            }
                            return '';
                        })
                        ->addColumn('emirate_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('artist_id', function (Artist $user) {
                            $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                $q->where('artist_id',$user->artist_id);
                            })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();
                            return "<button type='button' style='height: 22px;
                 line-height: 4px;
                   border-radius: 3px;white-space: nowrap'
                  class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                 $permit Permits</button>";
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                        ->make(true);
                }

                $single = [];
                $multiple = [];


                if ($request->filter_search == ConstantValue::NUMBER_OF_PERMIT) {
                    if ($request->search_artist == 'single') {
                        $artists = Artist::wherehas('artistPermit.permit', function ($query) {
                            $query->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now());
                        })->with('permit')->where('artist_status','active')->get();

                        foreach ($artists as $artist) {
                            if ($artist->permit->count() == 1) {
                                array_push($single, $artist);
                            }
                        }
                        $myArray = collect($single);
                        return Datatables::of($myArray)
                            ->addColumn('person_code', function (Artist $user) {
                                return $user->person_code;
                            })
                            ->addColumn('artist_status', function (Artist $user) {
                                return $user->artist_status;
                            })
                            ->addColumn('artist_name', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                                }
                            })
                            ->addColumn('profession', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                                }
                            })
                            ->addColumn('nationality', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_ar;
                                }
                            })
                            ->addColumn('mobile_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->mobile_number;
                                }
                            })
                            ->addColumn('permit_status', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->permit->permit_status;
                                }
                            })
                            ->addColumn('email', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            })
                            ->addColumn('identification_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            })
                            ->addColumn('address_en', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            })
                            ->addColumn('language_id', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('fax_number', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return $artist->fax_number;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('po_box', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return $artist->po_box;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('emirate_id', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('artist_id', function (Artist $user) {
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->whereDate('expired_date','>',Carbon::now())->where('permit_status','active')->get()->count();

                                return "<button type='button' style='height: 22px;
                               line-height: 4px;
                                border-radius: 3px;white-space: nowrap'
                                 class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                               $permit Permits</button>";
                            })
                            ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                            ->make(true);
                    }
                    if ($request->search_artist == 'multiple') {

                        $artists = Artist::wherehas('artistPermit.permit', function ($query) {
                            $query->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now());
                        })->where('artist_status','active')->get();
                        foreach ($artists as $artist) {
                            if ($artist->permit->count() > 1) {
                                array_push($multiple, $artist);
                            }
                        }
                        $myArray = collect($multiple);

                        return Datatables::of($myArray)
                            ->addColumn('person_code', function (Artist $user) {
                                return $user->person_code;
                            })
                            ->addColumn('artist_status', function (Artist $user) {
                                return $user->artist_status;
                            })
                            ->addColumn('artist_name', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                                }
                            })
                            ->addColumn('profession', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                                }
                            })
                            ->addColumn('nationality', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_ar;
                                }
                            })
                            ->addColumn('mobile_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->mobile_number;
                                }
                            })
                            ->addColumn('permit_status', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->permit->permit_status;
                                }
                            })
                            ->addColumn('email', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            })
                            ->addColumn('identification_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            })
                            ->addColumn('address_en', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            })
                            ->addColumn('language_id', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('fax_number', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return $artist->fax_number;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('po_box', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return $artist->po_box;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('emirate_id', function (Artist $user) {
                                if ($user->artistPermit) {
                                    foreach ($user->artistPermit as $artist) {
                                        return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                    }
                                }
                                return '';
                            })
                            ->addColumn('artist_id', function (Artist $user) {
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->whereDate('expired_date','>',Carbon::now())->where('permit_status','active')->get()->count();
                                return "<button type='button' style='height: 22px;
                               line-height: 4px;
                                border-radius: 3px;white-space: nowrap'
                                  class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                               $permit Permits</button>";
                            })
                            ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                            ->make(true);
                    }
                    if ($request->search_artist == 'all') {
                        $allArtists = [];

                        $artists = Artist::wherehas('artistPermit.permit', function ($query) {
                            $query->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now());
                        })->where('artist_status','active')->get();

                        foreach ($artists as $artist) {
                            if ($artist->permit->count() > 0) {
                                array_push($allArtists, $artist);
                            }
                        }
                        $myArray = collect($allArtists);
                        return Datatables::of($myArray)
                            ->addColumn('person_code', function (Artist $user) {
                                return $user->person_code;
                            })
                            ->addColumn('artist_status', function (Artist $user) {
                                return $user->artist_status;
                            })
                            ->addColumn('artist_name', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                                }
                            })
                            ->addColumn('profession', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                                }
                            })
                            ->addColumn('nationality', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_ar;
                                }
                            })
                            ->addColumn('mobile_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->mobile_number;
                                }
                            })
                            ->addColumn('permit_status', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->permit->permit_status;
                                }
                            })
                            ->addColumn('email', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            })
                            ->addColumn('identification_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            })
                            ->addColumn('address_en', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            })
                            ->addColumn('language_id', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                }
                            })
                            ->addColumn('emirate_id', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                }
                            })
                            ->addColumn('po_box', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            })
                            ->addColumn('fax_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            })
                            ->addColumn('artist_id', function (Artist $user) {
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->whereDate('expired_date','>',Carbon::now())->where('permit_status','active')->get()->count();
                                return "<button type='button' style='height: 22px;
                               line-height: 4px;
                                border-radius: 3px;white-space: nowrap'
                                  class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                               $permit Permits</button>";
                            })
                            ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                            ->make(true);
                    }

                    $artist = ArtistPermit::where('country_id', $request->search_artist)->with('artist')->with('country')->latest();
                    return Datatables::of($artist)
                        ->addColumn('person_code', function (ArtistPermit $user) {
                            return $user->artist->person_code;
                        })
                        ->addColumn('artist_status', function (ArtistPermit $user) {
                            return $user->artist->artist_status;
                        })
                        ->addColumn('artist_name', function (ArtistPermit $user) {
                            return Auth()->user()->LanguageId == 1 ? $user->firstname_en . ' ' . $user->lastname_en : $user->firstname_ar . ' ' . $user->lastname_ar;
                        })
                        ->addColumn('profession', function (ArtistPermit $user) {
                            return $user->profession->name_en;
                        })
                        ->addColumn('nationality', function (ArtistPermit $user) {
                            return Auth()->user()->LanguageId == 1 ? $user->country->nationality_en : $user->country->nationality_ar;
                        })
                        ->addColumn('mobile_number', function (ArtistPermit $user) {
                            return $user->mobile_number;
                        })
                        ->addColumn('permit_status', function (ArtistPermit $user) {
                            return $user->permit->permit_status;
                        })
                        ->addColumn('artist_id', function (ArtistPermit $user) {
                            return '';
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name'])
                        ->make(true);
                }

                if ($request->filter_search == ConstantValue::VISATYPE) {
                    $artist = Artist::wherehas('permit', function ($query) {
                        $query->where('permit_status', 'active');
                    })->when($request->search_artist, function ($q) use ($request) {
                        $q->whereHas('artistPermit', function ($query) use ($request) {
                            $query->where('visa_type_id', 'LIKE', "%{$request->search_artist}%");
                        });
                    })->latest();
                    return Datatables::of($artist)
                        ->addColumn('person_code', function (Artist $user) {
                            return $user->person_code;
                        })
                        ->addColumn('artist_status', function (Artist $user) {
                            return $user->artist_status;
                        })
                        ->addColumn('artist_name', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                            }
                        })
                        ->addColumn('profession', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                            }
                        })
                        ->addColumn('nationality', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_en;
                            }
                        })
                        ->addColumn('mobile_number', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->mobile_number;
                            }
                        })
                        ->addColumn('permit_status', function (Artist $user) {
                            foreach ($user->artistPermit as $artist) {
                                return $artist->permit->permit_status;
                            }

                        })
                        ->addColumn('email', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            }
                            return '';
                        })
                        ->addColumn('identification_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('address_en', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('language_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('fax_number', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->fax_number;
                                }
                            }
                            return '';
                        })
                        ->addColumn('po_box', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            }
                            return '';
                        })
                        ->addColumn('emirate_id', function (Artist $user) {
                            if ($user->artistPermit) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                }
                            }
                            return '';
                        })
                        ->addColumn('artist_id', function (Artist $user) {
                            $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                $q->where('artist_id',$user->artist_id);
                            })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();
                            return "<button type='button' style='height: 22px;
                     line-height: 4px;
                      border-radius: 3px;white-space: nowrap'
                     class='btn btn-outline-warning btn-sm button_modal{{$user->artist_id}}'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                          $permit Permits</button>";
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                        ->make(true);
                }

                if ($request->filter_search == ConstantValue::AGE) {
                    if ($request->search_artist == 17) {
                        /*  $artist = ArtistPermit::with('artist')->has('permit')->with(['permit'=>function($q){$q->where('permit_status','active');}])->with('country')->where('birthdate', '>', date('Y-m-d', strtotime('-18 years')))->get();*/

                        $artist = Artist::wherehas('artistPermit.permit', function ($query) {
                            $query->where('permit_status', 'active');
                        })->wherehas('artistPermit', function ($q) {
                            $q->where('birthdate', '>', date('Y-m-d', strtotime('-18 years')));
                        })->with('artistPermit')->latest();

                        return Datatables::of($artist)
                            ->addColumn('person_code', function (Artist $user) {
                                return $user->person_code;
                            })
                            ->addColumn('artist_status', function (Artist $user) {
                                return $user->artist_status;
                            })
                            ->addColumn('artist_name', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                                }
                            })
                            ->addColumn('profession', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                                }
                            })
                            ->addColumn('nationality', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_ar;
                                }
                            })
                            ->addColumn('mobile_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->mobile_number;
                                }
                            })
                            ->addColumn('permit_status', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->permit->permit_status;
                                }
                            })
                            ->addColumn('email', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            })
                            ->addColumn('identification_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            })
                            ->addColumn('address_en', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            })
                            ->addColumn('language_id', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                }
                            })
                            ->addColumn('emirate_id', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                }
                            })
                            ->addColumn('po_box', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            })
                            ->addColumn('fax_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            })
                            ->addColumn('artist_id', function (Artist $user) {
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();

                                return "<button type='button' style='height: 22px;
                                line-height: 4px;
                                border-radius: 3px;white-space: nowrap;'
                               class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                             $permit Permits</button>";
                            })
                            ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                            ->make(true);
                    }
                    if ($request->search_artist == 18) {
                        $artist = Artist::wherehas('artistPermit.permit', function ($query) {
                            $query->where('permit_status', 'active');
                        })->wherehas('artistPermit', function ($q) {
                            $q->where('birthdate', '<=', date('Y-m-d', strtotime('-18 years')));
                        })->with('artistPermit')->latest();

                        return Datatables::of($artist)
                            ->addColumn('person_code', function (Artist $user) {
                                return $user->person_code;
                            })
                            ->addColumn('artist_status', function (Artist $user) {
                                return $user->artist_status;
                            })
                            ->addColumn('artist_name', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->firstname_en . ' ' . $artist->lastname_en : $artist->firstname_ar . ' ' . $artist->lastname_ar;
                                }
                            })
                            ->addColumn('profession', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->profession->name_en:$artist->profession->name_ar;
                                }
                            })
                            ->addColumn('nationality', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId == 1 ? $artist->country->nationality_en : $artist->country->nationality_ar;
                                }
                            })
                            ->addColumn('mobile_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->mobile_number;
                                }
                            })
                            ->addColumn('permit_status', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->permit->permit_status;
                                }
                            })
                            ->addColumn('email', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->email;
                                }
                            })
                            ->addColumn('identification_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->identification_number;
                                }
                            })
                            ->addColumn('address_en', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->address_en:$artist->address_ar;
                                }
                            })
                            ->addColumn('language_id', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->language->name_en:$artist->language->name_ar;
                                }
                            })
                            ->addColumn('emirate_id', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return Auth()->user()->LanguageId==1?$artist->emirate->name_en:$artist->emirate->name_ar;
                                }
                            })
                            ->addColumn('po_box', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            })
                            ->addColumn('fax_number', function (Artist $user) {
                                foreach ($user->artistPermit as $artist) {
                                    return $artist->po_box;
                                }
                            })
                            ->addColumn('artist_id', function (Artist $user) {
                                $permit=Permit::wherehas('artistPermit',function ($q) use ($user){
                                    $q->where('artist_id',$user->artist_id);
                                })->where('permit_status', 'active')->whereDate('expired_date','>',Carbon::now())->get()->count();

                                return "<button type='button' style='height: 22px;
                         line-height: 4px;
                         border-radius: 3px;white-space: nowrap;'
                         class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                             $permit Permits</button>";
                            })
                            ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                            ->make(true);
                    }
                }

                if ($request->filter_search == ConstantValue::AREA) {
                    $artist = ArtistPermit::where('area_id', $request->search_artist)->with('artist')->with('country')->latest();

                    return Datatables::of($artist)
                        ->addColumn('person_code', function (ArtistPermit $user) {
                            return $user->artist->person_code;
                        })
                        ->addColumn('artist_status', function (ArtistPermit $user) {
                            return $user->artist->artist_status;
                        })
                        ->addColumn('artist_name', function (ArtistPermit $user) {
                            return Auth()->user()->LanguageId == 1 ? $user->firstname_en . ' ' . $user->lastname_en : $user->firstname_ar . ' ' . $user->lastname_ar;
                        })
                        ->addColumn('profession', function (ArtistPermit $user) {
                            return $user->profession->name_en;
                        })
                        ->addColumn('nationality', function (ArtistPermit $user) {
                            return Auth()->user()->LanguageId == 1 ? $user->country->nationality_en : $user->country->nationality_ar;
                        })
                        ->addColumn('mobile_number', function (ArtistPermit $user) {
                            return $user->mobile_number;
                        })
                        ->addColumn('permit_status', function (ArtistPermit $user) {
                            return $user->permit->permit_status;
                        })
                        ->addColumn('artist_id', function (ArtistPermit $user) {

                            return "<button type='button' style='height: 22px;
                 line-height: 4px;
                   border-radius: 3px;white-space: nowrap'
                     class='btn btn-outline-warning btn-sm'  onclick='viewArtistDetails($user->artist_id)' data-toggle='modal' data-target='#artist_modal_$user->artist_id'>
                             View</button>";
                        })
                        ->rawColumns(['person_code', 'artist_status', 'artist_name', 'artist_id'])
                        ->make(true);
                }

            }
        }
    }

    public function artist_permit_report($id)
    {
        $artist = Artist::findOrFail($id);

        $artist_permit = ArtistPermit::whereHas('permit', function ($q) {
            $q->whereNotIn('permit_status', ['draft', 'edit']);
        })
            ->where('artist_id', $artist->artist_id)->latest()->first();
        return view('admin.report.artistpermit.show', [
            'page_title' => $artist_permit->fullname . ' - details',
            'artist_permit' => $artist_permit,
            'artist' => $artist
        ]);
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $limit = $request->length;
            $start = $request->start;

            $permit = Permit::has('artist')
                ->when($request->request_type, function ($q) use ($request) {
                    $q->where('request_type', $request->request_type);
                })
                ->when($request->status, function ($q) use ($request) {
                    $q->whereIn('permit_status', $request->status);
                })
                ->when($request->date, function ($q) use ($request) {
                    $date = $request->date;
                    $q->whereDate('created_at', '>=', Carbon::parse($date['start'])->startOfDay()->toDateTimeString())
                        ->whereDate('created_at', '<=', Carbon::parse($date['end'])->endOfDay()->toDateTimeString());
                })
                ->when($request->approval, function ($q) use ($request) {
                    $q->whereHas('comment', function ($q) use ($request) {
                        $q->where('action', 'pending')->where('role_id', $request->user()->roles()->first()->role_id);
                    });
                })
                ->latest();

            $table = Datatables::of($permit)
                ->addColumn('artist_number', function ($permit) {
                    $total = $permit->artistpermit()->count();
                    $check = $permit->artistpermit()->where('artist_permit_status', '!=', 'unchecked')->count();
                    if ($permit->permit_status == 'active' || $permit->permit_status == 'expired') {
                        return 'Active ' . $check . ' of ' . $total;
                    }
                    return 'Checked ' . $check . ' of ' . $total;
                })
                ->editColumn('permit_status', function ($permit) {
                    return permitStatus($permit->permit_status);
                })
                ->editColumn('reference_number', function ($permit) {
                    return '<span class="kt-font-bold">' . $permit->reference_number . '</span>';
                })
                ->addColumn('applied_date', function ($permit) {
                    return '<span class="text-underline" title="' . $permit->created_at->format('l d-M-Y h:i A') . '">' . humanDate($permit->created_at) . '</span>';
                })
                ->editColumn('permit_start', function ($permit) {
                    if (!$permit->issued_date) return null;
                    return $permit->issued_date->format('d-M-Y');
                })
                ->addColumn('company_name', function ($permit) use ($request) {
                    return $request->user()->LanguageId == 1 ? ucfirst($permit->owner->company->name_en) : $permit->owner->company->name_ar;
                })
                ->addColumn('company_type', function ($permit) {
                    return;
                    $class_name = 'default';
                    if (strtolower($permit->company->company_type) == 'corporate') {
                        $class_name = 'success';
                    }
                    if (strtolower($permit->company->company_type) == 'government') {
                        $class_name = 'danger';
                    }
                    return '<span class="kt-badge kt-badge--' . $class_name . ' kt-badge--inline">' . ucwords($permit->company->company_type) . '</span>';
                })
                ->editColumn('request_type', function ($permit) {
                    return ucwords($permit->request_type) . ' Application';
                })
                ->addColumn('action', function ($permit) {
                    return '</button><a href="' . route('admin.artist_permit.download', $permit->permit_id) . '" target="_blank" class="btn btn-download btn-sm btn-elevate btn-outline-dark">' . __('Details') . '</a>';
                })
                ->addColumn('inspection_url', function ($permit) {
                    return route('tasks.artist_permit.details', $permit->permit_id);
                })
                ->rawColumns(['request_type', 'reference_number', 'company_type', 'permit_status', 'action', 'applied_date'])
                ->make(true);
            $table = $table->getData(true);
            $table['new_count'] = Permit::has('artist')->where('permit_status', 'new')->count();
            $table['pending_count'] = Permit::has('artist')->where('permit_status', 'modified')->count();
            $table['cancelled_count'] = Permit::has('artist')->where('permit_status', 'cancelled')->count();

            return response()->json($table);
        }
    }

    public function all_artist_permits(Request $request, Permit $permit, Artist $artist)
    {
        $artist = ArtistPermit::whereHas('permit')->latest();

        return Datatables::of($artist)
            ->editColumn('reference_number', function ($artist) {
                return $artist->permit->reference_number;
            })
            ->editColumn('permit_start', function ($artist) {
                return $artist->permit->issued_date->format('d-M-Y h:m a');
            })
            ->editColumn('expiry_date', function ($artist) {
                return $artist->permit->expired_date->format('d-M-Y h:m a');
            })
            ->editColumn('permit_status', function ($artist) {
                $class_name = strtolower($artist->permit->permit_status) == 'active' ? 'success' : 'danger';
                return ' <span class="kt-badge kt-badge--' . $class_name . ' kt-badge--inline">' . ucwords($artist->permit->permit_status) . '</span>';
            })
            ->editColumn('permit_number', function ($artist) {
                return $artist->permit->permit_number;
            })
            ->editColumn('company_name', function ($artist) {
                return ucwords($artist->permit->company->company_name);
            })
            ->rawColumns(['permit_status'])
            ->make(true);
    }

    public function artistHistory($id)
    {
        $artist_permit = ArtistPermit::whereHas('permit', function($q){
        $q->whereNotIn('permit_status', ['draft', 'edit']);
    })
        ->where('artist_id', $id)->latest()->first();
         $artist=Artist::find($id);

        return view('admin.report.artistpermit.artistHistory', [
            'page_title' => $artist_permit->firstname_en.' - details',
            'artist_permit' => $artist_permit,
            'artist'=>$artist
        ]);

       /* $artist = Artist::where('artist_id',$id)->with('permit')->wherehas('artistPermit', function ($q) {
            $q->with('permit');
           })->first();
        return view('admin.report.artistpermit.show', [
            'page_title' => $artist->fullname.' - details',
            'artist'=>$artist,
        ]);*/
    }
}

