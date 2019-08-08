<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('{company_name}/dashboard', 'Company\DashboardController@index')->name('company.dashboard');
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
    Route::get('/payment_gateway', 'Company\ArtistController@payment_gateway')->name('company.payment_gateway');
    Route::post('/cancel_permit', 'Company\ArtistController@cancel_permit')->name('company.cancel_permit');
    Route::post('show_cancelled', 'Company\ArtistController@show_cancelled')->name('company.show_cancelled');
    Route::get('download_permit', 'Company\ArtistController@download_permit')->name('company.download_permit');
    Route::post('submit_happiness', 'Company\ArtistController@submit_happiness')->name('company.submit_happiness');
    Route::get('happiness_meter/{id}', 'Company\ArtistController@happiness_meter')->name('company.happiness_meter');
    Route::post('uploadfile', 'Company\ArtistController@uploadDocuments')->name('company.upload_file');
    Route::post('deletefile', 'Company\ArtistController@deleteDocuments')->name('company.delete_file');
    Route::get('clear_the_temp', 'Company\ArtistController@clear_the_temp')->name('clear_the_temp');
    Route::get('viewPermit/{id}', 'Company\ArtistController@viewPermit')->name('company.viewPermit');
    Route::post('getArtistsInPermit', 'Company\ArtistController@getArtistsInPermit')->name('company.getArtistsInPermit');
    Route::get('edit_artist/{id}', 'Company\ArtistController@edit_artist')->name('company.edit_artist');
    Route::get('del_artist/{id}', 'Company\ArtistController@del_artist')->name('company.del_artist');
});
