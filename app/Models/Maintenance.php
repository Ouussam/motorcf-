<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
protected $fillable = ['description', 'status', 'motor_id', 'nom_guets', 'prenom_guets', 'phone', 'cost'];
    public function motor()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    // Relation Many-to-Many m3a l-pièces de rechange via table pivot
    public function pieces()
    {
        return $this->belongsToMany(Piecesrech::class, 'maintenance_id', 'piece_id')
                    ->withPivot('maintenance_id','piece_id', 'quantity')
                    ->withTimestamps();
    }
}
