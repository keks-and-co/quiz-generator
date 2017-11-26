<?php

namespace App\Http\Transformers;


use App\Models\QuestionType;
use League\Fractal\TransformerAbstract;

class QuestionTypeTransformer extends TransformerAbstract
{
    public function transform(QuestionType $type)
    {
        return [
            'type' => $type->slug,
        ];
    }
}