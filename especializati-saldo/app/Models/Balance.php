<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Balance extends Model
{
    public $timestamps = false;
    
    // MUTATORS
    public function getAmountReadableAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }

    // RELATIONS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // FUNCTIONS
    public function deposit($amount)
    {
        dd($amount);
    }
}
