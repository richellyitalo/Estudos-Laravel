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

    public function withdraw(float $amount) : Array
    {
        if ($this->amount < $amount) {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente'
            ];
        }

        DB::beginTransaction();

        $totalBefore = $this->amount ?: 0;
        $amount = number_format($amount, 2, '.', '');
        $this->amount -= $amount;
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $amount,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd')
        ]);

        if ($deposit && $historic) {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Saque realizado com sucesso'
            ];
        }

        DB::rollBack();

        return [
            'success' => false,
            'message' => 'Não foi possível realizar saque'
        ];
    }

    public function transfer(float $amount, User $sender) : Array
    {
        if ($this->amount < $amount) {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente'
            ];
        }
        
        DB::beginTransaction();

        /**************************************
         * Reduz o valor do saldo
         **************************************/
        $totalBefore = $this->amount ?: 0;
        $amount = number_format($amount, 2, '.', '');
        $this->amount -= $amount;
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'T',
            'amount' => $amount,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => $sender->id
        ]);

        /**************************************
         * Adicionar o valor ao recebedor
         **************************************/
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += $amount;
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([
            'type' => 'I',
            'amount' => $amount,
            'total_before' => $totalBeforeSender,
            'total_after' => $senderBalance->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => auth()->user()->id
        ]);

        if ($deposit && $historic && $transferSender && $historicSender) {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Transferência realizada com sucesso'
            ];
        }

        DB::rollBack();

        return [
            'success' => false,
            'message' => 'Não foi possível realizar transferência'
        ];
    }
}
