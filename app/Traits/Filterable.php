<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        foreach ($filters as $field => $value) {
            if (!$value) continue;

            // Search global (like title, subject, dll)
            if ($field === 'search' && isset($this->filterable)) {
                $query->where(function ($q) use ($value) {
                    foreach ($this->filterable as $col) {
                        $q->orWhere($col, 'LIKE', "%{$value}%");
                    }
                });
            }

            // Exact match filter
            elseif (in_array($field, $this->filterable ?? [])) {
                $query->where($field, $value);
            }
        }

        return $query;
    }
}
