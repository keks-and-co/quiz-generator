<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Forms\QuestionForm;
use App\Http\ListViews\QuestionsListView;

use Administr\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class QuestionsController extends AdminController
{

    public function partialForm(Request $request)
    {
        $slug = $request->get('slug');
        $view = 'questions._' . $slug;

        if(!view()->exists($view)) {
            return response()->json([
                'error' => 'Could not create the question type.',
            ], 404);
        }

        return view($view, [
            'index' => $request->get('index'),
            'type' => $request->get('type'),
            'slug' => $slug,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = new QuestionsListView(
            Question::paginate(20)
        );

        $title = '';
        $this->title(['', $title]);

        return view('questions.list', compact('list', 'title'));
    }

    /**
     * @param QuestionForm $form
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionForm $form)
    {
        $form->action = route('.questions.store');
        $form->method = 'post';

        $title = '';
        $this->title(['', $title]);

        return view('questions.form', compact('form', 'title'));
    }

    /**
     * @param QuestionForm $form
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionForm $form)
    {
        $model = Question::create($form->all());

        if(!$model) {
            flash()->error('');

            return back()->withInput($form->all());
        }

        flash()->success('');

        return redirect()->route('.questions.index');
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
     * @param QuestionForm $form
     * @return \Illuminate\Http\Response
     */
    public function edit($id, QuestionForm $form)
    {
        $form->action = route('.questions.update', [$id]);
        $form->method = 'put';
        $form->dataSource(Question::findOrFail($id));

        $title = '';
        $this->title(['', $title]);

        return view('questions.form', compact('form', 'title'));
    }

    /**
     * @param  int $id
     * @param QuestionForm $form
     * @return \Illuminate\Http\Response
     */
    public function update($id, QuestionForm $form)
    {
        $model = Question::findOrFail($id);

        if(!$model->update($form->all())) {
            flash()->error('');

            return back()->withInput($form->all());
        }

        flash()->success('');

        return redirect()->route('.questions.index');
    }
}