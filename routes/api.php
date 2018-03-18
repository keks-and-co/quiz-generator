<?php

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/quiz/{id}', function ($id) {
    $quiz = fractal()
        ->item(
            Quiz::with('questions.answers', 'questions.type')
                ->find($id)
        )
        ->transformWith(new \App\Http\Transformers\QuizTransformer())
        ->parseIncludes(['questions', 'questions.type', 'questions.answers'])
        ->toArray();

    $questionsCount = count($quiz['questions']);

    if ($questionsCount <= 0) {
        $questionsCount = 1;
    }

    $chunkSize = round($questionsCount / $quiz['per_page']);

    $quiz['questions'] = array_chunk($quiz['questions'], $chunkSize);

    return $quiz;
});

Route::post('/quiz/{id}', function ($id) {
    $quiz = Quiz::find($id);

    if (!$quiz) {
        return response([
            'status'  => 'error',
            'message' => 'quiz-not-found',
        ], Response::HTTP_NOT_FOUND);
    }

    // @todo handle request to save

    return response(['status' => 'success', 'message' => 'quiz-response-saved']);
});
