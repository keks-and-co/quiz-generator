<?php

namespace App\Http\Forms;

use Administr\Form\Form;
use Administr\Form\FormBuilder;

class ShareQuizForm extends Form
{
    /**
     * Define the validation rules for the form.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recepients' => 'required',
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
            ->textarea('recepients', 'Recepients', [
                'rows' => 3,
            ])
            ->submit('share', 'Share');
    }
}
