<?php
Route::get('/',function(){ return redirect()->route('login'); })->name('default');
Auth::routes(['register'=>false]);

Route::group(['middleware'=>'admin'], function(){

    Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');
  
    
//--------------------------------------------------------------------------
// Settings
//--------------------------------------------------------------------------

    //event 
    Route::get('settings/event/event_type/datatable', 'Admin\EventTypeController@datatable')->name('event_type.datatable');
    Route::get('settings/event/event_type/isexist', 'Admin\EventTypeController@isexist')->name('event_type.isexist');
    Route::resource('settings/event/event_type', 'Admin\EventTypeController');

    //artist
    Route::get('/settings/artist/profession/datatable', 'Admin\ArtistProfessionController@datatable')->name('profession.datatable');
    Route::get('settings/artist/profession/isexist', 'Admin\ArtistProfessionController@isexist')->name('profession.isexist');
    Route::resource('settings/artist/profession', 'Admin\ArtistProfessionController');

  
});


