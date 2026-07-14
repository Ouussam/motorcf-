<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\PieceRechange;
use App\Models\Piecesrech;
use Illuminate\Http\Request;

class MechanicControlle extends Controller
{
    public function index()
{
    return view('michanic.index', ['maintenances' => Maintenance::with('motor')->get(), 'pieces' => Piecesrech::all(),
    ]);
}
public function accept(Request $request, $id)
{
    $maintenance = Maintenance::findOrFail($id);

    $maintenance->update([
        'status' => 'accepted',
        'cost' => $request->cost,
    ]);

   
    return back();
}
public function refuse($id)
{
    Maintenance::findOrFail($id)->update([
        'status' => 'refused'
    ]);

    return back();
}
}