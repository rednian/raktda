<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Profession;
use PragmaRX\Countries\Package\Countries;
use Carbon\Carbon;
use App\Artist;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;
use Auth;
use Excel;
use Yajra\Datatables\Datatables;
use App\Requirement;
use App\Company;

class ArtistController extends Controller
{


    public function index()
    {

        return view('permits.artist.index');
    }


    // Artist Permit Dashboard Table One

    public function applied_list()
    {

        $permits = Permit::latest();
        $permits = $permits->with('artist', 'artistPermit')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', '!=', 'expired')->get();
        //->has('artistPermitDocument')


        return Datatables::of($permits)->editColumn('created_at', function ($permit) {
            if ($permit->created_at) {
                return $permit->created_at->format('d-m-Y');
            } else {
                return '';
            }
        })->editColumn('issued_date', function ($permits) {
            if ($permits->issued_date) {
                return Carbon::parse($permits->issued_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->editColumn('expired_date', function ($permits) {
            if ($permits->expired_date) {
                return Carbon::parse($permits->expired_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($permit) {
            if ($permit->permit_status == 'approved') {
                return '<a href="' . route('make_payment', $permit->permit_id) . '" class="btn btn-sm btn-success">Payment</a>';
            } else if ($permit->permit_status == 'pending') {
                return '<button onClick="cancel_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancel_permit" class="btn btn-sm btn-dark">Cancel</a>';
            } else if ($permit->permit_status == 'rejected') {
                return '<button onClick="rejected_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#rejected_permit" class="btn btn-sm btn-warning">Rejected</a>';
            } else if ($permit->permit_status == 'cancelled') {
                return '<button onClick="show_cancelled(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="btn btn-sm btn-danger">Cancelled</a>';
            }
        })->addColumn('details', function ($permit) {
            return '<button type="button" target="_blank" class="btn btn-link btn-sm" data-toggle="modal" data-target="#artist_details" onclick="show_details(' . $permit->permit_id . ')" >details</button>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    // Artist Permit Dashboard Table Two

    public function existing_list()
    {
        $permits = Permit::latest();
        $permits = $permits->with('artist', 'artistPermit')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', 'expired')->get();


        return Datatables::of($permits)->editColumn('created_at', function ($permits) {
            if ($permits->created_at) {
                return $permits->created_at->format('d-m-Y');
            } else {
                return 'none';
            }
        })->editColumn('issued_date', function ($permits) {
            if ($permits->issued_date) {
                return Carbon::parse($permits->issued_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->editColumn('expired_date', function ($permits) {
            if ($permits->expired_date) {
                return Carbon::parse($permits->expired_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($permit) {
            return '<a href="' . route('extend_permit', $permit->permit_id) . '"  class="btn btn-sm btn-default">Extend</a>';
        })->addColumn('details', function ($permit) {
            return '<button type="button" target="_blank" class="btn btn-link btn-sm" data-toggle="modal" data-target="#artist_details" onclick="show_details(' . $permit->permit_id . ')">details</button>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    // Function for Excel Export

    public function export_applied_artist_permits()
    {

        $permits = Permit::latest();
        $permits->with('artist', 'artistPermit')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', '!=', 'expired')->get();

        return Excel::create('Export', function ($excel) use ($permits) {
            $excel->setTitle('Export');
            $excel->sheet('Sheet 1', function ($sheet) use ($permits) {
                $sheet->setOrientation('landscape');
                $sheet->appendRow(['Permit No.', 'From Date', 'To Date', 'Work Location', 'Applied On']);
                $permits->chunk(500, function ($fs) use ($sheet) {
                    foreach ($fs as $f) {
                        $row = [];
                        $row[] = $f->permit_number;
                        $row[] = $f->issued_date ? Carbon::parse($f->issued_date)->format('d-m-Y') : '';
                        $row[] = $f->expired_date ? Carbon::parse($f->expired_date)->format('d-m-Y') : '';
                        $row[] = $f->work_location;
                        $row[] = $f->created_at ? $f->created_at->format('d-m-Y') : '';
                        $sheet->appendRow($row);
                    }
                });
            });
        })->download('xlsx');
    }

    public function export_existing_artist_permits()
    {
        $permits = Permit::latest();
        $permits->with('artist', 'artistPermit')->where('company_id', Auth::user()->EmpClientId)->where('permit_status',  'expired')->get();

        return Excel::create('Export', function ($excel) use ($permits) {
            $excel->setTitle('Export');
            $excel->sheet('Sheet 1', function ($sheet) use ($permits) {
                $sheet->setOrientation('landscape');
                $sheet->appendRow(['Permit No.', 'From Date', 'To Date', 'Work Location', 'Applied On']);
                $permits->chunk(500, function ($fs) use ($sheet) {
                    foreach ($fs as $f) {
                        $row = [];
                        $row[] = $f->permit_number;
                        $row[] = $f->issued_date ? Carbon::parse($f->issued_date)->format('d-m-Y') : '';
                        $row[] = $f->expired_date ? Carbon::parse($f->expired_date)->format('d-m-Y') : '';
                        $row[] = $f->work_location;
                        $row[] = $f->created_at ? $f->created_at->format('d-m-Y') : '';
                        $sheet->appendRow($row);
                    }
                });
            });
        })->download('xlsx');
    }

    // Extend Permit Link

    public function extend_permit()
    {
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        return view('permits.artist.extend', $data_bundle);
    }

    // To Fetch Artist Details

    public function fetch_artist_details(Request $request)
    {
        $id = $request->permit_id;
        $artists = ArtistPermit::with('artist',  'permit')->where('permit_id', $id)->get();
        return $artists;
    }

    // Show Cancelled Reason

    public function show_cancelled(Request $request)
    {
        $id = $request->id;
        $artists = ArtistPermit::where('artist_permit_id', $id)->get();
        return $artists;
    }

    // To Cancel Permit Popup Submit

    public function cancel_permit(Request $request)
    {
        request()->validate([
            'cancel_reason' => 'required'
        ]);
        $id = $request->input('permit_id');
        ArtistPermit::where('artist_permit_id', $id)->update(['cancel_reason' => $request->input('cancel_reason'), 'permit_status' => 'cancelled']);
        return redirect('company/artist_permits');
    }

    // To Apply New Permit Page

    public function create()
    {
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();

        return view('permits.artist.create', $data_bundle);
    }


    public function uploadDocuments(Request $request)
    {
        $name = str_replace(" ", "_", $request->reqName);
        $number = $request->artistNo;
        $path  = Storage::putFileAs('files/' . $number, $request->files->get('doc_file_' . $request->id), $name);
        session([$number . '_doc_file_' . $request->id => $path]);
    }

    public function deleteDocuments(Request $request)
    {
        $req = str_replace(" ", "_", $request->reqName);
        // dd('files/' . $request->artistNo . '/' . $req);
        $status = Storage::delete('files/' . $request->artistNo . '/' . $req);
        return $status;
    }

    public function store(Request $request)
    {
        $permitDetails = json_decode($request->permitD, true);
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);

        // dd($request->documentD, gettype(json_decode($request->documentD)), json_decode($request->documentD));
        $last_permit_no = Permit::latest()->first();

        $permit = Permit::create([
            'work_location' => $permitDetails['workLocation'],
            'issued_date' => $permitDetails['fromDate'] ? Carbon::parse($permitDetails['fromDate'])->toDateTimeString() : '',
            'expired_date' => $permitDetails['toDate'] ? Carbon::parse($permitDetails['toDate'])->toDateTimeString() : '',
            'permit_number' => $last_permit_no->permit_id + 1,
            'created_at' => Carbon::now()->toDateTimeString(),
            'permit_status' => 'pending',
            'created_by' => Auth::user()->user_id,
            'company_id' => Auth::user()->EmpClientId
        ]);

        for ($i = 1; $i <= count($artistDetails); $i++) {

            $artist = Artist::create([
                'name' => $artistDetails[$i]['nameEn'],
                'nationality' => $artistDetails[$i]['nationality'],
                'passport_number' => $artistDetails[$i]['passport'],
                'artist_status' => 'active',
                'uid_number' => $artistDetails[$i]['uidNumber'],
                'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($permitDetails['fromDate'])->toDateString() : '',
                'mobile_number' => $artistDetails[$i]['mobile'],
                'phone_number' => $artistDetails[$i]['telephone'],
                'email' => $artistDetails[$i]['email'],
                'created_by' => Auth::user()->user_id,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            $artistPermit = ArtistPermit::create([
                'artist_permit_status' => 'active',
                'artist_id' => $artist->artist_id,
                'permit_id' => $permit->permit_id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'profession' => $artistDetails[$i]['profession']
            ]);

            $requirements = Requirement::where('requirement_type', 'artist')->get();
            $requirement_names = [];
            foreach ($requirements as $req) {
                array_push($requirement_names, $req->requirement_name);
            }
            $total = $requirements->count();

            $company_array = Company::find(Auth::user()->EmpClientId);
            $company_name = str_replace(' ', '_', $company_array->company_name);

            for ($j = 1; $j <= $total; $j++) {
                $newPath = $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $j;
                if (session($i . '_doc_file_' . $j)) {
                    Storage::move(session($i . '_doc_file_' . $j), $newPath);
                }
                ArtistPermitDocument::create([
                    'issued_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'artist_permit_id' => $artistPermit->artist_permit_id,
                    'path' =>  $newPath,
                    'document_name' => $requirement_names[$j - 1],
                    'status' => 'active'
                ]);
            }
        }

        if ($permit) {
            $result = ['success', 'Artist Permit Applied Successfully', 'Success'];
        } else {
            $result = ['error', 'Error while applying. Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);

        // return redirect()->back()->with('message', $result);
    }

    public function clear_the_temp()
    {
        // Storage::delete('files');
        Storage::deleteDirectory('files');
    }

    // Make Payment Function

    public function makepayment($id)
    {
        $data_bundle['profession'] = Profession::all();
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        $data_bundle['artist_details'] = ArtistPermit::with('artist',  'artist.artistdocument')->where('artist_permit_id', $id)->get();
        return view('permits.artist.payment', $data_bundle);
    }

    // Payment Gateway


    public function payment_gateway(Request $request)
    {
        return view('permits.artist.paymentgateway');
    }


    public function happiness_meter($id)
    {
        return view('permits.happinessmeter', ['id' => $id]);
    }


    public function submit_happiness(Request $request)
    {
        $id = $request->permit_id;
        $rating = $request->rating;

        // $device = Device::findOrFail($id);

        $artists = ArtistPermit::findOrFail($id);

        $artists->update([
            'meter' => $rating
        ]);

        return view('permits.happinessmeter', ['id' => $id]);
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
