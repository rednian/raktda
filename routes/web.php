<?php
Route::get('/',function(){ return redirect()->route('login'); })->name('default');
Auth::routes();

Route::group(['middleware'=>'admin'], function(){

    Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('/artist', 'admin\ArtistController');
//--------------------------------------------------------------------------
// Settings
//--------------------------------------------------------------------------

    Route::get('/settings', 'admin\SettingController@index')->name('settings.index');

    //artist
    // Route::get('/settings/artist/profession/datatable', '');
    Route::get('settings/artist/profession/isexist', 'Admin\ArtistProfessionController@isexist')->name('profession.isexist');
    Route::resource('settings/artist/profession', 'Admin\ArtistProfessionController');
  
});


