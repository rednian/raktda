<?php
Route::get('/', function () { return redirect()->route('login'); })->name('default');

Auth::routes(['register' => false]);

Route::middleware(['admin', 'auth'])->group(function(){

  Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');


  //--------------------------------------------------------------------------
// Artist Permit
//--------------------------------------------------------------------------
  
  // Route::post('/permit/artist/submit_artist', 'Admin\ArtistController@submit_artist')->name('artist.submit_artist');
  // Route::get('/permit/artist/{permit}/application-details', 'Admin\ArtistController@applicationDetails')->name('artist.application.details');
  // Route::get('/permit/artist/datatable', 'Admin\ArtistController@datatable')->name('artist.datatable');
  // Route::get('/permit/artist/datatablerequest', 'Admin\ArtistController@datatablerequest')->name('artist.datatablerequest');
  // Route::get('/permit/artist/{artist_permit}/artist_documents', 'Admin\ArtistController@artistDocuments')->name('artist.artist_documents');
  // Route::get('/permit/artist/{artist_permit}/artist_details', 'Admin\ArtistController@artistDetails')->name('artist.artist_details');

  Route::get('/permit/artist_permit', 'Admin\ArtistPermitController@index')->name('admin.artist_permit.index');
  Route::get('/permit/artist_permit/datatable', 'Admin\ArtistPermitController@datatable')->name('admin.artist_permit.datatable');
  Route::resource('/permit/artist', 'Admin\ArtistController');


  //--------------------------------------------------------------------------
  // Settings
  //--------------------------------------------------------------------------

      //Approvers
      // Route::resource('settings/approvers', 'ProcedureApproverController');


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
