<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        //temp redirect to this url 
       return redirect('company/add_new_artist'); 
    }
}
