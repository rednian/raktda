<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>RAKTDA | Registration </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('/assets/css/login/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/login/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/login/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/login/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/login/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/custom/validator/css/bootstrapValidator.min.css') }}" rel="stylesheet"
        id="theme" />
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
        <img class="center-block" style="width: 15%" src="{{ asset('img/small.png') }}">
        <h4 class="text-center" style="margin: 2% 0">Create a company account</h4>
        <section class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (Session::has('error'))
                   <div class="alert alert-danger alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <strong>Opps!</strong> {{Session::get('error')}}
                   </div>
                @endif
            </div>
        </section>
        <section class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="{{ route('company.store') }}" method="post" accept-charset="utf-8">
                    @csrf
                    <section class="panel panel-default">
                        <div class="panel-heading">
                            Establishment Information
                            <h5 class="panel-title"></h5>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                {{-- <label>Establishment Type <span class="text-danger">*</span></label> --}}
                                <input name="company_type_id" type="hidden"
                                    value="{{App\CompanyType::where('name_en', 'corporate')->first()->company_type_id}}">
                                {{-- <select name="company_type_id" class="form-control ki">
                                    <option selected disabled>Select Establishment Type</option>
                                    @if (App\CompanyType::orderBy('name_en')->count() > 0)
                                        @foreach (App\CompanyType::orderBy('name_en')->get() as $type)
                                            <option value="{{$type->company_type_id}}">{{ucfirst($type->name_en)}}
                                </option>
                                @endforeach
                                @endif
                                </select> --}}
                            </div>
                            <div class="form-group">
                                <label>Establishment Name <span class="text-danger">*</span></label>
                                <input value="{{old('name_en')}}" type="text" name="name_en" class="form-control"
                                    required autocomplete="off" autofocus>
                            </div>
                            <div class="form-group corporate">
                                <label>Trade License Number <span class="text-danger">*</span></label>
                                <input value="{{old('trade_license')}}" type="text" name="trade_license"
                                    class="form-control" required autocomplete="off" autofocus>
                            </div>
                            <section class="row corporate">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Trade License Issued Date <span class="text-danger">*</span></label>
                                        <input required value="{{old('trade_license_issued_date')}}" type="date"
                                            name="trade_license_issued_date" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Trade License Expired Date <span class="text-danger">*</span></label>
                                        <input required value="{{old('trade_license_expired_date')}}" type="date"
                                            name="trade_license_expired_date" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input required value="{{old('phone_number')}}" type="text" name="phone_number"
                                            class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input required value="{{old('company_email')}}" type="email"
                                            name="company_email" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <select name="country_id" class="form-control">
                                            @if (App\Country::orderBy('name_en')->count() > 0)
                                            @foreach (App\Country::orderBy('name_en')->get() as $country)
                                            <option {{ $country->country_code == 'AE' ? 'selected': null }}
                                                value="{{$country->country_id}}">{{ucfirst($country->name_en)}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Emirate <span class="text-danger">*</span></label>
                                        <select required name="emirate_id" class="form-control">
                                            @if (App\Emirates::orderBy('name_en')->count() > 0)
                                            @foreach (App\Emirates::orderBy('name_en')->get() as $emirate)
                                            <option {{ $emirate->name_en == 'Ras Al Khaimah' ? 'selected': null }}
                                                value="{{$emirate->id}}">{{ucfirst($emirate->name_en)}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Area <span class="text-danger">*</span></label>
                                        <select required name="area_id" class="form-control">
                                            @if (App\Areas::where('emirates_id', 5)->orderBy('area_en')->count() > 0)
                                            @foreach (App\Areas::where('emirates_id', 5)->orderBy('area_en')->get() as
                                            $area)
                                            <option value="{{$area->id}}">{{ucfirst($area->area_en)}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input required value="{{old('company_email')}}" type="text" name="address"
                                            class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </section>
                        </div>
                    </section>
                    <section class="panel panel-default">
                        <div class="panel-heading">
                            User Information
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input value="{{old('NameEn')}}" type="text" name="NameEn" class="form-control" required
                                    autocomplete="off" autofocus>
                            </div>
                            <section class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input value="{{old('email')}}" type="email" required name="email"
                                            class="form-control" required autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile Number <span class="text-danger">*</span></label>
                                        <input value="{{old('mobile_number')}}" type="text" required
                                            name="mobile_number" class="form-control" required autocomplete="off"
                                            autofocus>
                                    </div>
                                </div>
                            </section>
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input value="{{old('username')}}" type="text" name="username" class="form-control"
                                    required autocomplete="off" autofocus>
                            </div>
                            <section class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" required
                                            autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="confirmPassword" class="form-control" required
                                            autocomplete="off" autofocus>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </section>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdnLwgUAAAAAAIb9L3PQlHQgvSCi16sYgbMIMFR"></div>
                    </div>
                    <div class="form-group">
                        <label>
                            <input name="agree" required type="checkbox" required=""> By clicking Register, you agree to
                            our <a href="#">Terms</a> and that you have read our <a href="#">Data Policy</a>, including
                            our <a href="#">Cookie Use</a>.
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                        Already a member? Click <a href="{{ route('login') }}">here</a> to login.
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/custom/validator/js/bootstrapValidator.min.js') }}" type="text/javascript">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/css/login/backstretch.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('select[name=company_type_id]').change(function(){
                console.log($(this).val());
                if($(this).val() == 1){
                    $('.corporate').addClass('hide').find('input').attr('disabled', true);
                }
                else{
                 $('.corporate').removeClass('hide').find('input').removeAttr('disabled', true);   
                }
            });

         $('.news-feed').backstretch([
            '{{asset('/assets/css/login/1.jpg')}}',
            '{{asset('/assets/css/login/2.jpg')}}',
            '{{asset('/assets/css/login/3.jpg')}}',
            '{{asset('/assets/css/login/4.jpg')}}',
      ], {
            fade: 1000,
            duration: 3000
         });


  $('form').bootstrapValidator({
    message: 'This value is not valid',
    fields: {
      username: {
        message: 'The username is not valid',
        validators: {
          notEmpty: {
            message: 'The username is required and cannot be empty'
          },
          stringLength: {
            min: 5,
            max: 20,
            message: 'The username must be more than 5 and less than 20 characters long'
          },
          regexp: {
            regexp: /^[a-zA-Z][a-zA-Z0-9.]+$/,
            message: 'The username must start with letter and can only consist of alphabetical, number and dot'
          },
          remote: {
            url: '{{ route('company.isexist') }}',
            type: 'get',
            data: {username: $(this).val()},
            message: 'The username is already exist.',
            delay: 1000
          }
        }
      },

      mobile_number:{
        validators:{
           remote: {
             url: '{{ route('company.isexist') }}',
             type: 'get',
             data: {email: $(this).val()},
             message: 'The mobile number is already exist.',
             delay: 1000
           } 
        }
      },

      email:{
        validators:{
           remote: {
             url: '{{ route('company.isexist') }}',
             type: 'get',
             data: {email: $(this).val()},
             message: 'The email is already exist.',
             delay: 1000
           } 
        }
      },
      password: {
        validators: {
          notEmpty: {
            message: 'The password is required and can\'t be empty'
          },
          stringLength: {
            min: 8,
            max: 30,
            message: 'The password must be more than 8 and less than 30 characters long'
          },
          different: {
            field: 'username',
            message: 'The password can\'t be the same as username'
          },
          callback: {
            callback: function (value, validator) {
              // Check the password strength
              // if (value.length < 8) {
              //   return {
              //     valid: false,
              //     message: 'The password must be more than 6 characters'
              //   }
              // }

              if (value === value.toLowerCase()) {
                return {
                  valid: false,
                  message: 'The password must contain at least one upper case character'
                }
              }
              if (value === value.toUpperCase()) {
                return {
                  valid: false,
                  message: 'The password must contain at least one lower case character'
                }
              }
              if (value.search(/[0-9]/) < 0) {
                return {
                  valid: false,
                  message: 'The password must contain at least one number'
                }
              }

              return true;
            }
          }
        }
      },
      confirmPassword: {
        validators: {
          notEmpty: {
            message: 'The confirm password is required and can\'t be empty'
          },
          identical: {
            field: 'password',
            message: 'The password and its confirm are not the same'
          }
        }
      }
    }/*end of fields*/
  }).on('success.form.fv', function (e) {

    // e.preventDefault();
    var $form = $(e.target);
  });

});
    </script>
</body>

</html>