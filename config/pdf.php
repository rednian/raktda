
<?php

return [
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => '12',
    'default_font' => 'sans-serif',
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
    // 'custom_font_dir' => '',
    // 'custom_font_data' => [],
    'auto_language_detection' => false,
    'temp_dir' => '',


    'useOTL' => 0xFF,
    'useKashida' => 75,


    // 'arabic-font' => [
    //     'R'  => 'arabic-font.ttf',    // regular font
    //     'B'  => 'arabic-font.ttf',          // optional: bold font
    //     'I'  => 'arabic-font-Light.ttf',    // optional: italic font
    //     'BI' => 'arabic-font.ttf',           // optional: bold-italic font
    //     'useOTL' => 0xFF,
    //     'useKashida' => 75,
    // ],

    'custom_font_dir' => asset('/fonts/droid/'), // don't forget the trailing slash!
	'custom_font_data' => [
		'arabic' => [
			'B'  => 'DroidKufi-Bold.ttf',
			'R'  => 'DroidKufi-Regular.ttf',
		]
		// ...add as many as you want.
	]

];
