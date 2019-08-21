<?php


Route::group(['middleware' => ['auth']], function () {


    // START ARTIST PERMIT


    Route::resource('artist_permits', 'Company\ArtistController');
    Route::resource('event_permits', 'Company\EventController');

    Route::get('{company_name}/dashboard', 'Company\DashboardController@index')->name('company.dashboard');
    Route::get('add_new_event', 'Company\EventController@create');
    Route::get('add_new_artist', 'Company\ArtistController@create');
    Route::get('json_applied_artists_list', 'Company\ArtistController@applied_list')->name('company.json_applied_artists_list');
    Route::get('json_existing_artists_list', 'Company\ArtistController@existing_list')->name('company.json_existing_artists_list');
    Route::get('make_payment/{id?}', 'Company\ArtistController@makepayment')->name('make_payment');
    Route::get('extend_permit/{id?}', 'Company\ArtistController@extend_permit')->name('extend_permit');
    Route::get('export_applied_artist_permits', 'Company\ArtistController@export_applied_artist_permits')->name('export_applied_artist_permits');
    Route::get('export_existing_artist_permits', 'Company\ArtistController@export_existing_artist_permits')->name('export_existing_artist_permits');
    Route::get('payment_gateway', 'Company\ArtistController@payment_gateway')->name('company.payment_gateway');
    Route::get('download_permit', 'Company\ArtistController@download_permit')->name('company.download_permit');
    Route::get('happiness_meter/{id}', 'Company\ArtistController@happiness_meter')->name('company.happiness_meter');
    Route::get('clear_the_temp', 'Company\ArtistController@clear_the_temp')->name('clear_the_temp');
    Route::get('edit_add_new_artist/{id}', 'Company\ArtistController@edit_add_new_artist')->name('company.edit_add_new_artist');

    Route::post('apply_artist_permit', 'Company\ArtistController@store')->name('company.apply_artist_permit');
    Route::post('apply_event_permit', 'Company\EventController@store');
    Route::post('fetch_artist_details', 'Company\ArtistController@fetch_artist_details')->name('company.fetch_artist_details');
    Route::post('cancel_permit', 'Company\ArtistController@cancel_permit')->name('company.cancel_permit');
    Route::post('show_cancelled', 'Company\ArtistController@show_cancelled')->name('company.show_cancelled');
    Route::post('submit_happiness', 'Company\ArtistController@submit_happiness')->name('company.submit_happiness');
    Route::post('uploadfile', 'Company\ArtistController@uploadDocuments')->name('company.upload_file');
    Route::post('deletefile', 'Company\ArtistController@deleteDocuments')->name('company.delete_file');
    Route::post('getArtistsInPermit', 'Company\ArtistController@getArtistsInPermit')->name('company.getArtistsInPermit');
    Route::post('get_files_uploaded', 'Company\ArtistController@get_files_uploaded')->name('json_edit_artist_permit.get_files_uploaded');
    Route::post('update_artist_permit', 'Company\ArtistController@update_artist_permit')->name('company.update_artist_permit');

    // create Permit
    Route::get('fetch_areas/{id}', 'Company\ArtistController@fetch_areas')->name('company.fetch_areas');
    Route::get('searchCode/{id}', 'Company\ArtistController@searchCode')->name('company.searchCode');
    Route::get('get_files_uploaded_with_code/{id}', 'Company\ArtistController@get_files_uploaded_with_code')->name('company.get_files_uploaded_with_code');
    Route::post('download_file', 'Company\ArtistController@download_file')->name('company.download_file');

    // view Permit
    Route::get('viewPermit/{id}', 'Company\ArtistController@viewPermit')->name('company.viewPermit');
    Route::post('delete_artist_from_permit', 'Company\ArtistController@delete_artist_from_permit')->name('company.delete_artist_from_permit');

    // edit Artist
    Route::get('edit_artist/{id}', 'Company\ArtistController@edit_artist')->name('company.edit_artist');
    Route::post('add_artist_to_permit', 'Company\ArtistController@add_artist_to_permit')->name('company.add_artist_to_permit');

    //insert into drafts
    Route::post('insert_artist_data_into_drafts', 'Company\ArtistController@insert_artist_data_into_drafts')->name('company.insert_artist_data_into_drafts');

    //fetch from drafts
    Route::get('fetch_artist_data_from_drafts', 'Company\ArtistController@fetch_artist_data_from_drafts')->name('company.fetch_artist_data_from_drafts');

    // END ARTIST PERMIT
});
