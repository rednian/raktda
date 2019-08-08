<?php
Route::get('/', function () { return redirect()->route('login'); })->name('default');

Auth::routes(['register' => false]);

Route::middleware(['admin', 'auth'])->group(function(){

  Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');

  //--------------------------------------------------------------------------
  // Artist
  //--------------------------------------------------------------------------

  Route::get('/permit/artist_permit/{artistpermit}/history', 'Admin\ArtistController@history')->name('admin.artist_permit.history');


  //--------------------------------------------------------------------------
// Artist Permit
//--------------------------------------------------------------------------
  



  Route::get('/permit/artist_permit', 'Admin\ArtistPermitController@index')->name('admin.artist_permit.index');
  Route::get('/permit/artist_permit/{permit}/application/{artistpermit}', 'Admin\ArtistPermitController@checkApplication')->name('admin.artist_permit.checkApplication');
  
  Route::post('/permit/artist_permit/{permit}/application/{artistpermit}/checklist', 'Admin\ArtistPermitController@checklist')
        ->name('admin.artist_permit.checkApplication.checklist');

  Route::post('/permit/artist_permit/{permit}/application/{artistpermit}/savedraft', 'Admin\ArtistPermitController@savedraft')
        ->name('admin.artist_permit.checkApplication.savedraft');

  Route::get('/permit/artist_permit/{permit}/application-details', 'Admin\ArtistPermitController@applicationDetails')->name('admin.artist_permit.applicationdetails');
  

  Route::get('/permit/artist_permit/{permit}/application-details/datatable', 'Admin\ArtistPermitController@applicationDataTable')
        ->name('admin.artist_permit.applicationdetails.datatable');

  Route::get('/permit/artist_permit/datatable', 'Admin\ArtistPermitController@datatable')->name('admin.artist_permit.datatable');
  Route::get('/permit/artist_permit/requestDataTable', 'Admin\ArtistPermitController@requestDataTable')->name('admin.artist_permit.requestDataTable');
  Route::get('/permit/artist_permit/artistDataTable', 'Admin\ArtistPermitController@artistDataTable')->name('admin.artist_permit.artistDataTable');


  //--------------------------------------------------------------------------
  // Settings
  //--------------------------------------------------------------------------

  
      //Permit Type
      Route::get('settings/permit_type/{permit_type}/update_status', 'Admin\PermitTypeController@update_status')->name('permit_type.update_status');
      Route::get('settings/permit_type/isexist', 'Admin\PermitTypeController@isexist')->name('permit_type.isexist');
      Route::get('/settings/permit_type/datatable', 'Admin\PermitTypeController@datatable')->name('permit_type.datatable');
      Route::resource('settings/permit_type', 'Admin\PermitTypeController');


      //Audit
      Route::get('/settings/audit/datatable', 'Admin\AuditController@index')->name('audit.datatable');

      //Requirement
      Route::get('/settings/requirement/{requirement}/update_status', 'Admin\RequirementController@update_status')->name('requirement.update_status');
      Route::get('/settings/requirement/datatable', 'Admin\RequirementController@datatable')->name('requirement.datatable');
      Route::resource('/settings/requirement', 'Admin\RequirementController');


});
