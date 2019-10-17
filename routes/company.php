<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return redirect()->route('artist_permits.index');
    })->name('company.dashboard');

    Route::get('{company_name}/dashboard', function () {
        return redirect()->route('artist_permits.index');
    })->name('company.dashboard');

    $artistPermitLink = 'Company\Artist';

    // START ARTIST PERMIT
    Route::resource('artist_permits', $artistPermitLink . '\MainController');
    Route::get('add_new_permit/{id?}', $artistPermitLink . '\MainController@create')->name('company.add_new_permit');
    Route::post('apply_artist_permit',  $artistPermitLink . '\MainController@store')->name('company.apply_artist_permit');
    Route::post('add_artist_to_draft',  $artistPermitLink . '\MainController@add_artist_to_draft')->name('company.add_artist_to_draft');
    Route::get('fetch_applied_artists', $artistPermitLink . '\MainController@fetch_applied_artists')->name('company.fetch_applied_artists');
    Route::get('fetch_existing_artists', $artistPermitLink . '\MainController@fetch_existing_artists')->name('company.fetch_existing_artists');
    Route::post('delete_artist', $artistPermitLink . '\MainController@delete_artist')->name('company.delete_artist');
    Route::post('update_artist_temp_data', $artistPermitLink . '\MainController@update_artist_temp_data')->name('company.update_artist_temp_data');
    Route::post('get_files_uploaded', $artistPermitLink . '\MainController@get_files_uploaded')->name('company.get_files_uploaded');
    Route::get('get_files_uploaded_with_code/{id}', $artistPermitLink . '\MainController@get_files_uploaded_with_code')->name('company.get_files_uploaded_with_code');
    Route::get('add_artist_to_permit/{from}/{id}',  $artistPermitLink . '\MainController@add_artist_to_permit')->name('company.add_artist_to_permit');
    Route::post('add_to_artist_temp_data', $artistPermitLink . '\MainController@add_to_artist_temp_data')->name('company.add_to_artist_temp_data');
    Route::get('fetch_areas/{id}',  $artistPermitLink . '\MainController@fetch_areas')->name('company.fetch_areas');
    Route::post('searchCode',  $artistPermitLink . '\MainController@searchCode')->name('company.searchCode');
    Route::post('download_file',  $artistPermitLink . '\MainController@download_file')->name('company.download_file');
    Route::post('move_temp_to_permit', $artistPermitLink . '\MainController@move_temp_to_permit')->name('company.move_temp_to_permit');
    Route::post('fetch_artist_details', $artistPermitLink . '\MainController@fetch_artist_details')->name('company.fetch_artist_details');
    Route::post('fetch_artist_temp_data', $artistPermitLink . '\MainController@fetch_artist_temp_data')->name('company.fetch_artist_temp_data');
    Route::get('clear_the_temp', $artistPermitLink . '\MainController@clear_the_temp')->name('clear_the_temp');
    Route::post('cancel_permit',  $artistPermitLink . '\MainController@cancel_permit')->name('company.cancel_permit');
    Route::post('show_cancelled', $artistPermitLink . '\MainController@show_cancelled')->name('company.show_cancelled');
    Route::get('show_rejected/{id}', $artistPermitLink . '\MainController@show_rejected')->name('company.show_rejected');
    // Route::post('uploadfile', $artistPermitLink . '\MainController@uploadDocuments')->name('company.upload_file');


    Route::post('delete_artist_from_temp', $artistPermitLink . '\MainController@delete_artist_from_temp')->name('company.delete_artist_from_temp');
    Route::post('clear_the_temp_data', $artistPermitLink . '\MainController@clear_the_temp_data')->name('company.clear_the_temp_data');
    Route::get('view_draft_details/{id}', $artistPermitLink . '\DraftsController@view_draft_details')->name('company.view_draft_details');


    Route::post('uploadDocument', $artistPermitLink . '\MainController@uploadDocument')->name('company.uploadDocument');
    Route::post('uploadPhoto', $artistPermitLink . '\MainController@uploadPhoto')->name('company.uploadPhoto');
    Route::get('get_permit_details/{id}', $artistPermitLink . '\MainController@get_permit_details')->name('company.get_permit_details');
    Route::get('update_is_edit/{id}', $artistPermitLink . '\MainController@update_is_edit')->name('company.update_is_edit');
    Route::get('download_permit/{permit}', $artistPermitLink . '\MainController@download_permit')->name('company.download_permit');
    Route::get('add_new_artist/{id?}', $artistPermitLink . '\MainController@add_new_artist')->name('company.add_new_artist');
    Route::post('storePermitDetails', $artistPermitLink . '\MainController@storePermitDetails')->name('company.storePermitDetails');
    Route::get('get_temp_photo_temp_id/{id}', $artistPermitLink . '\MainController@get_temp_photo_temp_id')->name('company.get_temp_photo_temp_id');
    Route::post('get_temp_files_by_temp_id', $artistPermitLink . '\MainController@get_temp_files_by_temp_id')->name('company.get_temp_files_by_temp_id');

    Route::get('get_uploaded_artist_photo/{id}', $artistPermitLink . '\MainController@get_uploaded_artist_photo')->name('company.get_uploaded_artist_photo');

    //drafts
    Route::post('save_permit_to_drafts', $artistPermitLink . '\DraftsController@save_permit_to_drafts')->name('company.save_permit_to_drafts');
    Route::get('fetch_existing_drafts', $artistPermitLink . '\DraftsController@fetch_existing_drafts')->name('company.fetch_existing_drafts');
    Route::get('get_draft_details/{id}', $artistPermitLink . '\DraftsController@get_draft_details')->name('company.get_draft_details');



    // Edit Controller
    Route::get('edit_artist/{id}', $artistPermitLink . '\RenewController@edit_artist')->name('company.edit_artist');
    Route::get('edit_artist_draft/{id}', $artistPermitLink . '\DraftsController@edit_artist_draft')->name('company.edit_artist_draft');
    Route::get('update_checklist/{id}', $artistPermitLink . '\EditController@update_checklist')->name('company.update_checklist');
    Route::get('edit_permit/{id}', $artistPermitLink . '\EditController@edit_permit')->name('company.edit_permit');
    Route::post('get_error_fields_list', $artistPermitLink . '\EditController@get_error_fields_list')->name('company.get_error_fields_list');
    Route::get('edit_edit_artist/{id}', $artistPermitLink . '\EditController@edit_edit_artist')->name('company.edit_edit_artist');

    // Payment Controller
    Route::get('make_payment/{id?}', $artistPermitLink . '\PaymentController@make_payment')->name('company.make_payment');
    Route::get('payment_gateway/{permit}', $artistPermitLink . '\PaymentController@payment_gateway')->name('company.payment_gateway');
    Route::post('artistpermits/{permit}/payment', $artistPermitLink . '\PaymentController@payment')->name('company.payment');
    Route::get('happiness_center/{id}', $artistPermitLink . '\PaymentController@happiness_center')->name('company.happiness_center');
    Route::post('submit_happiness', $artistPermitLink . '\PaymentController@submit_happiness')->name('company.submit_happiness');

    // Renew Controller
    Route::get('renew_permit/{id}', $artistPermitLink . '\RenewController@renew_permit')->name('company.renew_permit');
    Route::post('move_temp_to_permit_renew', $artistPermitLink . '\RenewController@move_temp_to_permit_renew')->name('company.move_temp_to_permit_renew');

    // Amend Controller
    Route::get('amend_permit/{id}', $artistPermitLink . '\AmendController@amend_permit')->name('company.amend_permit');
    Route::get('replace_artist/{id}',  $artistPermitLink . '\AmendController@replace_artist')->name('company.replace_artist');

    Route::resource('event', 'Company\EventController');
    Route::post('event/update_event', 'Company\EventController@update_event')->name('company.event.update_event');
    Route::get('event/payment/{event}', 'Company\EventController@payment')->name('company.event.payment');
    Route::get('event/draft/{event}', 'Company\EventController@view_draft')->name('company.event.draft');
    Route::post('event/draft/add', 'Company\EventController@add_draft')->name('company.event.add_draft');
    Route::post('event/draft/update', 'Company\EventController@update_draft')->name('company.event.update_draft');
    Route::get('event/download/{id}', 'Company\EventController@download')->name('company.event.download');
    Route::post('event/cancel', 'Company\EventController@cancel')->name('event.cancel');
    Route::get('event/upload/{event}', 'Company\EventController@upload')->name('company.event.upload');
    Route::post('event/reject_reason/{event}', 'Company\EventController@reject_reason')->name('event.reject_reason');
    Route::get('event/cancel_reason/{event}', 'Company\EventController@cancel_reason')->name('company.event.cancel_reason');
    Route::get('fetch_applied_events', 'Company\EventController@fetch_applied')->name('company.event.fetch_applied');
    Route::get('fetch_existing_events', 'Company\EventController@fetch_valid')->name('company.event.fetch_valid');
    Route::get('fetch_event_drafts',  'Company\EventController@fetch_draft')->name('company.event.fetch_draft');
    Route::get('event/fetch_requirements/{id}', 'Company\EventController@fetch_requirements')->name('company.event.get_requirements');
    Route::post('event/get_uploaded_docs', 'Company\EventController@get_uploaded_docs')->name('company.event.get_uploaded_docs');
    Route::post('event/make_payment', 'Company\EventController@make_payment')->name('company.event.make_payment');
    Route::get('event/happiness/{event}', 'Company\EventController@happiness')->name('event.happiness');
    Route::post('event/submit_happiness', 'Company\EventController@submit_happiness')->name('event.submit_happiness');
});
