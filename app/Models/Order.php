<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAmountFilter(Builder $query, $column, $value, $condition, $operator = "=")
    {
        $query->when($condition, function (Builder $subquery) use ($column, $value, $operator) {
            $subquery->where($column, $operator, $value);
        });
    }
}
