<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

public function create($motor_id)
{
    $motor = Motorcycle::findOrFail($motor_id);

    return view('sales.create', compact('motor'));
}

  public function store(Request $request)
{
    $request->validate([
        'sale_date'    => 'required|date',
        'nom_guest'    => 'required|string|max:255',
        'prenom_guest' => 'required|string|max:255',
        'adress'       => 'required|string|max:255',
        'motor_id'     => 'required|exists:motorcycles,id',
    ]);
    $motor = Motorcycle::findOrFail($request->motor_id);
    Sale::create([
        'sale_date'    => $request->sale_date,
        'sale_price'   => $motor->price_buy,
        'status'       => 'pending',
        'nom_guest'    => Auth::check() ? Auth::user()->nom : $request->nom_guest,
        'prenom_guest' => Auth::check() ? Auth::user()->prenom : $request->prenom_guest,
        'adress'       => $request->adress,
        'client_id'    =>Auth::check() ? Auth::user()->id : null,
        'motor_id'     => $motor->id,
    ]);

    return redirect()->route('index')->with('success', 'Motor bought successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
