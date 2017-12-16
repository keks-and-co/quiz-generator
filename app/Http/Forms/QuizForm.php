<?php

namespace App\Http\Forms;

use Administr\Form\Field\RadioGroup;
use Administr\Form\Form;
use Administr\Form\FormBuilder;

class QuizForm extends Form
{
    /**
     * Define the validation rules for the form.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quiz.name'      => 'required',
            'quiz.starts_at' => 'required|before:quiz.ends_at',
            'quiz.ends_at'   => 'required|after:quiz.starts_at',
            'quiz.per_page'   => 'required|integer|min:1',
        ];
    }

    /**
     * Define the fields of the form.
     *
     * @param FormBuilder $builder
     */
    public function form(FormBuilder $builder)
    {
        $builder
            ->group('quiz', 'Quiz Data', function(FormBuilder $builder) {
                $builder
                    ->text('quiz[name]', 'Name')
                    ->datetime('quiz[starts_at]', 'Starts at')
                    ->datetime('quiz[ends_at]', 'Ends at')
                    ->number('quiz[per_page]', 'Questions per page')
                    ->radioGroup('quiz[is_anonymous]', 'Is anonymous', function(RadioGroup $group) {
                        $group->radio('yes', ['value' => 1]);
                        $group->radio('no', ['value' => 0]);
                    });
            })
            ->group('questions', 'Questions', function(FormBuilder $builder) {

            })
            ->submit('save', 'Save');;
    }
}
