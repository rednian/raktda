<?php

namespace App\Http\Controllers\Inspector;

use Illuminate\Http\Request;
use App\Permit;
use App\Roles;
use App\ArtistPermit;
use App\Artist;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inspector.tasks.index', ['page_title' => 'Inspector Tasks']);
    }

    public function artist_permit(Request $request, Permit $permit){

        if(!$request->session()->has('user')){
            $request->session()->put('user', ['time_start'=> Carbon::now()]);
        }

        return view('inspector.tasks.show.artist_permit.show', [
            'page_title'=> 'artist permit details',
            'permit'=>$permit,
            'roles'=>Roles::where('type', 0)->get()
        ]);
    }

    public function artist_permit_checklist(Request $request,Permit $permit,  ArtistPermit $artistpermit)
    {
      $existing_permit = ArtistPermit::whereHas('permit', function($q) use ($permit){
        $q->where('permit_status', '!=', 'pending')
          ->where('permit_id', '!=', $permit->permit_id);
      })->where('artist_id', $artistpermit->artist_id)->get();

        return view('inspector.tasks.show.artist_permit.checklist_artist', [
            'page_title'=>'check artist details',
          'permit'=>$permit,
          'existing_permit'=>$existing_permit,
          'artist_permit'=>$artistpermit
        ]);
    }

    public function artist_permit_individual(Request $request, Artist $artist)
    {
        $artist_permit = ArtistPermit::whereHas('permit', function($q){
            $q->whereNotIn('permit_status', ['draft', 'edit']);
        })
        ->where('artist_id', $artist->artist_id)->latest()->first();

        return view('inspector.tasks.show.artist_permit.show_artist', [
             'page_title' => $artist_permit->fullname.' - details',
             'artist_permit' => $artist_permit
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
