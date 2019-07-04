<?php

namespace App\Http\Controllers;

use App\User;
use App\Roles;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {  
        return view('home');
    }
}
