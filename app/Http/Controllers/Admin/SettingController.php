<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\GeneralSetting;
use App\Http\Controllers\Controller;

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
}
