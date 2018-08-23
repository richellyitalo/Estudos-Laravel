<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Historic extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'total_before',
        'total_after',
        'user_id_transaction',
        'date'
    ];

    public function scopeUserAuth($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    // RELACIONAMENTOS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userSender()
    {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }

    // MUTATORS
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function type($type = null)
    {
        $types = [
            'I' => 'Entrada',
            'O' => 'Saída',
            'T' => 'Transação'
        ];

        if (!$type) {
            return $types;
        }

        if ($type === 'I' && $this->user_id_transaction != null) {
            return 'Recebido';
        }

        return $types[$type];
    }

    public function getAmountReadableAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }

    public function search($data, $totalPages)
    {
        return $this->where(function ($query) use ($data) {
            if (isset($data['id']))
                $query->where('id', $data['id']);

            if (isset($data['date']))
                $query->where('date', $data['date']);

            if (isset($data['type']))
                $query->where('type', $data['type']);
        })
        ->userAuth()
        ->with(['userSender'])
        ->paginate($totalPages);
    }
}
