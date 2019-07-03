<?php


// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::resource('event_permits', 'Company\EventController');
Route::resource('artist_permits', 'Company\ArtistController');

Route::get('/add_new_event', 'Company\EventController@addEvent');

