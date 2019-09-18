@extends('layouts.login')
@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input placeholder="Username" type="text" class="form-control @error('username') is-invalid @enderror" name="login" value="{{ old('login') }}" autocomplete="off" autofocus>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="row kt-login__extra">
        <div class="col kt-align-left">
            <label class="kt-checkbox">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                <span></span>
            </label>
        </div>
        <div class="col kt-align-right">
            {{--@if (Route::has('password.request'))--}}
            {{--<a class="kt-link" href="{{ route('password.request') }}">--}}
                {{--{{ __('Forgot Your Password?') }}--}}
            {{--</a>--}}
            {{--@endif--}}
                <a href="javascript:void(0)" id="kt_login_forgot" class="kt-link">Forget Password ?</a>
        </div>
    </div>
    <div class="kt-login__actions">
        <button id="kt_login_signin_submit" type="submit" class="btn btn-brand btn-block btn-elevate" style="border-radius: 0">Sign In</button>
    </div>
</form>
@endsection
