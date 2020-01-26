
<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="../../../../">
		<meta charset="utf-8" />
		<title>Metronic | Login Page 1</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>
		<link href="./assets/css/demo1/pages/login/login-1.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="./assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
		<link href="./assets/css/demo1/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="./assets/css/demo1/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="./assets/css/demo1/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="./assets/css/demo1/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="./assets/css/demo1/skins/aside/dark.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
        <style>
            .kt-login.kt-login--v1 .kt-login__wrapper .kt-login__body {
                display: block;
            }
            .news-feed-overlay {
                {{--  position: absolute;  --}}
                {{--  width: 100%;  --}}
                {{--  height: 100%;  --}}
                background: rgba(128, 38, 43, 0.8);
                /*background: rgba(128, 38, 43, .7);*/

            }

        </style>
	</head>
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
					<div id="news-feed" class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(./assets/media//bg/bg-4.jpg);">
                        <div class="news-feed-overlay"></div>
                        <div class="kt-grid__item">
							<a href="#" class="kt-login__logo">
								<img src="./assets/media/logos/logo-4.png">
							</a>
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
							<div class="kt-grid__item kt-grid__item--middle">
                            <img src="{{asset('img/login-logo.svg')}}">
							</div>
						</div>
						<div class="kt-grid__item">
							<div class="kt-login__info">
								<div class="kt-login__copyright">
									&copy 2018 Metronic
								</div>
								<div class="kt-login__menu">
									<a href="#" class="kt-link">Privacy</a>
									<a href="#" class="kt-link">Legal</a>
									<a href="#" class="kt-link">Contact</a>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
						<div class="kt-login__head">
                            <section class="row">
                                <div class="col-md-12">
                                    <div class="kt-login__title text-center">
                                        <h5>Create Company Account</h5>
                                        <span class="kt-login__signup-label text-center">Already have account? </span>&nbsp;&nbsp;
                                        <a href="{{ route('login') }}" class="kt-link kt-login__signup-link">Login</a>
                                    </div>

                                </div>
                            </section>
						</div>
						<div class="kt-login__body">
                            <form action="kt-form">
                                <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-20" id="accordionExample6">
                                    <div class="card">
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title kt-font-dark kt-padding-t-5 kt-padding-b-10" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                                <i class="flaticon-pie-chart-1"></i> Establishment Information
                                            </div>
                                        </div>
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                                            <div class="card-body">

                                                <section class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-sm @if( $errors->has('name_en') ) has-error @endif">
                                                            <label>Establishment Name <span class="text-danger">*</span></label>
                                                            <input required value="{{old('name_en')}}" type="text" name="name_en" class="form-control form-control-sm @error('name_en') is-invalid @enderror"
                                                                 autocomplete="off" autofocus>
                                                                 @if ($errors->has('name_en'))
                                                                  <div class="help-block"> {{$errors->first('name_en')}}</div>
                                                                 @endif
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="row corporate">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm @if( $errors->has('trade_license') ) has-error @endif">
                                                            <label>Trade License Number <span class="text-danger">*</span></label>
                                                            <input required value="{{old('trade_license')}}" type="text"
                                                                name="trade_license" class="form-control form-control-sm @error('trade_license') is-invalid @enderror" autocomplete="off">
                                                            @if ($errors->has('trade_license'))
                                                              <div class="help-block"> {{$errors->first('trade_license')}}</div>
                                                             @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm @if( $errors->has('trade_license_expired_date') ) has-error @endif">
                                                            <label>Trade License Expired Date <span class="text-danger">*</span></label>
                                                            <input min="{{date('Y-m-d')}}" required value="{{old('trade_license_expired_date')}}" type="date"
                                                                name="trade_license_expired_date" class="form-control form-control-sm @error('trade_license_expired_date') is-invalid @enderror" autocomplete="off">
                                                            @if ($errors->has('trade_license_expired_date'))
                                                              <div class="help-block"> {{$errors->first('trade_license_expired_date')}}</div>
                                                             @endif
                                                        </div>
                                                    </div>
                                                </section>

                                                <section class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm @if( $errors->has('area_id') ) has-error @endif">
                                                            <label>Area <span class="text-danger">*</span></label>
                                                            <select required name="area_id" class="form-control select2 form-control-sm @error('area_id') is-invalid @enderror">
                                                                {{-- <option >{{__('Select Area in Ras Al Khaimah')}}</option> --}}
                                                                <option ></option>
                                                                @if (App\Areas::where('emirates_id', 5)->orderBy('area_en')->count() > 0)
                                                                @foreach (App\Areas::where('emirates_id', 5)->orderBy('area_en')->get() as $area)
                                                                <option value="{{ $area->id }}" >{{ucfirst($area->area_en)}}</option>
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
                                                        <div class="form-group form-group-sm">
                                                            <label>{{__('Address in Ras Al Khaimah')}} <span class="text-danger">*</span></label>
                                                            <textarea required name="address" rows="2" autocomplete="off" class="form-control form-control-sm @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                                                              @if ($errors->has('address'))
                                                              <div class="help-block"> {{$errors->first('address')}}</div>
                                                             @endif
                                                        </div>
                                                    </div>
                                                </section>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-20" id="accordion-user">
                                    <div class="card">
                                        <div class="card-header" id="heading-user">
                                            <div class="card-title kt-font-dark kt-padding-t-5 kt-padding-b-10" data-toggle="collapse" data-target="#collapse-user" aria-expanded="true" aria-controls="collapse-user">
                                                <i class="flaticon-pie-chart-1"></i> User Information
                                            </div>
                                        </div>
                                        <div id="collapse-user" class="collapse show" aria-labelledby="heading-user" data-parent="#accordion-user">
                                            <div class="card-body">
                                                <div class="form-group form-group-sm">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input value="{{old('NameEn')}}" type="text" name="NameEn" class="form-control form-control-sm" required
                                                        autocomplete="off" autofocus>
                                                </div>
                                                <section class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>Email <span class="text-danger">*</span></label>
                                                            <input value="{{old('email')}}" type="email" required name="email"
                                                                class="form-control form-control-sm" required autocomplete="off" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>Mobile Number <span class="text-danger">*</span></label>
                                                            <input value="{{old('mobile_number')}}" type="text" required
                                                                name="mobile_number" class="form-control form-control-sm" required autocomplete="off"
                                                                autofocus>
                                                        </div>
                                                    </div>
                                                </section>
                                                <div class="form-group form-group-sm">
                                                    <label>Username <span class="text-danger">*</span></label>
                                                    <input value="{{old('username')}}" type="text" name="username" class="form-control form-control-sm"
                                                        required autocomplete="off" autofocus>
                                                </div>
                                                <section class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>Password <span class="text-danger">*</span></label>
                                                            <input type="password" name="password" class="form-control form-control-sm" required
                                                                autocomplete="off" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-sm">
                                                            <label>Confirm Password <span class="text-danger">*</span></label>
                                                            <input type="password" name="confirmPassword" class="form-control form-control-sm" required
                                                                autocomplete="off" autofocus>
                                                        </div>
                                                    </div>
                                            </div
                                        </div>
                                    </div>
                                </div>

                            </form>


						</div>

					</div>

				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin:: Global Mandatory Vendors -->
		<script src="./assets/vendors/general/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/moment/min/moment.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/wnumb/wNumb.js" type="text/javascript"></script>

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<script src="./assets/vendors/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/bootstrap-switch.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/autosize/dist/autosize.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/markdown/lib/markdown.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/bootstrap-markdown.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/bootstrap-notify.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/jquery-validation.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/raphael/raphael.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/morris.js/morris.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/counterup/jquery.counterup.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
		<script src="./assets/vendors/custom/js/vendors/sweetalert2.init.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
		<script src="./assets/vendors/general/dompurify/dist/purify.js" type="text/javascript"></script>

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="./assets/js/demo1/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
        <script src="./assets/js/demo1/pages/login/login-1.js" type="text/javascript"></script>
        <script src="{{ asset('assets/css/login/backstretch.min.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                $('.select2').select2({
                    autoWidth:true,
                    placeholder: 'Select Area in Ras Al Khaimah',
                    allowClear: true
                });

                $('#news-feed').backstretch([
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

	<!-- end::Body -->
</html>
