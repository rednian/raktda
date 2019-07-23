<?php
Route::get('/', function () { return redirect()->route('login'); })->name('default');

Auth::routes(['register' => false]);

Route::middleware(['admin', 'auth'])->group(function(){

  Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');


  //--------------------------------------------------------------------------
// Artist Permit
//--------------------------------------------------------------------------
  
  Route::post('/permit/artist/submit_artist', 'Admin\ArtistController@submit_artist')->name('artist.submit_artist');
  Route::get('/permit/artist/datatable', 'Admin\ArtistController@datatable')->name('artist.datatable');
  Route::get('/permit/artist/datatablerequest', 'Admin\ArtistController@datatablerequest')->name('artist.datatablerequest');
  Route::get('/permit/artist/{artist_permit}/artist_documents', 'Admin\ArtistController@artistDocuments')->name('artist.artist_documents');
  Route::get('/permit/artist/{artist_permit}/artist_details', 'Admin\ArtistController@artistDetails')->name('artist.artist_details');
  Route::resource('/permit/artist', 'Admin\ArtistController');


  //--------------------------------------------------------------------------
  // Settings
  //--------------------------------------------------------------------------

      //Approvers
      Route::resource('settings/approvers', 'ProcedureApproverController');

      //Events
      Route::get('settings/event/event_type/datatable', 'Admin\EventTypeController@datatable')->name('event_type.datatable');
      Route::get('settings/event/event_type/isexist', 'Admin\EventTypeController@isexist')->name('event_type.isexist');
      Route::resource('settings/event/event_type', 'Admin\EventTypeController');


      //Artists
      Route::get('/settings/artist/artist_type/datatable', 'Admin\ArtistProfessionController@datatable')->name('artist_type.datatable');
      Route::get('settings/artist/artist_type/isexist', 'Admin\ArtistProfessionController@isexist')->name('artist_type.isexist');
      Route::resource('settings/artist/artist_type', 'Admin\ArtistProfessionController');


      //Audit
      Route::get('/settings/audit/datatable', 'Admin\AuditController@index')->name('audit.datatable');


});
