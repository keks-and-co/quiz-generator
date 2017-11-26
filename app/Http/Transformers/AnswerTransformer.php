<?php

namespace App\Http\Transformers;


use App\Models\QuestionAnswer;
use League\Fractal\TransformerAbstract;

class AnswerTransformer extends TransformerAbstract
{
    public function transform(QuestionAnswer $answer)
    {
        return [
            'id'    => (int)$answer->id,
            'value' => $answer->value,
        ];
    }
}