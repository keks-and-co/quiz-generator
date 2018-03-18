<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Forms\QuestionForm;
use App\Http\ListViews\QuestionsListView;

use Administr\Controllers\AdminController;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class QuestionsController extends AdminController
{

    public function question(Request $request)
    {
        $slug = $request->get('slug');

        return view('questions._question', [
            'index' => $request->get('index'),
            'type' => $request->get('type'),
            'type_id' => $request->get('type_id'),
            'slug' => $slug,
            'value' => '',
        ]);
    }

    public function answer(Request $request)
    {
        return view('questions._answer', [
            'index' => $request->get('index'),
            'answerId' => '',
            'value' => '',
        ]);
    }

    public function deleteQuestion($question_id)
    {
        $question = Question::findOrFail($question_id);

        if($question->answers()->delete() && $question->delete()) {
            return response(['status' => 'success']);
        }

        return response(['status' => 'error', Response::HTTP_NOT_FOUND]);
    }

    public function deleteAnswer($question_id, $answer_id)
    {
        $answer = QuestionAnswer::where('question_id', $question_id)
            ->where('id', $answer_id)
            ->delete();

        if($answer) {
            return response(['status' => 'success']);
        }

        return response(['status' => 'error', Response::HTTP_NOT_FOUND]);
    }
}
