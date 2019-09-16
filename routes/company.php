<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function(){return redirect()->route('artist_permits.index'); })->name('company.dashboard');

    Route::get('{company_name}/dashboard', 'Company\DashboardController@index')->name('company.dashboard');

    $artistPermitLink = 'Company\Artist';

    // START ARTIST PERMIT
    Route::resource('artist_permits', $artistPermitLink . '\MainController');
    Route::get('add_new_artist', $artistPermitLink . '\MainController@create');
    Route::post('apply_artist_permit',  $artistPermitLink . '\MainController@store')->name('company.apply_artist_permit');
    Route::get('fetch_applied_artists', $artistPermitLink . '\MainController@fetch_applied_artists')->name('company.fetch_applied_artists');
    Route::get('fetch_existing_artists', $artistPermitLink . '\MainController@fetch_existing_artists')->name('company.fetch_existing_artists');
    Route::post('delete_artist', $artistPermitLink . '\MainController@delete_artist')->name('company.delete_artist');
    Route::post('update_artist_temp_data', $artistPermitLink . '\MainController@update_artist_temp_data')->name('company.update_artist_temp_data');
    Route::post('get_files_uploaded', $artistPermitLink . '\MainController@get_files_uploaded')->name('company.get_files_uploaded');
    Route::get('get_files_uploaded_with_code/{id}', $artistPermitLink . '\MainController@get_files_uploaded_with_code')->name('company.get_files_uploaded_with_code');
    Route::get('add_artist_to_permit/{id}/{from}',  $artistPermitLink . '\MainController@add_artist_to_permit')->name('company.add_artist_to_permit');
    Route::post('add_to_artist_temp_data', $artistPermitLink . '\MainController@add_to_artist_temp_data')->name('company.add_to_artist_temp_data');
    Route::get('fetch_areas/{id}',  $artistPermitLink . '\MainController@fetch_areas')->name('company.fetch_areas');
    Route::get('searchCode/{id}',  $artistPermitLink . '\MainController@searchCode')->name('company.searchCode');
    Route::post('download_file',  $artistPermitLink . '\MainController@download_file')->name('company.download_file');
    Route::post('move_temp_to_permit', $artistPermitLink . '\MainController@move_temp_to_permit')->name('company.move_temp_to_permit');
    Route::post('fetch_artist_details', $artistPermitLink . '\MainController@fetch_artist_details')->name('company.fetch_artist_details');
    Route::post('get_files_by_artist_permit_id',  $artistPermitLink . '\MainController@get_files_by_artist_permit_id')->name('company.get_files_by_artist_permit_id');
    Route::get('get_photo_by_artist_permit_id/{id}',  $artistPermitLink . '\MainController@get_photo_by_artist_permit_id')->name('company.get_photo_by_artist_permit_id');
    Route::post('fetch_artist_temp_data', $artistPermitLink . '\MainController@fetch_artist_temp_data')->name('company.fetch_artist_temp_data');
    Route::get('clear_the_temp', $artistPermitLink . '\MainController@clear_the_temp')->name('clear_the_temp');
    Route::post('cancel_permit',  $artistPermitLink . '\MainController@cancel_permit')->name('company.cancel_permit');
    Route::post('show_cancelled', $artistPermitLink . '\MainController@show_cancelled')->name('company.show_cancelled');
    Route::post('uploadfile', $artistPermitLink . '\MainController@uploadDocuments')->name('company.upload_file');
    Route::post('deletefile', $artistPermitLink . '\MainController@deleteDocuments')->name('company.delete_file');
    Route::get('get_permit_details/{id}', $artistPermitLink . '\MainController@get_permit_details')->name('company.get_permit_details');

    //drafts
    Route::post('insert_artist_data_into_drafts', $artistPermitLink . '\MainController@insert_artist_data_into_drafts')->name('company.insert_artist_data_into_drafts');
    Route::get('fetch_artist_data_from_drafts', $artistPermitLink . '\MainController@fetch_artist_data_from_drafts')->name('company.fetch_artist_data_from_drafts');

    // Edit Controller
    Route::get('edit_artist/{from}/{id}', $artistPermitLink . '\EditController@edit_artist')->name('company.edit_artist');
    Route::get('update_checklist/{id}', $artistPermitLink . '\EditController@update_checklist')->name('company.update_checklist');
    Route::get('edit_permit/{id}', $artistPermitLink . '\EditController@edit_permit')->name('company.edit_permit');
    Route::post('get_error_fields_list', $artistPermitLink . '\EditController@get_error_fields_list')->name('company.get_error_fields_list');
    Route::get('edit_edit_artist/{id}', $artistPermitLink . '\EditController@edit_edit_artist')->name('company.edit_edit_artist');

    // Payment Controller
    Route::get('make_payment/{id?}', $artistPermitLink . '\PaymentController@make_payment')->name('company.make_payment');
    Route::get('payment_gateway/{id}', $artistPermitLink . '\PaymentController@payment_gateway')->name('company.payment_gateway');
    Route::get('happiness_meter/{id}', $artistPermitLink . '\PaymentController@happiness_meter')->name('company.happiness_meter');
    Route::post('submit_happiness', $artistPermitLink . '\PaymentController@submit_happiness')->name('company.submit_happiness');

    // Renew Controller
    Route::get('renew_permit/{id}', $artistPermitLink . '\RenewController@renew_permit')->name('company.renew_permit');
    Route::post('move_temp_to_permit_renew', $artistPermitLink . '\RenewController@move_temp_to_permit_renew')->name('company.move_temp_to_permit_renew');

    // Amend Controller
    Route::get('amend_permit/{id}', $artistPermitLink . '\AmendController@amend_permit')->name('company.amend_permit');
    Route::get('replace_artist/{id}',  $artistPermitLink . '\AmendController@replace_artist')->name('company.replace_artist');

    Route::get('download_permit', 'Company\ArtistController@download_permit')->name('company.download_permit');
});
