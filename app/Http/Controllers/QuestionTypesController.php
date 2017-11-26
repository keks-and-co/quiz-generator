<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use App\Http\Forms\QuestionTypeForm;
use App\Http\ListViews\QuestionTypesListView;

use Administr\Controllers\AdminController;
use Illuminate\Http\Response;
use App\Http\Requests;

class QuestionTypesController extends AdminController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = new QuestionTypesListView(
            QuestionType::paginate(20)
        );

        $title = '';
        $this->title(['', $title]);

        return view('question-types.list', compact('list', 'title'));
    }

    /**
     * @param QuestionTypeForm $form
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionTypeForm $form)
    {
        $form->action = route('.question-types.store');
        $form->method = 'post';

        $title = '';
        $this->title(['', $title]);

        return view('question-types.form', compact('form', 'title'));
    }

    /**
     * @param QuestionTypeForm $form
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionTypeForm $form)
    {
        $model = QuestionType::create($form->all());

        if(!$model) {
            flash()->error('');

            return back()->withInput($form->all());
        }

        flash()->success('');

        return redirect()->route('.question-types.index');
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
     * @param QuestionTypeForm $form
     * @return \Illuminate\Http\Response
     */
    public function edit($id, QuestionTypeForm $form)
    {
        $form->action = route('.question-types.update', [$id]);
        $form->method = 'put';
        $form->dataSource(QuestionType::findOrFail($id));

        $title = '';
        $this->title(['', $title]);

        return view('question-types.form', compact('form', 'title'));
    }

    /**
     * @param  int $id
     * @param QuestionTypeForm $form
     * @return \Illuminate\Http\Response
     */
    public function update($id, QuestionTypeForm $form)
    {
        $model = QuestionType::findOrFail($id);

        if(!$model->update($form->all())) {
            flash()->error('');

            return back()->withInput($form->all());
        }

        flash()->success('');

        return redirect()->route('.question-types.index');
    }
}
