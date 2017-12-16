<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionType;
use App\Models\Quiz;
use App\Http\Forms\QuizForm;
use App\Http\ListViews\QuizzesListView;

use Administr\Controllers\AdminController;
use Illuminate\Http\Response;
use App\Http\Requests;

class QuizzesController extends AdminController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = new QuizzesListView(
            Quiz::where('user_id', auth()->id())
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

        if(!$model) {
            flash()->error(sprintf('The quiz "%s" could not be saved.', $data['name']));

            return back()->withInput($form->request()->all());
        }

        foreach($form->request()->input('question') as $question_id => $question) {
            $answers = array_get($question, 'answers', []);

            $question = Question::create([
                'type_id' => $question['type_id'],
                'quiz_id' => $model->id,
                'value' => $question['value'],
            ]);

            $this->saveAnswers($question, $answers);
        }

        flash()->success(sprintf('The quiz "%s" was successfully saved!', $data['name']));

        return redirect()->route('quizzes.index');
    }

    /**
     * @param  int  $id
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

        foreach($form->request()->input('question') as $question_id => $question) {
            $answers = array_get($question, 'answers', []);

            $question = Question::firstOrCreate([
                'type_id' => $question['type_id'],
                'quiz_id' => $id,
                'id' => $question_id,
            ], [
                'value' => $question['value'],
            ]);

            $this->saveAnswers($question, $answers);
        }

        if(!$model->update($form->request()->input('quiz'))) {
            flash()->error(sprintf('The quiz "%s" could not be updated.', $model->name));

            return back()->withInput($form->all());
        }

        flash()->success(sprintf('The quiz "%s" was updated successfully!', $model->name));

        return redirect()->route('quizzes.index');
    }

    protected function saveAnswers(Question $question, array $answers)
    {
        foreach($answers as $id => $answer) {
            QuestionAnswer::updateOrCreate([
                'id' => $id,
                'question_id' => $question->id,
            ], [
                'value' => $answer,
            ]);
        }
    }
}
