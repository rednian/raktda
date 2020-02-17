<?php

use App\Library\Smpp;

Route::get('/', function () {return redirect()->route('login');
})->name('default');

Route::get('/test', function(){
sendSms('+971568835006', 'Your ATM was access 2 minutes ago. Please change your ATM Password.');

});

Route::get('/link', function () {
return phpinfo();
     //Artisan::call('storage:link');
     //return redirect()->back();
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

Route::get('/registration', 'Company\CompanyController@create')->name('company.create')->middleware('signed');
Route::post('/registration', 'Company\CompanyController@store')->name('company.store');
Route::get('/registration/is_exist', 'Company\CompanyController@isexist')->name('company.isexist');

Auth::routes(['register' => false, 'verify' => true ]);
Route::post('/update_language', 'Admin\UserController@updateLanguage')->name('admin.language')->middleware('auth');

//GET NOTIFICATIONS
Route::get('/getnotifications', 'Admin\UserController@getNotifications')->name('getnotifications');

Route::middleware(['admin', 'auth', 'set_lang', ])->group(function(){

    Route::get('/dashboard', function (Illuminate\Http\Request $request) {

        $role_id = $request->user()->roles()->first()->role_id;

        if($role_id == 6){
            return redirect(URL::signedRoute('admin.event.index'));
        }

        if($role_id == 4 || $role_id == 5){
            return redirect(URL::signedRoute('admin.artist_permit.index'));
        }

        return redirect(URL::signedRoute('admin.company.index'));
    })->name('admin.dashboard');
  //---------------------------------------------------------------------------------------------------------------
  // Company Registration
 //----------------------------------------------------------------------------------------------------------------
    Route::get('/company_registration/datatable', 'Admin\CompanyController@datatable')->name('admin.company.datatable');
    Route::get('/company_registration', 'Admin\CompanyController@index')->name('admin.company.index');
    Route::get('/company_registration/{company}', 'Admin\CompanyController@show')->name('admin.company.show');
    Route::post('/company_registration/{company}', 'Admin\CompanyController@submit')->name('admin.company.submit');
    Route::post('/company_registration/{company}/change-status', 'Admin\CompanyController@changeStatus')->name('admin.company.changestatus');
    Route::get('/company_registration/{company}/application', 'Admin\CompanyController@application')->name('admin.company.application');
    Route::get('/company_registration/{company}/application-datatable', 'Admin\CompanyController@applicationDatatable')->name('admin.company.application.datatable');
    Route::get('/company_registration/{company}/event-datatable', 'Admin\CompanyController@eventDatatable')->name('admin.company.event.datatable');
    Route::get('/company_registration/{company}/artist-datatable', 'Admin\CompanyController@artistDatatable')->name('admin.company.artist.datatable');
    Route::get('/company_registration/{company}/comment-datatable', 'Admin\CompanyController@commentDatatable')->name('admin.company.comment.datatable');
    Route::get('/company_registration/{company}/artist-permit-datatable', 'Admin\CompanyController@artistPermitDatatable')->name('admin.company.artistpemit.datatable');

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
    Route::get('/event/{event}/liquor-datatable','Admin\EventController@liquorRequirementDatatable')->name('admin.event.liquor.requirement');
    Route::get('/event/{event}/truck-datatable','Admin\EventController@truckDatatable')->name('admin.event.truck.datatable');
    Route::get('/event/{event}/image-datatable','Admin\EventController@imageDatatable')->name('admin.event.images.datatable');
    Route::get('/event/{event}/truck/{eventtruck}/datatable','Admin\EventController@truckRequirementDatatable')->name('admin.event.truck.requirement');
    Route::get('/event/{event}/artist/datatable','Admin\EventController@artistDatatable')->name('admin.event.artist');

    Route::get('/event/time/test', 'Admin\EventController@addAppointment')->name('admin.event.time');
    Route::post('/event/{event}/savecomment', 'Admin\EventController@saveEventComment')->name('admin.event.savecomment');

  //---------------------------------------------------------------------------------------------------------------
  // Artist
  //---------------------------------------------------------------------------------------------------------------
	Route::get('/permit/artist', 'Admin\ArtistController@datatable')->name('admin.artist.datatable');
	Route::get('/permit/artist/{artist}', 'Admin\ArtistController@show')->name('admin.artist.show');
	Route::post('/permit/artist/{artist}/updatestatus', 'Admin\ArtistController@updateStatus')->name('admin.artist.update_status');
	Route::get('/permit/artist/{artist}/permithistory', 'Admin\ArtistController@permithistory')->name('admin.artist.permit.history');
	Route::get('/permit/artist/{artist}/status_history', 'Admin\ArtistController@statusHistory')->name('admin.artist.status_history');
    Route::get('/permit/artist/{artist}/activepermitdatatable', 'Admin\ArtistController@activePermitDatatable')->name('admin.artist.activepermitdatatable');
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

    Route::post('/artist_permit/{permit}/cancel-permit', 'Admin\ArtistPermitController@cancelPermit')
        ->name('admin.artist_permit.cancelPermit');

    Route::get('artist_permit/{permit}/comment/datatable', 'Admin\ArtistPermitController@permitCommentDatatable')->name('admin.permit.comment.datatable');

    Route::get('/artist_permit/{permit}/application/{artistpermit}/comment/datatable', 'Admin\ArtistPermitController@applicationCommentDataTable')
        ->name('admin.artist_permit.comment.datatable');

    Route::get('/artist_permit/{permit}/download', 'Admin\ArtistPermitController@download')->name('admin.artist_permit.download');

    Route::get('/artist_permit/{permit}/application/approver', 'Admin\ArtistPermitController@approverDataTable')
        ->name('admin.artist_permit.approverDataTable');

    Route::get('/artist_permit/{permit}/application/{artist}/permitHistory', 'Admin\ArtistPermitController@artistPermitHistory')
        ->name('admin.artist_permit.existing_permit.datatable');

    Route::get('/artist_permit/{permit}/application/{artistpermit}/documentDatatable', 'Admin\ArtistPermitController@artistChecklistDocument')
        ->name('admin.artist_permit.document');

    Route::get('/artist_permit/{permit}/checkactivepermit/{artist}', 'Admin\ArtistPermitController@checkActivePermit')
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
        ->name('admin.artist_permit.applicationdetails')->middleware('lock_artist_permit');

    Route::get('/artist_permit/datatable', 'Admin\ArtistPermitController@datatable')
        ->name('admin.artist_permit.datatable');
    Route::get('/artist_permit/{permit}', 'Admin\ArtistPermitController@show')
        ->name('admin.artist_permit.show');
    Route::get('/artist_permit', 'Admin\ArtistPermitController@index')
        ->name('admin.artist_permit.index');


    //ADDED BY DON
    Route::post('/artist_permit/lock/{permit}', function(Illuminate\Http\Request $request, App\Permit $permit){
        $permit->update([
            'lock' => Carbon\Carbon::now(),
            'lock_user_id' => $request->user()->user_id
        ]);
    })->name('artist_permit.lock');


    //Reports
    Route::get('/artist_reports', 'Admin\ReportController@reports')
        ->name('admin.artist_permit_reports.reports');

        Route::post('/artist_permit_reports', 'Admin\ReportController@artist_reports')
        ->name('admin.artist_permit_reports.artist_reports');


    Route::post('/artist_reports/search_artist', 'Admin\ReportController@search_artist')
        ->name('admin.artist_permit_reports.search_artist');

    Route::post('/artist_reports/search_active_artist', 'Admin\ReportController@search_active_artist')
        ->name('admin.artist_permit_reports.search_active_artist');

    Route::post('/artist_reports/search_artist_select', 'Admin\ReportController@onChangeSelect')
        ->name('admin.artist_permit_reports.search_artist_select');

    Route::get('/event_reports/event_report', 'Admin\EventReportController@event_reports')
        ->name('admin.event_reports.event_report');

    Route::get('/event_reports/applied_date', 'Admin\EventReportController@applied_date')
        ->name('admin.event_reports.applied_date');

    Route::get('/event_reports/application_type', 'Admin\EventReportController@application_type')
        ->name('admin.event_reports.application_type');

    Route::get('artist_reports/event_reports/getEvent/{id}', 'Admin\EventReportController@getEvent')
        ->name('admin.event_reports.getEvent');

    Route::post('/event_reports/status', 'Admin\EventReportController@status')
        ->name('admin.event_reports.status');

    Route::get('artist_reports/artist_permit_report/show/{id}', 'Admin\EventReportController@show')
        ->name('admin.event_reports.show');

    Route::post('artist_reports/artist_permit_report/events', 'Admin\EventReportController@events')
        ->name('admin.event_reports.events');

    Route::get('artist_reports/artist_permit_report/show/{id}', 'Admin\ReportController@artist_permit_report')
        ->name('admin.artist_permit_report.show');


    Route::get('artist_reports/artist_permit_report/active_permit', 'Admin\ReportController@datatable')
        ->name('admin.artist_permit_report.active_permit');

    Route::get('artist_reports/artist_permit_report/all_permit_report', 'Admin\ReportController@all_permit_report')
        ->name('admin.artist_permit_report.all_permit_report');

    Route::get('artist_reports/artist_permit_report/transactionShow/{id}', 'Admin\TransactionReportController@transactionShow')
        ->name('admin.artist_permit_report.transaction');
    Route::post('artist_reports/artist_permit_report/eventTransactionDateRange', 'Admin\TransactionReportController@eventTransactionDateRange')
        ->name('admin.artist_permit_report.eventTransactionDateRange');


    //Transactions
    Route::get('artist_reports/artist_transaction_report', 'Admin\TransactionReportController@artistTransaction')
        ->name('admin.artist_permit_report.artistTransaction');
    Route::get('artist_reports/event_transaction_report', 'Admin\TransactionReportController@eventTransaction')
        ->name('admin.artist_permit_report.eventTransaction');
    Route::get('artist_reports/event_transaction_report/eventTransactionDatatable', 'Admin\TransactionReportController@eventTransactionDatatable')
        ->name('admin.artist_permit_report.eventTransactionDatatable');
    Route::get('artist_reports/eventSevenDaysReport', 'Admin\TransactionReportController@sevenDaysEvent')
        ->name('admin.artist_permit_report.sevenDaysEvent');
    Route::get('artist_reports/thirtyDaysEvent', 'Admin\TransactionReportController@thirtyDaysEvent')
        ->name('admin.artist_permit_report.thirtyDaysEvent');
    Route::post('artist_reports/customEventDate', 'Admin\TransactionReportController@customEventDate')
        ->name('admin.artist_permit_report.customEventDate');
    Route::get('artist_reports/artistSevenDaysReport', 'Admin\TransactionReportController@sevenDaysArtist')
        ->name('admin.artist_permit_report.sevenDaysArtist');
    Route::get('artist_reports/thirtyDaysArtist', 'Admin\TransactionReportController@thirtyDaysArtist')
        ->name('admin.artist_permit_report.thirtyDaysArtist');
    Route::post('artist_reports/customArtistDate', 'Admin\TransactionReportController@customArtistDate')
        ->name('admin.artist_permit_report.customArtistDate');
    Route::get('artist_reports/transactionDate', 'Admin\TransactionReportController@transactionDate')
        ->name('admin.artist_permit_report.transactionDate');
    Route::get('artist_reports/artistHistory/{id}', 'Admin\ReportController@artistHistory')
        ->name('admin.artist_permit_report.artistHistory');
    Route::post('artist_reports/chartData', 'Admin\TransactionReportController@chartData')
        ->name('admin.artist_permit_report.chartData');






    //---------------------------------------------------------------------------------------------------------------
    // Inspection Appointments
    //---------------------------------------------------------------------------------------------------------------

    Route::get('/inspection', 'Admin\InspectionController@index')->name('inspection.index');
    Route::get('/inspection/get_schedules/', 'Admin\InspectionController@getEvents')->name('inspection.get_schedules');
    Route::get('/inspection/get_schedules_datatable', 'Admin\InspectionController@getEventsDatatable')->name('inspection.get_schedules_datatable');
    Route::get('/inspection/{inspection}', 'Admin\InspectionController@show')->name('inspection.show');
    Route::get('/inspection/{inspection}/inspect', 'Admin\InspectionController@inspect')->name('inspection.inspect');
    Route::post('/inspection/{inspection}/inspect/submit', 'Admin\InspectionController@submitInspection')->name('inspection.inspect.submit');


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

    // LEAVE ROUTES
    Route::get('user_management/leave/add/{user?}', 'Admin\UserController@addLeave')->name('user_management.leave.add');
    Route::post('user_management/leave/save/{user?}', 'Admin\UserController@saveLeave')->name('user_management.leave.save');
    Route::get('user_management/leave/get/{user?}', 'Admin\UserController@getLeaves')->name('user_management.leave.get');
    Route::get('user_mangement/leave/{leave}/show/{user?}', 'Admin\UserController@showLeave')->name('user_management.leave.show');
    Route::post('user_management/leave/{leave}/update/{user?}', 'Admin\UserController@updateLeave')->name('user_management.leave.update');
    Route::post('user_management/leave/{leave}/delete/{user?}', 'Admin\UserController@deleteLeave')->name('user_management.leave.delete');

    //HOLIDAYS ROUTES
    Route::get('user_management/holiday/add', 'Admin\UserController@addHoliday')->name('user_management.holiday.add');
    Route::post('user_management/holiday/save', 'Admin\UserController@saveHoliday')->name('user_management.holiday.save');
    Route::get('user_management/holiday/get', 'Admin\UserController@getHoliday')->name('user_management.holiday.get');
    Route::get('user_management/holiday/{holiday}', 'Admin\UserController@showHoliday')->name('user_management.holiday.show');
    Route::patch('user_management/holiday/{holiday}', 'Admin\UserController@updateHoliday')->name('user_management.holiday.update');
    Route::delete('user_management/holiday/{holiday}', 'Admin\UserController@deleteHoliday')->name('user_management.holiday.delete');

    Route::resource('user_management', 'Admin\UserController');

    //---------------------------------------------------------------------------------------------------------------
    // Settings
    //---------------------------------------------------------------------------------------------------------------

    Route::prefix('settings')->group(function () {

        Route::get('checkoutsession', 'Admin\SettingController@checkoutsession')->name('admin.setting.checkout');

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

    //NOTIFICATIONS
    Route::get('notifications', 'Admin\UserController@notifications')->name('admin.notifications');
    Route::get('notifications_dt', 'Admin\UserController@getNotificationsDatatable')->name('admin.notifications.datatable');
    Route::get('notifications/update_read', 'Admin\UserController@updateAsReadNotification')->name('admin.notifications.update_read');
});
