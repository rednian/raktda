<?php
    namespace App\Http\Controllers\Admin;

	use App\Permit;
	use Carbon\Carbon;
	use App\Artist;
	use App\ArtistAction;
	use App\ArtistPermit;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\URL;
    use Yajra\DataTables\Facades\DataTables;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;

	class ArtistController extends Controller
	{
		public function __construct(){
	        $this->middleware('signed')->except([
	            'artist_block',
				'artist_unblock',
				'updateStatus',
				'datatable',
				'statusHistory',
				'permithistory',
				'history',
				'checked_list',
				'activePermitDatatable',
	        ]);
	    }
		public function artist_block(Request $request){
			$data=$request->all();
		    foreach ($data['id'] as $artist_id) {
             $artist = Artist::where('artist_id', $artist_id)->first();

             if ($artist->update(['artist_status' => 'blocked'])) {
                 $artist_action = new ArtistAction();
                 $artist_action->artist_id = $artist_id;
                 $artist_action->user_id = Auth::user()->user_id;
                 $artist_action->remarks = $request->remarks;
                 $artist_action->save();
             }
         }
            return response()->json();
		}

        public function artist_unblock(Request $request){
            $data=$request->all();
            foreach ($data['id'] as $artist_id) {
                $artist = Artist::where('artist_id', $artist_id)->first();

                if ($artist->update(['artist_status' => 'active'])) {
                    $artist_action = new ArtistAction();
                    $artist_action->artist_id = $artist_id;
                    $artist_action->user_id = Auth::user()->user_id;
                    $artist_action->remarks = $request->remarks;
                    $artist_action->save();
                }
            }
            return response()->json();

        }

		public function updateStatus(Request $request, Artist $artist)
		{
			try {
				$artist->update(['artist_status'=>$request->status]);
				$request['action'] = $request->status == 'active' ?  'unblocked' : $request->status;
				$request['user_id'] = $request->user()->user_id;
				$artist->action()->create($request->all());
				$result = ['success', 'Artist has been '.$request->action.' Successfully ', 'Success'];
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];

			}

			return redirect(URL::signedRoute('admin.artist.show', $artist->artist_id))->with('message', $result);
		}

		public function show(Request $request, Artist $artist)
		{
		    $artist_permit = ArtistPermit::whereHas('permit', function($q){
				$q->whereNotIn('permit_status', ['draft', 'edit']);
			})
			->where('artist_id', $artist->artist_id)->latest()->first();

			return view('admin.artist.show', [
				 'page_title' => $artist_permit->fullname.' - details',
				 'artist_permit' => $artist_permit,
				 'artist'=>$artist
			]);
		}


		public function activePermitDatatable(Artist $artist)
		{
			 $permits = $artist->permit()
                ->where('permit_status', 'active')
                ->whereDate('expired_date', '>=', Carbon::now())
                ->get();
			return Datatables::of($permits)
                ->addColumn('profession', function($permit){
                    return $permit->artistPermit()->latest()->first()->profession->name;
                })
                ->addColumn('name', function($permit){
                    return $permit->owner->company->name;
                })
                ->editColumn('expired_date', function($permit){
                    return $permit->expired_date->format('d-F-Y');
                })
                ->addColumn('location', function($permit){
                    return $permit->location;
                })
                ->addColumn('link', function($permit){
                    return URL::signedRoute('admin.artist_permit.show', ['permit' => $permit->permit_id]);
                })
			->make(true);
		}


		public function datatable(Request $request)
		{
		    if ($request->ajax()) {
		        $artist = Artist::has('artistpermit.profession')
                    ->whereHas('permit', function($q){
                        $q->whereNotIn('permit_status',['draft', 'edit']);
                    })
                    ->when($request->artist_status, function($q) use ($request){
                        $q->where('artist_status', $request->artist_status);
                    })
                    ->when($request->profession_id, function($q) use ($request){
                        $q->whereHas('artistpermit', function($q) use ($request){
                            $q->where('profession_id', $request->profession_id);
                        });
                    })
                    ->when($request->country_id, function($q) use ($request){
                        $q->whereHas('artistpermit', function($q) use ($request){
                            $q->where('country_id', $request->country_id);
                        });
                    })
                    ->orderby('updated_at', 'desc')
                    ->get();

		        return DataTables::of($artist)
                    ->addColumn('name', function($artist){
                        return ucwords($artist->artistpermit()->latest()->first()->fullname);
                    })
                    ->addColumn('nationality', function($artist){
                        return ucwords($artist->artistpermit()->first()->country->nationality_en);
                    })
                    ->addColumn('mobile_number', function($artist){
                        return $artist->artistPermit()->latest()->first()->mobile_number;
                    })
                    ->addColumn('profession', function($artist){
                        return ucwords($artist->artistpermit()->latest()->first()->profession->name_en);
                    })
                    ->editColumn('artist_status', function($artist){
                        return permitStatus(ucfirst($artist->artist_status));
                    })
                    ->addColumn('birthdate', function($artist){
                        return $artist->artistPermit()->latest()->first()->birthdate->format('d-F-Y');
                    })
                    ->addColumn('age', function($artist){
                        return $artist->artistPermit()->latest()->first()->age;
                    })
                    ->addColumn('active_permit', function($artist){
                        $permit = $artist->permit()->where('permit_status', 'active')->whereDate('expired_date', '>=', Carbon::now())->count();
                        return '<button type="button" class=" btn btn-show-permit btn-sm btn-secondary">'.__('View').' <span class="kt-badge kt-badge--outline kt-badge--info"> '.$permit.' </span></button>';
                    })
                    ->addColumn('artist_status', function($artist){
                        return artistStatus($artist->artist_status);
                    })
                    ->addColumn('show_link', function($artist){
                        return URL::signedRoute('admin.artist.show', $artist->artist_id);
                    })
                    ->rawColumns(['name', 'nationality', 'artist_status', 'active_permit'])
					 // ->setTotalRecords($totalRecords)
					 ->make(true);

			}
		}

		public function statusHistory(Request $request, Artist $artist)
		{
			$action = ArtistAction::where('artist_id', $artist->artist_id)->latest();
			return DataTables::of($action)
				 ->editColumn('created_at', function($action){
					 return '<span class="text-underline" title="'.$action->created_at->format('l h:i A | d-F-Y').'">'.humanDate($action->created_at).'</span>';
				 })
				 ->addColumn('name', function($action){
				 	return profileName($action->user->NameEn, $action->user->roles()->first()->NameEn);
				 })
				 ->editColumn('action', function($action){
					 return artistStatus($action->action);
				 })
				 ->editColumn('remarks', function($action){
					 return ucfirst($action->remarks);
				 })
				 ->rawColumns(['action', 'name', 'created_at'])
				 ->make(true);
		}



		public function permitHistory(Request $request, Artist $artist)
		{

			$permit = Permit::whereHas('artistpermit', function($q) use ($artist){
				$q->where('artist_id', $artist->artist_id);
			})
				 ->whereNotIn('permit_status', ['draft'])
				 ->orderBy('permit_status')
				 ->orderBy('updated_at', 'desc')
				 ->get();
			return DataTables::of($permit)
				 ->editColumn('issued_date', function($permit){
					 if ($permit->permit_status == 'new') {
						 return null;
					 }
					 return $permit->issued_date->format('d-M-Y');
				 })
				 ->editColumn('reference_number', function($permit){
					 return '<span class="kt-font-bold">'.$permit->reference_number.'</span>';
				 })
				 ->editColumn('expired_date', function($permit){
					 if (!$permit->expired_date) {
						 return null;
					 }
					 if ($permit->permit_status == 'new') {
						 return null;
					 }
					 return $permit->issued_date->format('d-M-Y');
				 })
				 ->addColumn('company_name', function($permit){
					 return ucwords($permit->owner->company->name_en);
				 })
				 ->editColumn('permit_status', function($permit){
				 	return permitStatus($permit->permit_status);
				 })
				 ->rawColumns(['permit_status', 'reference_number'])
				 ->make(true);
		}

		public function history(Request $request, ArtistPermit $artistpermit)
		{

			$artist_permit = $artistpermit->datatable()
				 ->where('artist_permit.artist_id', $artistpermit->artist_id)
				 ->where('artist_permit.artist_permit_id', '!=', $artistpermit->artist_permit_id)
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
		public  function checked_list(Request $request){
		    $data=[];
            foreach ($request->id as $item) {
                $action = Artist::where('artist_id', $item)->orderBy('created_at', 'desc')->first();
                array_push($data,$action);
            }
             return response()->json($data);
        }
	}

