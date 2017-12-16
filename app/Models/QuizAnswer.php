<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable = ['quiz_id', 'started_at', 'finished_at'];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected $appends = [
        'is_finished',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getIsFinishedAttribute()
    {
        return ! is_null($this->finished_at);
    }
}
