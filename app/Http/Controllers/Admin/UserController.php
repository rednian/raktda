<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function updateLanguage(Request $request)
    {
        $locale = App::getLocale();

        if ($locale == 'en') {
            App::setLocale('ar');
        } else {
            App::setLocale('en');
        }

        $user = User::find(Auth::user()->user_id)->update(['LanguageId' => $request->lang]);
        if ($user) return response()->json(['success' => true]);
    }
}
