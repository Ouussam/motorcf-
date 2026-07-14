<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchase_date', 'purchase_price', 'qte', 'supplier_id', 'motor_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function Motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }
}
