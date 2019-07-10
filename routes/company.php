<?php

Route::group(['middleware'=>'company'], function(){
    Route::get('dashboard', 'Company\DashboardController@index')->name('company.dashboard');
    Route::resource('artist_permits', 'Company\ArtistController');
    Route::resource('event_permits', 'Company\EventController');
    Route::get('add_new_event', 'Company\EventController@create');
    Route::get('add_new_artist', 'Company\ArtistController@create');
    Route::post('apply_artist_permit', 'Company\ArtistController@store');
    Route::post('apply_event_permit','Company\EventController@store');
});






