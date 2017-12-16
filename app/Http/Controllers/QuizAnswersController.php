<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use App\Http\Forms\QuizAnswerForm;
use App\Http\ListViews\QuizAnswersListView;

use Administr\Controllers\AdminController;
use Illuminate\Http\Response;
use App\Http\Requests;

class QuizAnswersController extends AdminController
{
    /**
     * @param $quiz_id
     * @return Response
     */
    public function index($quiz_id)
    {
        $list = new QuizAnswersListView(
            QuizAnswer::with(['quiz' => function($q) {
                $q->where('user_id', auth()->id());
            }])
            ->whereHas('quiz', function($query) {
                return $query->where('user_id', auth()->id());
            })
            ->where('quiz_id', $quiz_id)
            ->paginate(20)
        );

        if($list->getDataSource()->count() == 0) {
            flash()->error('The quiz has no answers or you do not have access to that quiz.');
            return redirect()->route('quizzes.index', [
                'sort' => [
                    'ends_at' => 'desc',
                ]
            ]);
        }

        $title = 'Quiz Answers';
        $this->title(['', $title]);

        return view('quiz-answers.list', compact('list', 'title'));
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
