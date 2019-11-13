<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Approval;
use App\Permit;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{

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
}
