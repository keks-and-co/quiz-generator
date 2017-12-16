<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable = ['quiz_id', 'is_finished'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
