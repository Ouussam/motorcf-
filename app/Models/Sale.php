<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
protected $fillable = [
    'sale_date',
    'sale_price',
    'status',
    'nom_guest',
    'prenom_guest',
    'adress',
    'client_id',
    'motor_id'
];
    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motorcycle::class);
    }
}
