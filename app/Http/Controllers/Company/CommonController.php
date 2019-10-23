<?php

namespace App\Http\Controllers\Company;

use Session;
use Auth;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function resetUploadsSession($id)
    {
        Session::forget(Auth::user()->user_id . '_doc_file_' . $id);
        Session::forget(Auth::user()->user_id . '_ext_' . $id);
    }
}
