<?php

namespace App\QueryFilters;

use Administr\QueryFilters\Filter;
use App\Http\ListViews\QuizzesListView;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class QuizzesFilter extends Filter
{
    public function name($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }

    public function startsAt($value)
    {
        try {
            return $this->builder->whereBetween('starts_at', [
                Carbon::parse($value)->startOfDay(),
                Carbon::parse($value)->endOfDay(),
            ]);
        } catch (\Exception $e) {
            return $this->builder;
        }
    }

    public function endsAt($value)
    {
        try {
            return $this->builder->whereBetween('ends_at', [
                Carbon::parse($value)->startOfDay(),
                Carbon::parse($value)->endOfDay(),
            ]);
        } catch (\Exception $e) {
            return $this->builder;
        }
    }
}