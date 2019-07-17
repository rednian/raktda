<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profession;
use PragmaRX\Countries\Package\Countries;
use Carbon\Carbon;
use App\Artist;
use App\ArtistDocument;
use App\ArtistPermit;
use Auth;
use Excel;
use Yajra\Datatables\Datatables;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('permits.artist.index');
    }


    public function applied_list()
    {
        // $artists = ArtistPermit::with('artist', 'artist.artisttype')->orderBy('artist_permit.created_at', 'desc');

        $artists = Artist::with(['artistpermit' => function ($q) {
            return  $q->where('permit_status', 'new');
        }, 'artisttype'])->orderBy('artist.created_at', 'desc')->get();


        //->where('permit_status', 'new')

        return Datatables::of($artists)->editColumn('created_at', function ($artists) {
            if ($artists->created_at) {
                return $artists->created_at->format('d-m-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($artist) {
            if ($artist->artistpermit['permit_status'] == 'approved') {
                return '<a href="' . route('make_payment', $artist->artist_permit_id) . '" class="btn btn-sm btn-success">Payment</a>';
            } else if ($artist->artistpermit['permit_status'] == 'new') {
                return '<button onClick="cancel_permit(' . $artist->artist_permit_id . ')" data-toggle="modal" data-target="#cancel_permit" class="btn btn-sm btn-dark">Cancel</a>';
            } else if ($artist->artistpermit['permit_status'] == 'rejected') {
                return '<button onClick="rejected_permit(' . $artist->artist_permit_id . ')" data-toggle="modal" data-target="#rejected_permit" class="btn btn-sm btn-warning">Rejected</a>';
            } else if ($artist->artistpermit['permit_status'] == 'cancelled') {
                return '<button onClick="show_cancelled(' . $artist->artist_permit_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="btn btn-sm btn-danger">Cancelled</a>';
            }
        })->addColumn('details', function ($artist) {
            return '<button type="button" target="_blank" class="btn btn-link btn-sm" data-toggle="modal" data-target="#artist_details" onclick="show_details(' . $artist->artist_permit_id . ')">details</button>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function makepayment($id)
    {
        $data_bundle['profession'] = Profession::all();
        $data_bundle['countries'] = Countries::all()->pluck('name.common');
        $data_bundle['artist_details'] = ArtistPermit::with('artist', 'artist.artisttype')->where('artist_permit_id', $id)->get();
        return view('permits.artist.payment', $data_bundle);
    }


    public function existing_list()
    {
        $artists = Artist::with('artistpermit', 'artisttype')->where('artist_permit.permit_status')->orderBy('artist.created_at', 'desc')->get();

        dd($artists);

        //->where('permit_status', '!=', 'new')->orWhereNull('permit_status');

        // $artists = ArtistPermit::with('artist', 'artist.artisttype')->orderBy('artist_permit.created_at', 'desc');

        return Datatables::of($artists)->editColumn('created_at', function ($artists) {
            if ($artists->artist['created_at']) {
                return $artists->artist['created_at']->format('d-m-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($artist) {
            return '<a href="' . route('extend_permit', $artist->artist_permit_id) . '"  class="btn btn-sm btn-default">Extend</a>';
        })->addColumn('details', function ($artist) {
            return '<button type="button" target="_blank" class="btn btn-link btn-sm" data-toggle="modal" data-target="#artist_details" onclick="show_details(' . $artist->artist_permit_id . ')">details</button>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function export_applied_artist_permits()
    {
        $artists = ArtistPermit::with('artist', 'artist.artisttype')->where('permit_status', 'new');

        return Excel::create('Export', function ($excel) use ($artists) {
            $excel->setTitle('Export');
            $excel->sheet('Sheet 1', function ($sheet) use ($artists) {
                $sheet->setOrientation('landscape');
                $sheet->appendRow(['Artist Name', 'Nationality', 'Permit Type', 'Mobile', 'Email', 'Applied On']);
                $artists->chunk(500, function ($fs) use ($sheet) {
                    foreach ($fs as $f) {
                        $row = [];
                        $row[] = $f->artist['name'];
                        $row[] = $f->artist['nationality'];
                        $row[] = $f->artist['artist_type']['artist_type_en'];
                        $row[] = $f->artist['mobile_number'];
                        $row[] = $f->artist['email'];
                        $row[] = $f->artist['created_at'] ? $f->artist['created_at']->format('d-m-Y') : '';
                        $sheet->appendRow($row);
                    }
                });
            });
        })->download('xlsx');
    }

    public function export_existing_artist_permits()
    {
        $artists = ArtistPermit::with('artist')->where('permit_status', '!=', 'new')->orWhereNull('permit_status');

        return Excel::create('Export', function ($excel) use ($artists) {
            $excel->setTitle('Export');
            $excel->sheet('Sheet 1', function ($sheet) use ($artists) {
                $sheet->setOrientation('landscape');
                $sheet->appendRow(['Artist Name', 'Nationality', 'Permit Type', 'Mobile', 'Email', 'Applied On']);
                $artists->chunk(500, function ($fs) use ($sheet) {
                    foreach ($fs as $f) {
                        $row = [];
                        $row[] = $f->artist['name'];
                        $row[] = $f->artist['nationality'];
                        $row[] = $f->artist['artist_type']['artist_type_en'];
                        $row[] = $f->artist['mobile_number'];
                        $row[] = $f->artist['email'];
                        $row[] = $f->artist['created_at'] ? $f->artist['created_at']->format('d-m-Y') : '';
                        $sheet->appendRow($row);
                    }
                });
            });
        })->download('xlsx');
    }

    public function extend_permit()
    {
        $data_bundle['profession'] = Profession::all();

        $data_bundle['countries'] = Countries::all()->pluck('name.common');
        return view('permits.artist.extend', $data_bundle);
    }

    public function fetch_artist_details(Request $request)
    {
        $id = $request->id;
        $artists = ArtistPermit::with('artist', 'artist.artisttype')->where('artist_permit_id', $id)->get();
        return $artists;
    }

    public function show_cancelled(Request $request)
    {
        $id = $request->id;

        $artists = ArtistPermit::where('artist_permit_id', $id)->get();
        return $artists;
    }


    public function cancel_permit(Request $request)
    {
        request()->validate([
            'cancel_reason' => 'required'
        ]);

        $id = $request->input('permit_id');

        ArtistPermit::where('artist_permit_id', $id)->update(['cancel_reason' => $request->input('cancel_reason'), 'permit_status' => 'cancelled']);

        return redirect('company/artist_permits');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_bundle['profession'] = Profession::all();

        $data_bundle['countries'] = Countries::all()->pluck('name.common');

        return view('permits.artist.create', $data_bundle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'permit_type' => 'required',
            'permit_from' => 'required|date',
            'permit_to' => 'required|date',
            'name_en' => 'required',
            'name_ar' => 'nullable',
            'nationality' => 'required',
            'profession' => 'required',
            'passport' => 'required',
            'uid_number' => 'nullable',
            'dob' => 'required|date',
            'telephone' => 'required|numeric',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $artistPermit = ArtistPermit::create([
            'work_location' => $request->input('work_loc'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'permit_status' => 'new',
            'created_by' => Auth::user()->user_id
        ]);

        $artist = Artist::create([
            'name' => $request->input('name_en'),
            'nationality' => $request->input('nationality'),
            'passport_number' => $request->input('passport'),
            'artist_status' => 'active',
            'artist_type_id' => $request->input('permit_type'),
            'uid_number' => $request->input('uid_number'),
            'birthdate' => $request->input('dob'),
            'mobile_number' => $request->input('mobile'),
            'phone_number' => $request->input('telephone'),
            'email' => $request->input('email'),
            'created_by' => Auth::user()->user_id,
            'company_id' => 1,
        ]);

        $artist->profession = $request->input('profession');

        $artist->artist_permit_id = $artistPermit->artist_permit_id;

        $artist->save();


        $count = count($request->input('doc_type'));


        for ($i = 0; $i < $count; $i++) {

            // $doc_type = $request->input('doc_type')[$i];


            // if ($doc_type == "photograph" ||  $doc_type == "medical") {
            //     $request->validate([
            //         'doc_type' => 'required',
            //         'doc_file.*' => 'file|required',
            //     ]);
            // } else {
            //     $request->validate([
            //         'doc_type' => 'required',
            //         'doc_file.*' => 'file|required',
            //         'doc_issue_date.*' => 'required|date',
            //         'doc_exp_date.*' => 'required|date',
            //     ]);
            // }


            $extension = $request->file('doc_file')[$i]->getClientOriginalExtension();

            $artistDocument = ArtistDocument::create([
                'doc_name' => $request->input('doc_type')[$i],
                'issued_date' => $request->input('doc_issue_date')[$i] ?  Carbon::parse($request->input('doc_issue_date')[$i])->toDateTimeString() : null,
                'expired_date' => $request->input('doc_exp_date')[$i] ? Carbon::parse($request->input('doc_exp_date')[$i])->toDateTimeString() : null,
                'company_id' => 1,
                'artist_id' => $artist->artist_id,
                'created_by' =>  Auth::user()->user_id
            ]);

            $path = $request->file('doc_file')[$i]->storeAs(
                $extension,
                $artistDocument->id  . '.' . $extension
            );

            $artistDocument->doc_path = $path;

            $artistDocument->save();
        }

        return redirect('company/artist_permits');
        //return redirect()->back()->with( 'status', 'File uploaded' );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
