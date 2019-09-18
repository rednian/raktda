const mix = require('laravel-mix');


mix.styles([
'public/assets/vendors/custom/datatables/datatables.bundle.rtl.min.css'
], 'public/js/arabic.css');
mix.styles([
    'public/assets/vendors/custom/datatables/datatables.bundle.min.css',
    'public/assets/vendors/custom/datatables/datatables.checkboxes.css',
    'public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css',
    'public/assets/vendors/custom/validator/css/bootstrapValidator.min.css',
    'public/assets/vendors/custom/fancybox/fancybox.css',

    //mandatory
    'public/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css',

    //global optional
    'public/assets/vendors/general/tether/dist/css/tether.css',
    'public/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
    'public/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css',
    'public/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css',
    'public/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css',
    'public/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css',
    'public/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css',
    'public/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
    'public/assets/vendors/general/select2/dist/css/select2.css',
    'public/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css',
    'public/assets/vendors/general/nouislider/distribute/nouislider.css',
    'public/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css',
    'public/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css',
    'public/assets/vendors/general/dropzone/dist/dropzone.css',
    'public/assets/vendors/general/summernote/dist/summernote.css',
    'public/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css',
    'public/assets/vendors/general/animate.css/animate.css',
    'public/assets/vendors/general/toastr/build/toastr.css',
    'public/assets/vendors/general/morris.js/morris.css',
    'public/assets/vendors/general/sweetalert2/dist/sweetalert2.css',
    'public/assets/vendors/general/socicon/css/socicon.css',
    'public/assets/vendors/custom/vendors/flaticon/flaticon.css',

    //global theme
    'public/assets/css/demo1/style.bundle.css',
    'public/assets/css/demo1/skins/header/base/light.css',
    'public/assets/css/demo1/skins/header/menu/light.css',
    'public/assets/css/demo1/skins/brand/dark.css',
    'public/assets/css/demo1/skins/aside/dark.css',
    // 'public/css/custom.css',
    

], 'public/css/.css');





// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'public/assets/vendors/general/jquery/dist/jquery.js',
    'public/assets/vendors/general/popper.js/dist/umd/popper.js',
    'public/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js',
    'public/assets/vendors/general/js-cookie/src/js.cookie.js',
    'public/assets/vendors/general/moment/min/moment.min.js',
    'public/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js',
    'public/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js',
    'public/assets/vendors/general/sticky-js/dist/sticky.min.js',
    'public/assets/vendors/general/wnumb/wNumb.js',
    
    // optiontional
    'public/assets/vendors/general/bootbox/bootbox.min.js',
    'public/assets/vendors/custom/file-icons/index.js',
    'public/assets/vendors/custom/validator/js/bootstrapValidator.min.js',
    'public/assets/vendors/custom/fancybox/fancybox.js',

    'public/assets/vendors/general/jquery-form/dist/jquery.form.min.js',
    'public/assets/vendors/general/block-ui/jquery.blockUI.js',
    'public/assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'public/assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js',
    'public/assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js',
    'public/assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
    'public/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js',
    'public/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
    'public/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js',
    'public/assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js',
    'public/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js',
    'public/assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js',
    'public/assets/vendors/custom/js/vendors/bootstrap-switch.init.js',
    'public/assets/vendors/general/select2/dist/js/select2.full.js',
    'public/assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js',
    'public/assets/vendors/general/typeahead.js/dist/typeahead.bundle.js',
    'public/assets/vendors/general/handlebars/dist/handlebars.js',
    'public/assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js',
    'public/assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js',
    'public/assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js',
    'public/assets/vendors/general/owl.carousel/dist/owl.carousel.js',
    'public/assets/vendors/general/autosize/dist/autosize.js',
    'public/assets/vendors/general/clipboard/dist/clipboard.min.js',
    'public/assets/vendors/general/dropzone/dist/dropzone.js',
    'public/assets/vendors/general/summernote/dist/summernote.js',
    'public/assets/vendors/general/markdown/lib/markdown.js',
    'public/assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js',
    'public/assets/vendors/custom/js/vendors/bootstrap-markdown.init.js',
    'public/assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js',
    'public/assets/vendors/custom/js/vendors/bootstrap-notify.init.js',
    'public/assets/vendors/general/jquery-validation/dist/jquery.validate.js',
    'public/assets/vendors/general/jquery-validation/dist/additional-methods.js',
    'public/assets/vendors/custom/js/vendors/jquery-validation.init.js',
    'public/assets/vendors/general/toastr/build/toastr.min.js',
    'public/assets/vendors/general/raphael/raphael.js',
    'public/assets/vendors/general/morris.js/morris.js',
    'public/assets/vendors/general/chart.js/dist/Chart.bundle.js',
    'public/assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js',
    'public/assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js',
    'public/assets/vendors/general/waypoints/lib/jquery.waypoints.js',
    'public/assets/vendors/general/counterup/jquery.counterup.js',
    'public/assets/vendors/general/es6-promise-polyfill/promise.min.js',
    'public/assets/vendors/general/jquery.repeater/src/lib.js',
    'public/assets/vendors/general/jquery.repeater/src/jquery.input.js',
    'public/assets/vendors/general/jquery.repeater/src/repeater.js',
    'public/assets/vendors/general/dompurify/dist/purify.js',
    

    // global theme
    'public/assets/js/demo1/scripts.bundle.js',
    'public/assets/vendors/custom/datatables/datatables.bundle.js',
    'public/assets/vendors/custom/datatables/datatables.select.min.js',
    'public/assets/vendors/custom/datatables/datatables.checkboxes.min.js',
    'public/js/custom.js',


], 'public/js/all.js').version();