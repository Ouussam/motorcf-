<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rentale extends Model
{
    protected $fillable = ['start_date', 'end_date', 'total_price', 'status', 'prenom_guets', 'nom_guets', 'client_id', 'motor_id'];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motorcycle::class);
    }
}
