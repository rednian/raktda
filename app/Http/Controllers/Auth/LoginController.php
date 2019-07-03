<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    protected $username;

    public function __construct()
    {
        $this->username = $this->findUsername();
        $this->middleware('guest')->except('logout');
    }

    public function findUsername()
    {
        $fieldType = filter_var(request()->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType=> strtolower(request()->login)]);
        return$fieldType;
    }

    public function username()
    {
        return  $this->username;
    }


}
