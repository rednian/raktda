<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware'=>'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/artist', 'admin\ArtistController');
    
});


