
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


    // 'useOTL' => 0xFF,
    // 'useKashida' => 75,


    // 'arabic-font' => [
    //     'R'  => 'DroidKufi-Regular.ttf',    // regular font
    //     'B'  => 'DroidKufi-Bold.ttf',          // optional: bold font
    //     'useOTL' => 0xFF,
    //     'useKashida' => 75,
    // ],

    'custom_font_dir' => base_path('/resources/fonts/'), // don't forget the trailing slash!
	'custom_font_data' => [
		'arabic1' => [
			'R'  => 'DroidKufi-Regular.ttf',
            'B'  => 'DroidKufi-Bold.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
		]
	// 	// ...add as many as you want.
	]

];
