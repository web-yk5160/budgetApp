<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    public $fillable = ['description', 'amount', 'category_id', 'user_id'];

    public static function boot()
    {
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });

        static::saving(function ($transaction) {
            $transaction->user_id = $transaction->user_id ?: auth()->id();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByCategory($query, Category $category)
    {
        if($category->exists) {
            $query->where('category_id', $category->id);
        }
    }

    public function scopeByMonth ($query, $month = 'this month')
    {
        $query->where('created_at', '>=', Carbon::parse("first day of {$month}"))
            ->where('created_at', '<=', Carbon::parse("last day of {$month}"));
    }
}