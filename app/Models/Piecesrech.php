<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piecesrech extends Model
{
    protected $fillable = ['nom_piece', 'references', 'quantity_stock', 'unit_price'];

    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class ,'piece_id', 'maintenance_id')
                    ->withPivot('maintenance_id','piece_id', 'quantity')
                    ->withTimestamps();
    }
}
