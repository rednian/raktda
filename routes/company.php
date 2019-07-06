<?php

Route::group(['middleware'=>'company'], function(){
     Route::get('dashboard', 'Company\DashboardController@index')->name('company.dashboard');
     Route::resource('event_permits', 'Company\EventController');
     Route::resource('event_permits', 'Company\EventController');
     Route::resource('artist_permits', 'Company\ArtistController');
     Route::get('/add_new_event', 'Company\EventController@addEvent');   
});

