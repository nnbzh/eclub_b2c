<?php

namespace App\Traits;

use App\Filters\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function scopeApplyFilters(Builder $builder, ModelFilter $modelFilter, array $filters): Builder
    {
        return $modelFilter->apply($builder, $filters);
    }
}
