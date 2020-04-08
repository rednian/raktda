<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>RAKTDA | Establishment Registration </title>
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
  <link rel="stylesheet" href="{{asset('css/jquery.ccpicker.css')}}">
  <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
  <link href="{{ asset('assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
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

    .mk-fcf div:first-child {
      display: flex;
    }

    .cc-picker-code-filter {
      z-index: 10 !important;
    }

    .logo-img {
      width: 12%;
      margin-top:30px;
    }


    @media all and (max-width:820px) {
      .logo-img {
        width: 25%;
      }
    }

  </style>
</head>

<body class=" bg-white">
  <!-- begin #page-loader -->
  {{--<div id="page-loader" class="fade in"><span class="spinner"></span></div>--}}
  <!-- end #page-loader -->

  <!-- begin #page-container -->
  <div id="page-container">
    <img class="center-block logo-img" src="{{ asset('img/small.png') }}" />
    <h4 class="text-center" style="margin:25px;">New Registration</h4>
    
    <section class="">
      <div class="col-md-6 col-md-offset-3">
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <strong>Opps!</strong> {{session('error')}}
        </div>
        @endif
      </div>
    </section>


    <section class="">
      <div class="col-md-6 col-md-offset-3">
        @if (Session::has('error'))
        <section class="alert alert-danger">
          {{Session::get('message')[1]}}
        </section>
        @endif

        <form action="{{ route('company.store') }}" method="post" accept-charset="utf-8">
          @csrf
          <section class="panel panel-default" style="margin-bottom:0;">
            <div class="panel-heading"  style="background:rgba(204,204,204,0.4);padding:15px;">
              <h5 class="panel-title"><strong>Establishment Information</strong></h5>
            </div>
            <div class="panel-body">
              <div class="form-group @if( $errors->has('name_en') ) has-error @endif">
                <label>Establishment Name <span class="text-danger">*</span></label>
                <input required value="{{old('name_en')}}" type="text" name="name_en"
                  class="form-control @error('name_en') is-invalid @enderror" autocomplete="off" autofocus>
                @if ($errors->has('name_en'))
                <div class="help-block"> {{$errors->first('name_en')}}</div>
                @endif

              </div>


              <section class="row corporate">
                <div class="col-sm-6">
                  <div class="form-group @if( $errors->has('trade_license') ) has-error @endif">
                    <label>Business License Number <span class="text-danger">*</span></label>
                    <input required value="{{old('trade_license')}}" type="text" name="trade_license"
                      class="form-control @error('trade_license') is-invalid @enderror" autocomplete="off">
                    @if ($errors->has('trade_license'))
                    <div class="help-block"> {{$errors->first('trade_license')}}</div>
                    @endif

                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group @if( $errors->has('trade_license_expired_date') ) has-error @endif">
                    <label>Business License Expiry Date <span class="text-danger">*</span></label>
                    <input min="{{date('Y-m-d')}}" required value="{{old('trade_license_expired_date')}}" type="date"
                      name="trade_license_expired_date"
                      class="form-control @error('trade_license_expired_date') is-invalid @enderror" autocomplete="off">
                    @if ($errors->has('trade_license_expired_date'))
                    <div class="help-block"> {{$errors->first('trade_license_expired_date')}}</div>
                    @endif
                  </div>
                </div>
              </section>
              {{-- <section class="row">
                                <div class="col-sm-6">
                                    <div class="form-group @if( $errors->has('phone_number') ) has-error @endif">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input required value="{{old('phone_number')}}" type="text" name="phone_number"
              class="form-control @error('phone_number') is-invalid @enderror" autocomplete="off">
              @if ($errors->has('phone_number'))
              <div class="help-block"> {{$errors->first('phone_number')}}</div>
              @endif
            </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group @if( $errors->has('company_email') ) has-error @endif">
          <label>Email <span class="text-danger">*</span></label>
          <input required value="{{old('company_email')}}" type="email" name="company_email"
            class="form-control @error('company_email') is-invalid @enderror" autocomplete="off">
          @if ($errors->has('company_email'))
          <div class="help-block"> {{$errors->first('company_email')}}</div>
          @endif
        </div>
      </div>
    </section> --}}

    {{-- <section class="row">
                                <div class="col-sm-12">
                                    <div class="form-group @if( $errors->has('company_description_en') ) has-error @endif">
                                        <label>{{__('Establishment Activity')}} <span
      class="text-danger">*</span></label>
    <textarea required name="company_description_en" rows="3" autocomplete="off"
      class="form-control @error('company_description_en') is-invalid @enderror">{{old('company_description_en')}}</textarea>
    @if ($errors->has('company_description_en'))
    <div class="help-block"> {{$errors->first('company_description_en')}}</div>
    @endif
  </div>
  </div>
  </section> --}}

  <section class="row">
    <div class="col-sm-6">
      <div class="form-group @if( $errors->has('area_id') ) has-error @endif">
        <label>Area <span class="text-danger">*</span></label>
        <select required name="area_id" class="form-control @error('area_id') is-invalid @enderror">
          {{-- <option >{{__('Select Area in Ras Al Khaimah')}}</option> --}}
          <option></option>
          @if (App\Areas::where('emirates_id', 5)->orderBy('area_en')->count() > 0)
          @foreach (App\Areas::where('emirates_id', 5)->orderBy('area_en')->get() as $area)
          <option value="{{ $area->id }}">{{ucfirst($area->area_en)}}</option>
          @endforeach
          @endif
        </select>
        @if ($errors->has('area_id'))
        <div class="help-block"> {{$errors->first('area_id')}}</div>
        @endif
      </div>
    </div>
  </section>
  <section class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>{{__('Address in Ras Al Khaimah')}} <span class="text-danger">*</span></label>
        <textarea required name="address" rows="2" dir="ltr" autocomplete="off"
          class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
        @if ($errors->has('address'))
        <div class="help-block"> {{$errors->first('address')}}</div>
        @endif
      </div>
    </div>
  </section>

  </div>
  </section>
  <section class="panel panel-default" style="margin-bottom: 0">
    <div class="panel-heading" style="background:rgba(204,204,204,0.4);padding:15px;">
     <h5 class="panel-title"><strong> User Information</strong></h5>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label>Full Name <span class="text-danger">*</span></label>
        <input value="{{old('NameEn')}}" type="text" name="NameEn" class="form-control" required autocomplete="off"
          autofocus>
      </div>
      <section class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Email Address<span class="text-danger">*</span></label>
            <input value="{{old('email')}}" type="email" required name="email" class="form-control" required
              autocomplete="off" autofocus>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Mobile Number <span class="text-danger">*</span></label>
            <div class="input-group input-group-sm mk-fcf" style="display: flex;align-items: center">
              <input value="{{old('mobile_number')}}" type="text" required name="mobile_number" id="mobile_number"
                class="form-control form-control-sm" pattern="[0-9]+" style="height:auto !important;border-radius:0;"
                required autocomplete="off" min="0" autofocus placeholder="e.g. 561234567">
            </div>
          </div>
        </div>
      </section>


      <div class="form-group">
        <label>Username <span class="text-danger">*</span></label>
        <input value="{{old('username')}}" type="text" name="username" class="form-control" required autocomplete="off"
          autofocus>
      </div>
      <section class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" required autocomplete="off" autofocus>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="confirmPassword" class="form-control" required autocomplete="off" autofocus>
          </div>
        </div>
      </section>
    </div>
  </section>
    <div class="panel-body" style="padding-top:0px;">
      {{-- <div class="form-group">
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
      </span>
      @endif
    </div> --}}
    <div class="form-group">
      <label style="display: flex; align-items: center;">
        <input name="term_condition" required type="checkbox" style="margin-right:10px;"> I agree to &nbsp;<a href="{{route('company.tandc')}}">terms and conditions</a>
        {{-- By clicking Register, you agree to
        our <a href="javacript:void(0)">Terms</a> and that you have read our <a href="javacript:void(0)">Data
          Policy</a>, including
        our <a href="javacript:void(0)">Cookie Use</a>. --}}
      </label>
    </div>
    <div class="form-group">
      <div class="login-buttons">
        <button type="submit" class="btn btn-success btn-block">Register</button>
      </div>
    </div>
  <div class="m-t-10 m-b-20 text-center text-inverse">
      Already Registered ? Click <a class="text-success" href="{{ route('login') }}">here</a> to Login.
    </div>
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
  <script src="{{ asset('/assets/vendors/custom/loading_overlay/loadingoverlay.min.js') }}"></script>
  <script src="{{ asset('assets/css/login/backstretch.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>

  <script src="{{asset('js/jquery.ccpicker.js')}}"></script>
  {!! NoCaptcha::renderJs() !!}
  <script>
    $(document).ready(function(){

        $('select[name=company_type_id]').change(function(){
          if($(this).val() == 1){
            $('.corporate').addClass('hide').find('input').attr('disabled', true);
          }
          else{
            $('.corporate').removeClass('hide').find('input').removeAttr('disabled', true);
          }
        });

        // $('#mobile_number').select2({
        //   placeholder: 'search'
        // });

        $('#mobile_number').CcPicker({
          "countryCode":"ae"
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
            stringLength: {
            min: 6,
            max: 10,
            message: 'The mobile number must be more than 6 characters and less than 10 character long'
          },
           remote: {
             url: '{{ route('company.isexist') }}',
             type: 'get',
             data: {mobile_number: $(this).val(), phoneCode: $('#mobile_number_phoneCode').val()},
             message: 'The mobile number is already exist.',
             delay: 1000
           },
           regexp: {
                regexp: '/^((?!(0))[0-9]{9})$/',
                message:' The mobile number can only accept number.'
            }
        }
      },

      name_en:{
        validators:{
           remote: {
             url: '{{ route('company.isexist') }}',
             type: 'get',
             data: {name_en: $(this).val()},
             message: 'The establishment already exist.',
             delay: 1000
           }
        }
      },

      name_ar:{
        validators:{
           remote: {
             url: '{{ route('company.isexist') }}',
             type: 'get',
             data: {name_ar: $(this).val()},
             message: 'The establishment already exist.',
             delay: 1000
           }
        }
      },

      trade_license:{
        validators:{
           remote: {
             url: '{{ route('company.isexist') }}',
             type: 'get',
             data: {trade_license: $(this).val()},
             message: 'The business license number is already exist.',
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
      trade_license_issued_date:{
        validators:{
            date:{
                 format: 'MM/DD/YYYY',
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


    if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
      //data.fv.disableSubmitButtons(true);
    //  $.LoadingOverlay("hide", true);
    }
  });



});
  </script>
</body>

</html>