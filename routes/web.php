<?php



Auth::routes();

Route::group(['middleware'=>'admin'], function(){
    Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');

    Route::resource('/artist', 'admin\ArtistController');
    
});


