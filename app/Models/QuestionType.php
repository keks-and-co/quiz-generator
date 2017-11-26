<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $fillable = [
        'name', 'slug', 'weight', 'is_active',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
