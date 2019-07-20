const mix = require('laravel-mix');

mix.styles([
    'public/assets/vendors/custom/datatables/datatables.bundle.min.css',
    'public/assets/vendors/custom/datatables/datatables.checkboxes.css',
    'public/assets/css/demo1/pages/general/wizard/wizard-3.css',
    'public/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css',
    'public/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css',
    // mandatory them
    'public/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css',
    // global theme
    'public/assets/css/demo1/style.bundle.css',
    'public/assets/css/demo1/skins/header/base/light.css',
    'public/assets/css/demo1/skins/header/menu/light.css',
    'public/assets/css/demo1/skins/brand/dark.css',
    'public/assets/css/demo1/skins/aside/dark.css',
    'public/css/custom.css',
], 'public/css/all.css');

// mix.scripts([
    // 'public/assets/vendors/general/jquery/dist/jquery.js',
    // 'public/assets/vendors/general/popper.js/dist/umd/popper.js',
    // 'public/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js',
    // 'public/assets/vendors/general/js-cookie/src/js.cookie.js',
    // 'public/assets/vendors/general/moment/min/moment.min.js',
    // 'public/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js',
    // 'public/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js',
    // 'public/assets/vendors/general/sticky-js/dist/sticky.min.js',
    // 'public/assets/vendors/general/wnumb/wNumb.js',


    // 'public/assets/js/demo1/scripts.bundle.js',
    // ], 'public/js/all.js');
//     .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
