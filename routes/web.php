<?php
Route::get('/', function () { return redirect()->route('login'); })->name('default');

Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	return "Cache is cleared";
});

Auth::routes(['register' => false]);
Route::post('/update_language', 'admin\UserController@updateLanguage')->name('admin.language')->middleware('auth');

Route::middleware(['admin', 'auth'])->group(function(){

    Route::get('/dashboard', function(){
      return redirect()->route('admin.artist_permit.index');
    })->name('admin.dashboard');

    //---------------------------------------------------------------------------------------------------------------
	// Event Permit
	//----------------------------------------------------------------------------------------------------------------
	Route::get('/event','Admin\EventController@index')->name('admin.event.index');
	Route::get('/event/datatable','Admin\EventController@dataTable')->name('admin.event.datatable');
	Route::get('/event/{event}/application','Admin\EventController@application')->name('admin.event.application');
	Route::get('/event/{event}','Admin\EventController@show')->name('admin.event.show');
	Route::get('/event/{event}/lock','Admin\EventController@updateLock')->name('admin.event.lock');
	Route::post('/event/{event}','Admin\EventController@checkapplication')->name('admin.event.checkapplication');

  //---------------------------------------------------------------------------------------------------------------
  // Artist
  //---------------------------------------------------------------------------------------------------------------
	Route::get('/permit/artist', 'Admin\ArtistController@datatable')->name('admin.artist.datatable');
	Route::get('/permit/artist/{artist}', 'Admin\ArtistController@show')->name('admin.artist.show');
	Route::post('/permit/artist/{artist}/updatestatus', 'Admin\ArtistController@updatestatus')->name('admin.artist.update_status');
	Route::get('/permit/artist/{artist}/permithistory', 'Admin\ArtistController@permithistory')->name('admin.artist.permit.history');
	Route::get('/permit/artist/{artist}/status_history', 'Admin\ArtistController@statusHistory')->name('admin.artist.status_history');
//
	Route::get('/permit/artist_permit/{artistpermit}/history', 'Admin\ArtistController@history')->name('admin.artist_permit.history');

  //---------------------------------------------------------------------------------------------------------------
// Artist Permit
//---------------------------------------------------------------------------------------------------------------
	Route::get('/artist_permit/{permit}/history', 'Admin\ArtistPermitController@permitHistory')
		 ->name('admin.artist_permit.history');

	Route::get('/artist_permit/{permit}/application/approver', 'Admin\ArtistPermitController@approverDataTable')
		 ->name('admin.artist_permit.approverDataTable');

	Route::get('/artist_permit/{permit}/application/{artist}/permitHistory', 'Admin\ArtistPermitController@artistPermitHistory')
		 ->name('admin.artist_permit.existing_permit.datatable');

	Route::get('/artist_permit/{permit}/application/{artistpermit}/documentDatatable', 'Admin\ArtistPermitController@artistChecklistDocument')
		 ->name('admin.artist_permit.document');

	Route::get('/arist_permit/{permit}/checkactivepermit/{artist}', 'Admin\ArtistPermitController@checkActivePermit')
		 ->name('admin.artist_permit.checkactivepermit');

	Route::post('/artist_permit/{permit}/application','Admin\ArtistPermitController@submitApplication')
		 ->name('admin.artist_permit.submit');

	Route::post('/artist_permit/{permit}/application/{artistpermit}/checklist', 'Admin\ArtistPermitController@artistChecklist')
		 ->name('admin.artist_permit.checklist');

	Route::get('/artist_permit/{permit}/application/{artistpermit}/comment/datatable','Admin\ArtistPermitController@applicationCommentDataTable')
		 ->name('admin.artist_permit.comment.datatable');

	Route::get('/artist_permit/{permit}/application/datatable', 'Admin\ArtistPermitController@applicationDataTable')
		 ->name('admin.artist_permit.applicationdetails.datatable');

	Route::get('/artist_permit/{permit}/application/{artistpermit}', 'Admin\ArtistPermitController@checkApplication')
		 ->name('admin.artist_permit.checkApplication');

	Route::get('/artist_permit/{permit}/application', 'Admin\ArtistPermitController@applicationDetails')
		 ->name('admin.artist_permit.applicationdetails');

	Route::get('/artist_permit/datatable', 'Admin\ArtistPermitController@datatable')
		 ->name('admin.artist_permit.datatable');
	Route::get('/artist_permit/{permit}', 'Admin\ArtistPermitController@show')
		 ->name('admin.artist_permit.show');
	Route::get('/artist_permit', 'Admin\ArtistPermitController@index')
		 ->name('admin.artist_permit.index');

  //---------------------------------------------------------------------------------------------------------------
  // Settings
  //---------------------------------------------------------------------------------------------------------------

//	Artist permit
	Route::get('/settings', 'Admin\SettingController@index')->name('admin.setting.index');
	Route::get('/settings/profession/datatable', 'Admin\ProfessionController@datatable')->name('admin.setting.profession.datatable');
    //Permit Duration
    Route::resource('/settings/permit_duration', 'PermitDurationController');

  
      //Permit Type
      Route::get('settings/permit_type/{permit_type}/update_status', 'Admin\PermitTypeController@update_status')->name('permit_type.update_status');
      Route::get('settings/permit_type/isexist', 'Admin\PermitTypeController@isexist')->name('permit_type.isexist');
      Route::get('/settings/permit_type/datatable', 'Admin\PermitTypeController@datatable')->name('permit_type.datatable');
      Route::resource('settings/permit_type', 'Admin\PermitTypeController');

      //Approver
      Route::resource('/settings/procedure', 'Admin\ProcedureController');

      //Audit
      Route::get('/settings/audit/datatable', 'Admin\AuditController@index')->name('audit.datatable');

      //Requirement
      Route::get('/settings/requirement/{requirement}/update_status', 'Admin\RequirementController@update_status')->name('requirement.update_status');
      Route::get('/settings/requirement/datatable', 'Admin\RequirementController@datatable')->name('requirement.datatable');
      Route::resource('/settings/requirement', 'Admin\RequirementController');

});
