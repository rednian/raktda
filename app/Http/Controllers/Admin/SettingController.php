<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Notifications\AllNotification;
use App\User;
use App\Event;
use Excel;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller
{
	public function __construct(){
		$this->middleware('signed')->except([
            'saveGeneralSettings',
        ]);
	}

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

		return redirect(URL::signedRoute('admin.setting.index') . '#general_settings')->with('message', $result);
	}

	public function excelTojson(Request $request){

		$event = Event::find(25);

		dd($event->owner->company->users);

		// $users = User::whereIn('email', ['dondelrosario93@gmail.com', 'chris@nrsinfoways.com'])->get();

		// foreach ($users as $user) {

		// 	$user->notify(new AllNotification([
		// 		'subject' => 'Artist Permit For Approval',
		// 		'title' => 'Artist Permit For Approval',
		// 		'content' => 'The artist permit with reference number <b>RFN0310</ needs to have an approval from your department. Please click the button below to view details or click this link <a href="' . $. '"></a>.',
		// 		'button' => 'View Permit',
		// 		'url' => '#'
		// 	]));
		// }

		// Excel::load(storage_path() . '/app/public/translations2.xlsx', function($reader){
		//     // Getting all results
		//     $arr = array();
		//     $reader->each(function($sheet) use($arr){

		//     	$key = $sheet['english'];
		//     	$value = $sheet['arabic'];

		//     	if($value != ''){
		//     		echo '"'.$key . '":"' . $value . '",<br>';
		//     	}
		    	
		//     	// dd($sheet['english']);
		// 	    // // // Loop through all rows
		// 	    // // $sheet->each(function($row) {

		// 	    // // 	dd($row->arabic);
		// 	    // // });
		// 	});
		// });
		
	}
}
