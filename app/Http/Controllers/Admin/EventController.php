<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
	public function index()
	{
		return view('admin.event.index', ['page_title'=>'Event']);
	}

	public function application(Request $request)
	{
		return view('admin.event.application', ['page_title'=>'Event Application']);
	}

	public function show()
	{
		return view('admin.event.show', ['page_title'=>'']);
	}
}
