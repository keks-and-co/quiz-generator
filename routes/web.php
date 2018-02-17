<?php

Route::get('/registration', [
    'as'   => 'admin.registration',
    'uses' => 'Auth\RegisterController@showRegistrationForm',
]);
Route::post('/registration', [
    'as'   => 'admin.registration',
    'uses' => 'Auth\RegisterController@register',
]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [
        'uses' => 'DashboardController@view',
        'as'   => 'administr.dashboard.index',
    ]);

    Route::get('quizzes/{id}/share', [
        'uses' => 'QuizzesController@share',
        'as'   => 'quizzes.share',
    ]);
    Route::post('quizzes/{id}/share', [
        'uses' => 'QuizzesController@postShare',
        'as'   => 'quizzes.share',
    ]);
    Route::resource('quizzes', 'QuizzesController');
    Route::resource('quizzes.questions', 'QuestionsController');
    Route::resource('quizzes.answers', 'QuizAnswersController');
    Route::get('/quizzes/questions/question', 'QuestionsController@question');
    Route::get('/quizzes/questions/answer', 'QuestionsController@answer');
    Route::delete('/quizzes/questions/{question}', 'QuestionsController@deleteQuestion');
    Route::delete('/quizzes/questions/{question}/answers/{answer}', 'QuestionsController@deleteAnswer');

});
