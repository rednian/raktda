<?php
Route::get('/', function () {
    return redirect()->route('login');
})->name('default');
Auth::routes(['register' => false]);

Route::group(['middleware' => 'admin'], function () {

    Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('/artist', 'admin\ArtistController');

    //--------------------------------------------------------------------------
    // Artist Permit
    //--------------------------------------------------------------------------

    Route::get('permit/artist/datatable', 'Admin\ArtistController@datatable')->name('artist.datatable');
    Route::resource('permit/artist', 'Admin\ArtistController');

    //--------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------

    //Approvers
    Route::resource('settings/approvers', 'ProcedureApproverController');

    //Events
    Route::get('settings/event/event_type/datatable', 'Admin\EventTypeController@datatable')->name('event_type.datatable');
    Route::get('settings/event/event_type/isexist', 'Admin\EventTypeController@isexist')->name('event_type.isexist');
    Route::resource('settings/event/event_type', 'Admin\EventTypeController');


    Route::get('/settings/artist/profession/datatable', 'Admin\ArtistProfessionController@datatable')->name('profession.datatable');
    Route::get('settings/artist/profession/isexist', 'Admin\ArtistProfessionController@isexist')->name('profession.isexist');
    Route::resource('settings/artist/profession', 'Admin\ArtistProfessionController');
});
