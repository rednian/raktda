<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use Excel;

class SettingController extends Controller
{
	public function index()
	{
		$settings = GeneralSetting::first();
		return view('admin.settings.index', ['page_title'=> 'Settings', 'general_settings' => $settings]);
	}

	public function saveGeneralSettings(Request $request){
		try {
			$settings = GeneralSetting::first();
			$settings->update($request->all());

			$result = ['success', 'Settings has been saved successfully', 'Success'];
		} catch (Exception $e) {
			$result = ['error', $e->getMessage(), 'Error'];
		}

		return redirect('settings#general_settings')->with('message', $result);
	}

	public function excelTojson(Request $request){

		
		Excel::load(storage_path() . '/app/public/translations.xlsx', function($reader){
		    // Getting all results
		    $arr = array();
		    $reader->each(function($sheet) use($arr){

		    	$key = $sheet['english'];
		    	$value = $sheet['arabic'];

		    	if($value != ''){
		    		echo '"'.$key . '":"' . $value . '",<br>';
		    	}

		    	
		    	
		    	// dd($sheet['english']);
			    // // // Loop through all rows
			    // // $sheet->each(function($row) {

			    // // 	dd($row->arabic);
			    // // });
			});
		    
			

		});

		
	}
}
