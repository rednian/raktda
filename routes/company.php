<?php


Route::group(['middleware' => ['auth', 'set_lang_front']], function () {
    Route::get('/dashboard', function () {
        return redirect()->route('artist.index');
    })->name('company.dashboard');

    // Route::get('{company_name}/dashboard', function () {
    //     return redirect()->route('artist.index');
    // })->name('company.dashboard');

    Route::resource('artist', 'Company\ArtistController');
    Route::get('artist/new/{id}', 'Company\ArtistController@create')->name('company.add_new_permit');
    // Route::post('apply_artist_permit',  'Company\ArtistController@store')->name('company.apply_artist_permit');
    Route::post('add_artist_temp',  'Company\ArtistController@add_artist_temp')->name('company.add_artist_temp');
    Route::get('fetch_applied_artists', 'Company\ArtistController@fetch_applied')->name('company.fetch_applied_artists');
    Route::get('fetch_existing_artists', 'Company\ArtistController@fetch_valid')->name('company.fetch_existing_artists');
    Route::get('fetch_existing_drafts',  'Company\ArtistController@fetch_drafts')->name('company.fetch_existing_drafts');
    Route::post('delete_artist', 'Company\ArtistController@delete_artist')->name('company.delete_artist');
    Route::post('update_artist_temp', 'Company\ArtistController@update_artist_temp')->name('company.update_artist_temp');
    Route::post('get_files_uploaded', 'Company\ArtistController@get_files_uploaded')->name('company.get_files_uploaded');
    Route::get('get_uploaded_artist_photo/{id}',  'Company\ArtistController@get_uploaded_artist_photo')->name('company.get_uploaded_artist_photo');
    Route::get('artist/add_artist_to_permit/{from}/{id}', 'Company\ArtistController@add_artist_to_permit')->name('company.add_artist_to_permit');
    Route::get('fetch_areas/{id}',   'Company\ArtistController@fetch_areas')->name('company.fetch_areas');
    Route::post('searchCode',   'Company\ArtistController@searchCode')->name('company.searchCode');
    Route::post('download_file',   'Company\ArtistController@download_file')->name('company.download_file');
    Route::post('update_permit',  'Company\ArtistController@update_permit')->name('artist.update_permit');
    Route::post('fetch_artist_details',  'Company\ArtistController@fetch_artist_details')->name('company.fetch_artist_details');
    Route::post('fetch_artist_temp_data',  'Company\ArtistController@fetch_artist_temp_data')->name('company.fetch_artist_temp_data');
    Route::get('clear_the_temp',  'Company\ArtistController@clear_the_temp')->name('clear_the_temp');
    Route::post('cancel_permit',   'Company\ArtistController@cancel_permit')->name('company.cancel_permit');
    Route::post('show_cancelled',  'Company\ArtistController@show_cancelled')->name('company.show_cancelled');
    Route::get('show_rejected/{id}',  'Company\ArtistController@show_rejected')->name('company.show_rejected');
    // Route::post('uploadfile',  'Company\ArtistController@uploadDocuments')->name('company.upload_file');
    Route::post('delete_artist_from_temp',  'Company\ArtistController@delete_artist_from_temp')->name('company.delete_artist_from_temp');
    Route::post('clear_the_temp_data',  'Company\ArtistController@clear_the_temp_data')->name('company.clear_the_temp_data');
    Route::get('artist/view_draft_details/{id}',  'Company\ArtistController@view_draft_details')->name('company.view_draft_details');
    Route::post('uploadDocument',  'Company\ArtistController@uploadDocument')->name('company.uploadDocument');
    Route::post('uploadPhoto',  'Company\ArtistController@uploadPhoto')->name('company.uploadPhoto');
    Route::get('artist/get_permit_details/{id}',  'Company\ArtistController@get_permit_details')->name('company.get_permit_details');
    Route::get('update_is_edit/{id}',  'Company\ArtistController@update_is_edit')->name('company.update_is_edit');
    Route::get('download_permit/{permit}',  'Company\ArtistController@download_permit')->name('company.download_permit');
    Route::get('artist/add_new/{id?}/{from?}',  'Company\ArtistController@add_new_artist')->name('company.add_new_artist');
    Route::post('storePermitDetails',  'Company\ArtistController@storePermitDetails')->name('company.storePermitDetails');
    Route::get('get_temp_photo_temp_id/{id}',  'Company\ArtistController@get_temp_photo_temp_id')->name('company.get_temp_photo_temp_id');
    Route::post('get_temp_files_by_temp_id',  'Company\ArtistController@get_temp_files_by_temp_id')->name('company.get_temp_files_by_temp_id');
    Route::post('artist/add_draft',  'Company\ArtistController@add_draft')->name('artist.add_draft');
    Route::get('artist/get_draft_details/{id}',  'Company\ArtistController@get_draft_details')->name('company.get_draft_details');
    Route::get('artist/edit/{id}/{from}',  'Company\ArtistController@edit_artist')->name('artist.edit_artist');
    Route::get('edit_artist_draft/{id}',  'Company\ArtistController@edit_artist_draft')->name('company.edit_artist_draft');
    Route::get('update_checklist/{id}',  'Company\ArtistController@update_checklist')->name('company.update_checklist');
    Route::get('artist/permit/{id}/{status}',  'Company\ArtistController@permit')->name('artist.permit');
    Route::get('artist/make_payment/{id?}',  'Company\ArtistController@make_payment')->name('company.make_payment');
    Route::get('artist/payment_gateway/{permit}',  'Company\ArtistController@payment_gateway')->name('company.payment_gateway');
    Route::post('artist/payment/{permit}/payment',  'Company\ArtistController@payment')->name('company.payment');
    Route::get('artist/happiness_center/{id}',  'Company\ArtistController@happiness_center')->name('company.happiness_center');
    Route::post('submit_happiness',  'Company\ArtistController@submit_happiness')->name('artist.submit_happiness');
    Route::get('artist/get_status/{id}', 'Company\ArtistController@get_status')->name('company.artist.get_status');
    Route::get('artist/details/{id}/{from}', 'Company\ArtistController@get_artist_details')->name('artist_details.view');
    Route::get('artist/temp/details/{id}/{from}', 'Company\ArtistController@get_temp_artist_details')->name('temp_artist_details.view');
    Route::get('artist/fetch_artist_comment/{id}', 'Company\ArtistController@fetch_artist_comment')->name('artist.fetch_artist_comment');
    Route::post('artist/check_artist/exists', 'Company\ArtistController@check_artist_exists')->name('artist.check_artist_exists');
    Route::post('artist/fetch_event_details', 'Company\ArtistController@fetch_event_details')->name('artist.fetch_event_details');


    Route::resource('event', 'Company\EventController');
    Route::post('event/update_event', 'Company\EventController@update_event')->name('company.event.update_event');
    Route::get('event/payment/{event}', 'Company\EventController@payment')->name('company.event.payment');
    Route::get('event/draft/{event}', 'Company\EventController@view_draft')->name('company.event.draft');
    Route::post('event/draft/add', 'Company\EventController@add_draft')->name('company.event.add_draft');
    Route::post('event/draft/update', 'Company\EventController@update_draft')->name('company.event.update_draft');
    Route::get('event/download/{id}', 'Company\EventController@download')->name('company.event.download');
    Route::post('event/cancel', 'Company\EventController@cancel')->name('event.cancel');
    Route::get('event/reject_reason/{event}', 'Company\EventController@reject_reason')->name('event.reject_reason');
    Route::get('event/cancel_reason/{event}', 'Company\EventController@cancel_reason')->name('company.event.cancel_reason');
    Route::get('fetch_applied_events', 'Company\EventController@fetch_applied')->name('company.event.fetch_applied');
    Route::get('fetch_existing_events', 'Company\EventController@fetch_valid')->name('company.event.fetch_valid');
    Route::get('fetch_event_drafts',  'Company\EventController@fetch_draft')->name('company.event.fetch_draft');
    Route::get('event/fetch_requirements/{id}', 'Company\EventController@fetch_requirements')->name('company.event.get_requirements');
    Route::get('event/get_additional_requirements/{id}', 'Company\EventController@fetch_additional_requirements')->name('company.event.get_additional_requirements');
    Route::get('event/get_status/{id}', 'Company\EventController@get_status')->name('company.event.get_status');
    Route::post('event/get_uploaded_docs', 'Company\EventController@get_uploaded_docs')->name('company.event.get_uploaded_docs');
    Route::post('event/make_payment', 'Company\EventController@make_payment')->name('company.event.make_payment');
    Route::get('company/event/calendar', 'Company\EventController@calendarFn')->name('company.event.calendar');
    Route::get('event/happiness/{event}', 'Company\EventController@happiness')->name('event.happiness');
    Route::post('event/submit_happiness', 'Company\EventController@submit_happiness')->name('event.submit_happiness');
    Route::post('uploadEventDocument', 'Company\EventController@uploadDocument')->name('event.uploadDocument');
    Route::post('event/deleteUploadedfile', 'Company\EventController@deleteUploadFile')->name('event.deleteUploadedfile');
    Route::post('event/deleteTruckUploadedfile', 'Company\EventController@deleteTruckUploadedfile')->name('event.deleteTruckUploadedfile');
    Route::get('event/amend/{event}', 'Company\EventController@amend')->name('event.amend');
    Route::post('event/amend', 'Company\EventController@applyAmend')->name('event.applyAmend');
    Route::post('event/uploadLogo', 'Company\EventController@uploadLogo')->name('event.uploadLogo');
    Route::get('event/get_uploaded_logo/{id}', 'Company\EventController@get_uploaded_logo')->name('event.get_uploaded_logo');
    Route::post('event/uploadTruck', 'Company\EventController@uploadTruck')->name('event.uploadTruck');
    Route::get('event/add_artist/{id?}', 'Company\EventController@add_artist')->name('event.add_artist');
    Route::get('event/fetch_truck_req/{id}', 'Company\EventController@fetch_truck_req')->name('event.fetch_truck_req');


    Route::get('resetUploadsSession/{id}', 'Company\CommonController@resetUploadsSession')->name('company.resetUploadsSession');
});
