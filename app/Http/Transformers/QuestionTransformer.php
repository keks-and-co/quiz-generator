<?php

namespace App\Http\Transformers;


use App\Models\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'question_type', 'answers',
    ];

    public function transform(Question $question)
    {
        return [
            'id'    => (int)$question->id,
            'value' => $question->value,
        ];
    }

    public function includeQuestionType(Question $question)
    {
        return $this->item($question->type, new QuestionTypeTransformer());
    }

    public function includeAnswers(Question $question)
    {
        return $this->collection($question->answers, new AnswerTransformer());
    }
}