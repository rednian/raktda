<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $data['breadcrumb'] ='admin.dashboard';
        $data['page_title'] ='Dashboard';
        return view('home', $data);
    }

}
