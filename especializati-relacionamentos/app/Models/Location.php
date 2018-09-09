<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
        // Para colunas de relacionamento diferentes
        // return $this->belongsTo(Country::class, 'nome_coluna_ligacao', 'nome_coluna_ID');
    }
}
