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
            'excelTojson',
            'checkoutsession'
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


		// dd($output);

		// return view('admin.settings.checkout');

		// $event = Event::find(25);

		// dd($event->owner->company->users);



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

	public function checkoutsession(){

		$url= 'https://test-rakbankpay.mtf.gateway.mastercard.com/api/rest/version/52/merchant/NRSINFOWAYSL/session';
		$postFields = array(
		    'apiOperation' => 'CREATE_CHECKOUT_SESSION',
		    'order' => array(
		    	'id' => 'ORDER'.time(),
		        'currency' => 'AED',
		    ),
		    'interaction' => array(
		        'operation' => 'PURCHASE',
		    ),
		);

		$username = "merchant.NRSINFOWAYSL";
		$password = "294ddd6f4c0ebe800b899ee346f8a1b8";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json'
		));
		curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postFields));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$output = curl_exec($curl);
		curl_close($curl);

		// $output = json_decode($output);
		return $output;
	}
}
