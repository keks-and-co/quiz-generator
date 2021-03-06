<?php

namespace App\Models;

use Administr\QueryFilters\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use Filterable;

    protected $fillable = [
        'user_id', 'per_page', 'name', 'starts_at', 'ends_at', 'is_anonymous',
    ];

    protected $appends = [
        'is_active',
    ];

    protected $casts = [
        'starts_at'    => 'datetime',
        'ends_at'      => 'datetime',
        'is_active'    => 'boolean',
        'is_anonymous' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getIsActiveAttribute()
    {
        return Carbon::now()->between($this->starts_at, $this->ends_at);
    }
}
