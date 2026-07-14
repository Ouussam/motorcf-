<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $fillable = ['stock','categorie','brand', 'model', 'year', 'price_buy', 'price_rent_day', 'status'];

    public function rentals()
    {
        return $this->hasMany(Rentale::class);
    }

    public function sales()
    {
        return $this->hasOne(Sale::class);
    }

    public function purchases()
    {
        return $this->hasOne(Purchase::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
