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

    protected $fillable = [
        "user_id",
        "amount",
        "status"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAmountFilter(Builder $query, $value, $operator = "=")
    {
        $query->when(!is_null($value), function (Builder $subquery) use ($value, $operator) {
            $subquery->whereAmount($operator, $value);
        });
    }

    public function scopeStatusFilter(Builder $query, $value)
    {
        $query->when($value, function (Builder $subquery) use ($value) {
            $subquery->whereStatus($value);
        });
    }
}
