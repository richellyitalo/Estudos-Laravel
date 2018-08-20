<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\DB;

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
    public function deposit(float $amount) : Array
    {
        DB::beginTransaction();

        $totalBefore = $this->amount ?: 0;
        $amount = number_format($amount, 2, '.', '');
        $this->amount += $amount;
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $amount,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd')
        ]);

        if ($deposit && $historic) {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Recarga realizada com sucesso'
            ];
        }

        DB::rollBack();

        return [
            'success' => false,
            'message' => 'Não foi possível realizar recarga'
        ];
    }
}
