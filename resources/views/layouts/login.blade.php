<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>RAKTDA | Login </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('/assets/css/login/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/login/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/login/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/login/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/login/default.css') }}" rel="stylesheet" id="theme" />
    <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
    <link rel='icon' type='image/png' href="{{ asset('/img/favicon-64x64.png') }}">
    <link rel='icon' type='image/png' href="{{ asset('/img/favicon-32x32.png') }}">
    <style>
        .btn.btn-success {
            background: #80262b;
            border-color: #80262b;
            border-radius: 0;
        }

        .btn.btn-success:hover {
            background: #a63a3f;
            border-color: #a63a3f;
            border-radius: 0;
        }

        .btn.btn-success.active,
        .btn.btn-success:active,
        .btn.btn-success:focus,
        .btn.btn-success:hover,
        .open .dropdown-toggle.btn-success {
            background: #a63a3f;
            border-color: #a63a3f;
        }

        .form-control {
            border-radius: 0;
        }

        .news-feed-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(128, 38, 43, 0.8);
            /*background: rgba(128, 38, 43, .7);*/

        }

        .login.login-with-news-feed .news-caption,
        .register.register-with-news-feed .news-caption {
            background: none;
            top: 150px;

        }
    </style>
</head>

<body class=" bg-white">
    <!-- begin #page-loader -->
    {{--<div id="page-loader" class="fade in"><span class="spinner"></span></div>--}}
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    {{--<img src="{{ asset('assets/css/login/bg-3.jpg') }}" data-id="login-cover-image" alt="" />--}}
                </div>
                <div class="news-feed-overlay"></div>
                <div class="news-caption">
                    <img src="{{ asset('img/login-logo.svg') }}" style="width: 40%;" class="center-block">
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header" style="width:auto;">
                    <div class="brand">
                        <h3 class="caption-title text-center" style="color: #a63a3f"> Ras Al Khaimah <br /> Smart
                            Government Project</h3>
                        {{--<img src="{{ asset('img/logo-en.svg') }}">--}}
                        <h4 style="margin-top: 10%;" class="text-center">Login to your Account</h4>
                    </div>
                    @if (Session::has('success'))
                        <section class="row">
                            <div class="col-sm-12">
                                <div style="margin-bottom: 0px;" class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Success!</strong> {{Session::get('success')}}
                                </div>
                            </div>   
                        </section>
                    @endif
                    <div class="icon">

                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">
                    <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                        @csrf
                        <div class="form-group m-b-15">
                            <input autocomplete="off" autofocus type="text" @error('username') is-invalid @enderror"
                                name="login" value="{{ old('login') }}" class="form-control input-lg"
                                placeholder="Email or username" required />
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group m-b-15">
                            <input name="password" type="password"
                                class="form-control input-lg  @error('password') is-invalid @enderror"
                                placeholder="Password" required />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <section class="row">
                            <div class="col-sm-6">
                                <div class="checkbox m-b-30" style="margin-top: 0">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                @if (Route::has('password.request'))
                                   <div class="text-right" style="color: #707478"><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></div>
                                @endif
                            </div>
                        </section>
                        
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                        Don't have account yet? Click <a href="{{ URL::signedRoute('company.create') }}" class="text-success">here</a> to register.
                        </div>
                        {{--<hr />--}}
                        {{--<p <center></center>lass="text-center">--}}
                        {{--&copy; Color Admin All Right Reserved 2015--}}
                        {{--</p>--}}
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    {{--<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>--}}
    {{--<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>--}}
    {{--<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>--}}
    {{--<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>--}}
    {{--<!--[if lt IE 9]>--}}
    {{--<script src="assets/crossbrowserjs/html5shiv.js"></script>--}}
    {{--<script src="assets/crossbrowserjs/respond.min.js"></script>--}}
    {{--<script src="assets/crossbrowserjs/excanvas.min.js"></script>--}}
    {{--<![endif]-->--}}
    {{--<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>--}}
    {{--<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>--}}
    {{--<!-- ================== END BASE JS ================== -->--}}

    {{--<!-- ================== BEGIN PAGE LEVEL JS ================== -->--}}
    {{--<script src="assets/js/apps.min.js"></script>--}}
    {{--<!-- ================== END PAGE LEVEL JS ================== -->--}}

    <script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/css/login/backstretch.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
			$('.news-feed').backstretch([
				'{{asset('/assets/css/login/1.jpg')}}',
				'{{asset('/assets/css/login/2.jpg')}}',
				'{{asset('/assets/css/login/3.jpg')}}',
				'{{asset('/assets/css/login/4.jpg')}}',
      ], {
				fade: 1000,
				duration: 3000
			});
    });
    </script>
</body>

</html>
