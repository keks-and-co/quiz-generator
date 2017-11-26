<?php

namespace App\Http\Controllers;

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
            Quiz::paginate(20)
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

        return view('quizzes.form', compact('form', 'title'));
    }

    /**
     * @param QuizForm $form
     * @return \Illuminate\Http\Response
     */
    public function store(QuizForm $form)
    {
        $data = $form->request()->input('quiz');
        $model = Quiz::create($data);

        if(!$model) {
            flash()->error(sprintf('The quiz "%s" could not be saved.', $data['name']));

            return back()->withInput($form->request()->all());
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
        $form->action = route('quizzes.update', [$id]);
        $form->method = 'put';
        $form->dataSource(['quiz' => Quiz::findOrFail($id)]);

        $title = 'Edit a Quiz';
        $this->title(['', 'Quizzes', $title]);

        return view('quizzes.form', compact('form', 'title'));
    }

    /**
     * @param  int $id
     * @param QuizForm $form
     * @return \Illuminate\Http\Response
     */
    public function update($id, QuizForm $form)
    {
        $model = Quiz::findOrFail($id);

        if(!$model->update($form->request()->input('quiz'))) {
            flash()->error(sprintf('The quiz "%s" could not be updated.', $model->name));

            return back()->withInput($form->all());
        }

        flash()->success(sprintf('The quiz "%s" was updated successfully!', $model->name));

        return redirect()->route('quizzes.index');
    }
}
