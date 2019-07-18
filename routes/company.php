<?php

Route::group(['middleware' => 'company'], function () {

    Route::get('dashboard', 'Company\DashboardController@index')->name('company.dashboard');
    Route::resource('artist_permits', 'Company\ArtistController');
    Route::resource('event_permits', 'Company\EventController');
    Route::get('add_new_event', 'Company\EventController@create');
    Route::get('add_new_artist', 'Company\ArtistController@create');
    Route::post('apply_artist_permit', 'Company\ArtistController@store')->name('company.apply_artist_permit');
    Route::post('apply_event_permit', 'Company\EventController@store');
    Route::get('json_applied_artists_list', 'Company\ArtistController@applied_list')->name('company.json_applied_artists_list');
    Route::get('json_existing_artists_list', 'Company\ArtistController@existing_list')->name('company.json_existing_artists_list');
    Route::get('/make_payment/{id?}', 'Company\ArtistController@makepayment')->name('make_payment');
    Route::post('/fetch_artist_details', 'Company\ArtistController@fetch_artist_details')->name('company.fetch_artist_details');
    Route::get('/extend_permit/{id?}', 'Company\ArtistController@extend_permit')->name('extend_permit');
    Route::get('/export_applied_artist_permits', 'Company\ArtistController@export_applied_artist_permits')->name('export_applied_artist_permits');
    Route::get('/export_existing_artist_permits', 'Company\ArtistController@export_existing_artist_permits')->name('export_existing_artist_permits');
    Route::post('/payment_gateway', 'Company\ArtistController@payment_gateway')->name('company.payment_gateway');

    Route::post('/cancel_permit', 'Company\ArtistController@cancel_permit')->name('company.cancel_permit');

    Route::post('show_cancelled', 'Company\ArtistController@show_cancelled')->name('company.show_cancelled');
});
