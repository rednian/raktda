<?php
//---------------------------------------------------------------------------------------------------------------
// INSPECTOR
//---------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['auth', 'inspector', 'set_lang']], function () {

	//DASHBOARD
	Route::get('/dashboard', 'Inspector\DashboardController@index')->name('inspector.dashboard');

	//TASKS
	Route::resource('tasks', 'Inspector\TasksController');

});