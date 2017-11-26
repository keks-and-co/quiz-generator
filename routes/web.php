<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [
        'uses' => 'DashboardController@view',
        'as'   => 'administr.dashboard.index',
    ]);

    Route::resource('/quizzes', 'QuizzesController');

});
