<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'name',
        'colocation_id',
        'payer_id',
        'category_id',
        'title',
        'amount',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function splits()
    {
        return $this->hasMany(ExpenseDetail::class);
    }

}
