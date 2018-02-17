<?php

namespace App\Http\Controllers;

use App\Http\Forms\ShareQuizForm;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionType;
use App\Models\Quiz;
use App\Http\Forms\QuizForm;
use App\Http\ListViews\QuizzesListView;

use Administr\Controllers\AdminController;
use App\QueryFilters\QuizzesFilter;
use Illuminate\Http\Response;
use App\Http\Requests;

class QuizzesController extends AdminController
{
    /**
     * @param QuizzesFilter $filters
     * @return Response
     */
    public function index(QuizzesFilter $filters)
    {
        $list = new QuizzesListView(
            Quiz::where('user_id', auth()->id())
                ->filter($filters)
                ->paginate(20)
        );

        $title = 'Quizzes';
        $this->title(['', $title]);

        return view('quizzes.list', compact('list', 'title'));
    }

    /**
     * @param QuizForm $form
     * @return \Illuminate\Http\Response
     */
    public function create(QuizForm $form)
    {
        $form->action = route('quizzes.store');
        $form->method = 'post';

        $title = 'Create a Quiz';
        $this->title(['', 'Quizzes', $title]);

        $question_types = QuestionType::all(['id', 'slug', 'name']);

        return view('quizzes.form', compact('form', 'title', 'question_types'));
    }

    /**
     * @param QuizForm $form
     * @return \Illuminate\Http\Response
     */
    public function store(QuizForm $form)
    {
        $data = $form->request()->input('quiz');
        $model = Quiz::create($data + ['user_id' => auth()->id()]);

        if (!$model) {
            flash()->error(sprintf('The quiz "%s" could not be saved.', $data['name']));

            return back()->withInput($form->request()->all());
        }

        foreach ($form->request()->input('question', []) as $question_id => $question) {
            $answers = array_get($question, 'answers', []);
            $type = $question['type'];

            $question = Question::create([
                'type_id' => $question['type_id'],
                'quiz_id' => $model->id,
                'value'   => $question['value'],
            ]);

            $this->saveAnswers($question, $answers, $type);
        }

        flash()->success(sprintf('The quiz "%s" was successfully saved!', $data['name']));

        return redirect()->route('quizzes.index', [
            'sort' => [
                'ends_at' => 'desc',
            ],
        ]);
    }

    /**
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param  int $id
     * @param QuizForm $form
     * @return \Illuminate\Http\Response
     */
    public function edit($id, QuizForm $form)
    {
        $quiz = Quiz::with('questions.answers', 'questions.type')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $form->action = route('quizzes.update', [$id]);
        $form->method = 'put';
        $form->dataSource(['quiz' => $quiz]);

        $title = 'Edit a Quiz';
        $this->title(['', 'Quizzes', $title]);

        $question_types = QuestionType::all(['id', 'slug', 'name']);

        return view('quizzes.form', compact('form', 'quiz', 'title', 'question_types'));
    }

    /**
     * @param  int $id
     * @param QuizForm $form
     * @return \Illuminate\Http\Response
     */
    public function update($id, QuizForm $form)
    {
        $model = Quiz::where('user_id', auth()->id())
            ->findOrFail($id);

        foreach ($form->request()->input('question', []) as $question_id => $question) {
            $answers = array_get($question, 'answers', []);
            $type = $question['type'];

            $question = Question::firstOrCreate([
                'type_id' => $question['type_id'],
                'quiz_id' => $id,
                'id'      => $question_id,
            ], [
                'value' => $question['value'],
            ]);

            $this->saveAnswers($question, $answers, $type);
        }

        $quiz = ['is_anonymous' => $form->request()->has('is_anonymous')] + $form->request()->input('quiz');

        if (!$model->update($quiz)) {
            flash()->error(sprintf('The quiz "%s" could not be updated.', $model->name));

            return back()->withInput($form->all());
        }

        flash()->success(sprintf('The quiz "%s" was updated successfully!', $model->name));

        return redirect()->route('quizzes.index', [
            'sort' => [
                'ends_at' => 'desc',
            ],
        ]);
    }

    protected function saveAnswers(Question $question, array $answers, $type = 'text')
    {
        if ($type == 'range') {
            $answers = [
                min($answers),
                max($answers),
            ];
        }

        foreach ($answers as $id => $answer) {
            QuestionAnswer::updateOrCreate([
                'id'          => $id,
                'question_id' => $question->id,
            ], [
                'value' => $answer,
            ]);
        }
    }

    public function share($id, ShareQuizForm $form)
    {
        $quiz = Quiz::find($id);

        if(!$quiz) {
            flash()->error('The quiz you are trying to share does not exist.');
            return redirect()->route('quizzes.index');
        }

        $form->method = 'post';
        $form->action = route('quizzes.share', [$id]);

        $title = 'Share a Quiz';
        $this->title(['', 'Quizzes', $title]);

        return view('quizzes.share', compact('quiz', 'form', 'title'));
    }

    public function postShare($id, ShareQuizForm $form)
    {
        $recepients = explode(',', $form->request()->get('recepients'));

        $recepients = array_filter($recepients, function($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        });

        if(count($recepients) == 0) {
            flash()->error('The provided comma-separated list of recepients does not contain any valid emails. Please, provide valid email addresses in order to share the quiz.');
            return back()->withInput($form->request()->all());
        }

        dd($recepients);
    }
}
