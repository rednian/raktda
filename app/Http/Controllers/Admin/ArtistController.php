<?php

	namespace App\Http\Controllers\Admin;

	use App\Permit;
	use Carbon\Carbon;
	use App\Artist;
	use App\ArtistAction;
	use App\ArtistPermit;
    use Illuminate\Support\Facades\Auth;
    use Yajra\DataTables\Facades\DataTables;
    use function foo\func;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;

	class ArtistController extends Controller
	{
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
			if ($request->is_multiple) {

			} else {
				$status = $request->status == 'block' ? 'blocked': 'active';
				$artist->update(['artist_status' => $status]);
				$artist->action()->create([
					 'remarks'=>$request->remarks,
					 'action'=> $status,
					 'user_id'=>Auth::user()->user_id,
				]);
			}
			return redirect()->back()->with(['']);
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
						 return ucfirst($artist->artist_status);
					 })

					 ->addColumn('active_permit', function($artist){
						 return $artist->permit()->where('permit_status', 'active')->whereDate('expired_date', '>=', Carbon::now())->count();
					 })
					 ->addColumn('artist_status', function($artist){
					 	return artistStatus($artist->artist_status);
					 })

					 ->rawColumns(['name', 'nationality', 'artist_status'])
					 // ->setTotalRecords($totalRecords)
					 ->make(true);

			}
		}

		public function statusHistory(Request $request, Artist $artist)
		{
			$action = ArtistAction::where('artist_id', $artist->artist_id)->orderBy('created_at', 'desc')->get();
			return DataTables::of($action)
				 ->editColumn('created_at', function($action){
					 return $action->created_at->format('d-M-Y h a');
				 })
				 ->addColumn('employee_name', function($action){
					 return ucwords($action->user->NameEn);
				 })
				 ->editColumn('action', function($action){
					 return artistStatus($action->action);
				 })
				 ->editColumn('remarks', function($action){
					 return ucfirst($action->remarks);
				 })
				 ->rawColumns(['action'])
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
					 $class_name = 'default';
					 $permit_status = $permit->permit_status;
					 if (strtolower($permit->permit_status) == 'new' || strtolower($permit->permit_status) == 'approved-unpaid' || strtolower($permit->permit_status) == 'active') {
						 $class_name = 'success';
					 }
					 if (strtolower($permit->permit_status) == 'processing' || strtolower($permit->permit_status) == 'modification request' || strtolower($permit->permit_status) == 'modified') {
						 $class_name = 'warning';
					 }
					 if (strtolower($permit->permit_status) == 'pending from client') {
						 $class_name = 'info';
					 }
					 if (strtolower($permit->permit_status) == 'new-update from client') {
						 $class_name = 'info';
					 }
					 if (strtolower($permit->permit_status) == 'unprocessed' || strtolower($permit->permit_status) == 'expired' || strtolower($permit->permit_status) == 'rejected') {
						 $class_name = 'danger';
					 }
					 if (strtolower($permit->permit_status) == 'modification request') {
						 $permit_status = 'need modification';
					 }
					 return '<span class="kt-badge kt-badge--'.$class_name.' kt-badge--inline">'.ucwords($permit_status).'</span>';
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

