<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Models\Rentale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
          $motor = Motorcycle::findOrFail($id);

            return view('rentale.create', compact('motor'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'motor_id'     => 'exists:motorcycles,id',
        'rent_days'    => 'integer|min:1',
        'start_date'   => 'date|after_or_equal:today',
    ]);
    $motor = Motorcycle::findOrFail($request->motor_id);
    $startDate = Carbon::parse($request->start_date);
     $endDate  = $startDate->copy()->addDays((int)$request->rent_days);
    $totalPrice = $motor->price_rent_day * $request->rent_days;

    if (Auth::check()) {
        $clientId = Auth::id();
        $nom      = Auth::user()->nom;
        $prenom   = Auth::user()->prenom;
    } else {
        $request->validate([
            'nom_guest'    => 'string|max:255',
            'prenom_guest' => 'string|max:255',
        ]);

        $clientId = null;
        $nom      = $request->nom_guest;
        $prenom   = $request->prenom_guest;
    }
    Rentale::create([
        'motor_id'     => $motor->id,
        'client_id'    => $clientId,
        'nom_guets'    => $nom,
        'prenom_guets' => $prenom,
        'start_date'   => $startDate,
        'end_date'     => $endDate,
        'total_price'  => $totalPrice,
        'status'       => 'pending',
    ]);

    return redirect()->route('index')->with('success', 'Votre demande de location a bien été envoyée en tant qu\'invité.');
}

    /**
     * Display the specified resource.
     */
    public function show(Rentale $rentale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rentale $rentale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rentale $rentale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rentale $rentale)
    {
        //
    }
    public function trackForm()
{
    return view('rentale.track');
}

public function trackResult(Request $request)
{
    $request->validate([
        'nom_guets' => 'required|string',
    ]);
    
    $rent = Rentale::where('nom_guets', $request->nom_guets)->get();
    return view('rentale.track_results', compact('rent'));
}
}
