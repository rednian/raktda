
<?php

return [
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => 10,
    // 'default_font' => 'Poppins','sans-serif',
    // 'margin_left' => 10,
    // 'margin_right' => 10,
    // 'margin_top' => 10,
    // 'margin_bottom' => 10,
    // 'margin_header' => 0,
    // 'margin_footer' => 0,
    'orientation' => 'P',
    'title' => 'Laravel mPDF',
    // 'author' => '',
    // 'watermark' => '',
    // 'show_watermark' => false,
    // 'watermark_font' => 'sans-serif',
    'display_mode' => 'fullpage',
    'watermark_text_alpha' => 0.1,
    // 'auto_language_detection' => true,
    // 'temp_dir' => '',
    // 'custom_font_data' => [],
    'custom_font_dir' => base_path('public/fonts/'), // don't forget the trailing slash!
	'custom_font_data' => [
		'DroidKufi' => [
            'R'  => 'DroidKufi-Regular.ttf',    // regular font
            'B'  => 'DroidKufi-Bold.ttf',          
		]
	]


    // 'useOTL' => 0xFF,
    // 'useKashida' => 75,


    // 'droidkufi' => [
    //     'R'  => asset('fonts/DroidKufi-Regular.ttf'),    // regular font
    //     'B'  => asset('fonts/DroidKufi-Bold.ttf'),          // optional: bold font
    //     // 'I'  => 'arabic-font-Light.ttf',    // optional: italic font
    //     // 'BI' => 'arabic-font.ttf',           // optional: bold-italic font
    //     'useOTL' => 0xFF,
    //     'useKashida' => 75,
    // ]



];
