<?php
//---------------------------------------------------------------------------------------------------------------
// INSPECTOR
//---------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['auth', 'inspector', 'set_lang']], function () {

	//DASHBOARD
	Route::get('/dashboard', 'Inspector\DashboardController@index')->name('inspector.dashboard');

	//TASKS

	// --------------------------------- ARTIST PERMIT ----------------------------------------------------------------
	Route::get('tasks/datatable', 'Admin\ArtistPermitController@datatable')
        ->name('tasks.datatable');
    Route::get('tasks/artist_permit/{permit}/application', 'Inspector\TasksController@artist_permit')
        ->name('tasks.artist_permit.details');
    Route::get('tasks/artist_permit/{permit}/application/datatable', 'Admin\ArtistPermitController@applicationDataTable')
        ->name('tasks.artist_permit.applicationdetails.datatable');
    Route::get('tasks/artist_permit/artist/{artist}', 'Inspector\TasksController@artist_permit_individual')->name('tasks.artist_permit.artist');

    Route::get('tasks/artist_permit/{permit}/application/{artistpermit}', 'Inspector\TasksController@artist_permit_checklist')
        ->name('tasks.artist_permit.checkApplication');
    Route::get('tasks/artist_permit/{permit}/application/{artistpermit}/documentDatatable', 'Admin\ArtistPermitController@artistChecklistDocument')
        ->name('tasks.artist_permit.document');

	Route::resource('tasks', 'Inspector\TasksController');

});