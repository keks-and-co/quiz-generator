<?php

namespace App\Http\Forms;

use Administr\Form\Form;
use Administr\Form\FormBuilder;

class QuestionTypeForm extends Form
{
    /**
     * Define the validation rules for the form.
     *
     * @return array
     */
    public function rules()
    {
        return [
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

            ->submit('save', 'Save');
    }
}
