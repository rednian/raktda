<?php

namespace App\Http\Controllers\Admin;

use App\ArtistType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    public function index()
    {
        
        $type = ArtistType::first();

    }
}
