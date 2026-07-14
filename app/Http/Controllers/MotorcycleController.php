<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    $query = Motorcycle::query();

    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('brand', 'like', '%' . $request->search . '%')
              ->orWhere('model', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('brand')) {
        $query->where('brand', $request->brand);
    }

    if ($request->filled('category')) {
        $query->where('categorie', $request->category); // تأكدت من سمية الحقل 'categorie' كيف كاين فـ الـ view عندك
    }

    if ($request->filled('price')) {
        if ($request->price == 'low') {
            $query->orderBy('price_buy', 'asc');
        } else {
            $query->orderBy('price_buy', 'desc');
        }
    }

    $motorcycle = $query->paginate(6);
    $brand = Motorcycle::distinct()->pluck('categorie');
    
    return view('accuile', compact('motorcycle', 'brand'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'price_buy' => 'required|integer',
            'price_rent_day' => 'required|integer',
            'categorie' => 'required',
            'photo' => 'required',
        ]);
        if($req->hasFile('photo')){
            $photo = time() . '.' . $req->photo->extension();

    $req->photo->storeAs(
        'motos',
        $photo,
        'public'
    );

             
        }
        Motorcycle::create([
            'brand' => $req->brand,
            'model' => $req->model,
            'year' => $req->year,
            'price_buy'=>$req->price_buy,
            'categorie'=>$req->categorie,
            'price_rent_day'=>$req->price_rent_day,
            'stock'=>$req->stock,
            'status'=>$req->status,
            'photo'=>$photo

    
        ]);
        return to_route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motorcycle $motorcycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motorcycle $motorcycle)
    {
        //
    }
}
