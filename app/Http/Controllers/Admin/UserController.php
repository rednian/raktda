<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function updateLanguage(Request $request)
    {
        $user = User::find(Auth::user()->user_id)->update(['LanguageId'=>$request->lang]);
        if($user) return response()->json(['success'=>true]);
    }
}
