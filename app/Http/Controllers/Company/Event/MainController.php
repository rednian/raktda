<?php

namespace App\Http\Controllers\Company\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index()
    {
        return view('permits.event.index');
    }


    public function create()
    {
        $data = [];
        return view('permits.event.create', $data);
    }

    public function cancel_permit()
    { }

    public function fetch_applied()
    { }

    public function fetch_existing()
    { }

    public function fetch_drafts()
    { }
}
