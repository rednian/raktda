<?php
Route::get('/', function () {
    return redirect()->route('login');
})->name('default');

Route::get('/test', function(){
    $permit = App\Approval::find(2)->permit;
    dd($permit);
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::get('/shutdown', function () {
    return Artisan::call('down');
});

Route::get('/live', function () {
    return Artisan::call('up');
});

Auth::routes(['register' => false]);
Route::post('/update_language', 'Admin\UserController@updateLanguage')->name('admin.language')->middleware('auth');


Route::middleware(['admin', 'auth', 'set_lang'])->group(function(){


    Route::get('/dashboard', function () {
        return redirect()->route('admin.event.index');
    })->name('admin.dashboard');
  //---------------------------------------------------------------------------------------------------------------
  // Company Registration
 //----------------------------------------------------------------------------------------------------------------
    Route::get('/company_registration/datatable', 'Admin\CompanyController@datatable')->name('admin.company.datatable');
    Route::get('/company_registration', 'Admin\CompanyController@index')->name('admin.company.index');
    Route::get('/company_registration/{company}', 'Admin\CompanyController@show')->name('admin.company.show');
    Route::post('/company_registration/{company}', 'Admin\CompanyController@submit')->name('admin.company.submit');
    Route::get('/company_registration/{company}/application', 'Admin\CompanyController@application')->name('admin.company.application');
    Route::get('/company_registration/{company}/application-datatable', 'Admin\CompanyController@applicationDatatable')->name('admin.company.application.datatable');

  //---------------------------------------------------------------------------------------------------------------
  // Event Permit
 //----------------------------------------------------------------------------------------------------------------
	Route::get('/event','Admin\EventController@index')->name('admin.event.index');
	Route::get('/event/datatable','Admin\EventController@dataTable')->name('admin.event.datatable');
    Route::get('/event/calendar','Admin\EventController@calendar')->name('admin.event.calendar');
	Route::get('/event/{event}/application','Admin\EventController@application')->name('admin.event.application');
	Route::get('/event/{event}/application/datatable','Admin\EventController@applicationDatatable')->name('admin.event.applicationDatatable');
    Route::post('/event/{event}/cancel','Admin\EventController@cancel')->name('admin.event.cancel');
    Route::get('/event/{event}/show-all', 'Admin\EventController@showAll')->name('admin.event.showall');
    Route::get('/event/{event}/show-web', 'Admin\EventController@showWeb')->name('admin.event.showweb');
	Route::get('/event/{event}','Admin\EventController@show')->name('admin.event.show');
	Route::get('/event/{event}/lock','Admin\EventController@updateLock')->name('admin.event.lock');
	Route::post('/event/{event}','Admin\EventController@submit')->name('admin.event.submit');
    Route::get('/event/{event}/download','Admin\EventController@download')->name('admin.event.download');
    Route::get('/event/{event}/addition-requirement-datatable','Admin\EventController@addRequirementDatatable')->name('admin.event.additionalrequirementdatatable');
    Route::get('/event/{event}/requirement-datatable','Admin\EventController@uploadedRequiremet')->name('admin.event.uploadedRequiremet');
    Route::get('/event/{event}/comment-datatable','Admin\EventController@commentDatatable')->name('admin.event.comment');

  //---------------------------------------------------------------------------------------------------------------
  // Artist
  //---------------------------------------------------------------------------------------------------------------
	Route::get('/permit/artist', 'Admin\ArtistController@datatable')->name('admin.artist.datatable');
	Route::get('/permit/artist/{artist}', 'Admin\ArtistController@show')->name('admin.artist.show');
	Route::post('/permit/artist/{artist}/updatestatus', 'Admin\ArtistController@updatestatus')->name('admin.artist.update_status');
	Route::get('/permit/artist/{artist}/permithistory', 'Admin\ArtistController@permithistory')->name('admin.artist.permit.history');
	Route::get('/permit/artist/{artist}/status_history', 'Admin\ArtistController@statusHistory')->name('admin.artist.status_history');
//
    Route::get('/permit/artist_permit/{artistpermit}/history', 'Admin\ArtistController@history')->name('admin.artist_permit.history');
    //admin.artist_block

    Route::post('/artist_block', 'Admin\ArtistController@artist_block')->name('admin.artist_block');
    Route::post('/artist_unblock', 'Admin\ArtistController@artist_unblock')->name('admin.artist_unblock');
    Route::post('/checked_list', 'Admin\ArtistController@checked_list')->name('admin.checked_list');



    //---------------------------------------------------------------------------------------------------------------
    // Artist Permit
    //---------------------------------------------------------------------------------------------------------------
    
    Route::get('/artist_permit/search', 'Admin\ArtistPermitController@search')->name('admin.artist_permit.search');
    
    Route::get('/artist_permit/{permit}/history', 'Admin\ArtistPermitController@permitHistory')
        ->name('admin.artist_permit.history');

    Route::get('/artist_permit/{permit}/application/{artistpermit}/comment/datatable', 'Admin\ArtistPermitController@applicationCommentDataTable')
        ->name('admin.artist_permit.comment.datatable');

    Route::get('/artist_permit/{permit}/download', 'Admin\ArtistPermitController@download')->name('admin.artist_permit.download');

    Route::get('/artist_permit/{permit}/application/approver', 'Admin\ArtistPermitController@approverDataTable')
        ->name('admin.artist_permit.approverDataTable');

    Route::get('/artist_permit/{permit}/application/{artist}/permitHistory', 'Admin\ArtistPermitController@artistPermitHistory')
        ->name('admin.artist_permit.existing_permit.datatable');

    Route::get('/artist_permit/{permit}/application/{artistpermit}/documentDatatable', 'Admin\ArtistPermitController@artistChecklistDocument')
        ->name('admin.artist_permit.document');

    Route::get('/arist_permit/{permit}/checkactivepermit/{artist}', 'Admin\ArtistPermitController@checkActivePermit')
        ->name('admin.artist_permit.checkactivepermit');

    Route::post('/artist_permit/{permit}/application', 'Admin\ArtistPermitController@submitApplication')
        ->name('admin.artist_permit.submit');

    Route::post('/artist_permit/{permit}/application/{artistpermit}/checklist', 'Admin\ArtistPermitController@artistChecklist')
        ->name('admin.artist_permit.checklist');

    Route::get('/artist_permit/{permit}/application/datatable', 'Admin\ArtistPermitController@applicationDataTable')
        ->name('admin.artist_permit.applicationdetails.datatable');

    Route::get('/artist_permit/{permit}/application/{artistpermit}', 'Admin\ArtistPermitController@checkApplication')
        ->name('admin.artist_permit.checkApplication');

    Route::get('/artist_permit/{permit}/application', 'Admin\ArtistPermitController@applicationDetails')
        ->name('admin.artist_permit.applicationdetails');

    Route::get('/artist_permit/datatable', 'Admin\ArtistPermitController@datatable')
        ->name('admin.artist_permit.datatable');
    Route::get('/artist_permit/{permit}', 'Admin\ArtistPermitController@show')
        ->name('admin.artist_permit.show');
    Route::get('/artist_permit', 'Admin\ArtistPermitController@index')
        ->name('admin.artist_permit.index');

    //---------------------------------------------------------------------------------------------------------------
    // User Management
    //---------------------------------------------------------------------------------------------------------------

    Route::get('user_management/datatable', 'Admin\UserController@datatable')->name('user_management.datatable');
    Route::get('user_management/details/{user}', 'Admin\UserController@showUser')->name('user_management.details');
    Route::patch('user_management/details/{user}', 'Admin\UserController@updateUSer')->name('user_management.update_user');
    Route::get('user_management/schedule/get', 'Admin\UserController@getSchedule')->name('user_management.get_schedule');
    Route::post('user_management/schedule/set_active', 'Admin\UserController@setScheduleActive')->name('user_management.set_active_schedule');
    Route::get('user_management/details/{user}/schedule/create', 'Admin\UserController@addCustomSchedule')->name('user_management.schedule.create');
    Route::post('user_management/details/{user}/schedule/store', 'Admin\UserController@saveCustomSchedule')->name('user_management.schedule.store');
    Route::get('user_management/details/{user}/schedule/{custom}/edit', 'Admin\UserController@editCustomSchedule')->name('user_management.schedule.edit');
    Route::post('user_management/details/{user}/schedule/{custom}/update', 'Admin\UserController@updateCustomSchedule')->name('user_management.schedule.update');
    Route::post('user_management/details/{user}/schedule/{custom}/delete', 'Admin\UserController@deleteCustomSchedule')->name('user_management.schedule.delete');
    Route::resource('user_management', 'Admin\UserController');

    //---------------------------------------------------------------------------------------------------------------
    // Settings
    //---------------------------------------------------------------------------------------------------------------

    Route::prefix('settings')->group(function () {

        Route::get('/', 'Admin\SettingController@index')->name('admin.setting.index');
        Route::post('general_settings/save', 'Admin\SettingController@saveGeneralSettings')->name('admin.setting.general_settings.save');

        Route::get('excel', 'Admin\SettingController@excelTojson')->name('admin.settings.excel');

        //PROFESSION SETTINGS
        Route::get('profession/isexist', 'Admin\ProfessionController@isexist')->name('settings.profession.isexist');

        Route::get('profession/datatable', 'Admin\ProfessionController@datatable')->name('settings.profession.datatable');
        
        Route::get('profession/create', 'Admin\ProfessionController@create')->name('settings.profession.create');
        Route::post('profession/store', 'Admin\ProfessionController@store')->name('settings.profession.store');

        Route::get('profession/{profession}/edit', 'Admin\ProfessionController@edit')->name('settings.profession.edit');
        Route::post('profession/{profession}/update', 'Admin\ProfessionController@update')->name('settings.profession.update');

        Route::delete('profession/{profession}/destroy', 'Admin\ProfessionController@destroy')->name('settings.profession.destroy');

        //REQUIREMENTS SETTINGS
        Route::get('requirements/datatable', 'Admin\RequirementController@datatable')->name('requirements.datatable');
        Route::get('requirements/isexist', 'Admin\RequirementController@isexist')->name('requirements.isexist');
        Route::resource('requirements', 'Admin\RequirementController');

        //EVENT TYPE SETTINGS
        Route::get('event_type/datatable', 'Admin\EventTypeController@datatable')->name('event_type.datatable');
        Route::get('event_type/isexist', 'Admin\EventTypeController@isexist')->name('event_type.isexist');
        Route::resource('event_type', 'Admin\EventTypeController');

        //ACCOUNT SETTINGS
        Route::get('account', 'Admin\AccountSettingsController@index')->name('admin.settings.account');
        Route::post('account/save', 'Admin\AccountSettingsController@store')->name('admin.settings.account.save');

        //SCHEDULE TYPE SETTINGS
        Route::resource('schedule_type', 'Admin\ScheduleTypeController');
        Route::post('schedule_type/set_active/{schedule_type}', 'Admin\ScheduleTypeController@setActive')->name('schedule_type.set_active');
    });
});
