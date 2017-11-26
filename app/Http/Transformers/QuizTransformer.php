<?php

namespace App\Http\Transformers;


use App\Models\Quiz;
use League\Fractal\TransformerAbstract;

class QuizTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'questions',
    ];

    public function transform(Quiz $quiz)
    {
        return [
            'id'        => (int)$quiz->id,
            'name'      => $quiz->name,
            'per_page'  => (int)$quiz->per_page,
            'is_active' => (bool)$quiz->is_active,
        ];
    }

    public function includeQuestions(Quiz $quiz)
    {
        return $this->collection($quiz->questions, new QuestionTransformer());
    }
}