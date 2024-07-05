<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'tanggal',
        'amount',
        'note',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function scopeIncomes($query){
        return $query->whereHas('category',function($query){
            $query->where('is_expense', false);
        });
    }

    public function scopeOutcomes($query){
        return $query->whereHas('category',function($query){
            $query->where('is_expense', true);
        });
    }
}
