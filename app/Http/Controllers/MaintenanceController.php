<?php
namespace App\Http\Controllers;
use App\Models\Maintenance;
use App\Models\Motorcycle;
use App\Models\Piecesrech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{

    public function index()
    {
        $maintenances = Maintenance::with('motor', 'pieces')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $motors = Motorcycle::all();
        $pieces = Piecesrech::all();

        return view('maintenance.create', compact('motors', 'pieces'));
    }
    public function store(Request $request)
    {
         $motor = Motorcycle::where('brand', $request->brand)
                        ->where('model', $request->model)
                        ->first();
        $request->validate([
            'description' => 'required|string',

        ]);
        $maintenance = Maintenance::create([
            'description' => $request->description,
            'status' => 'pending',
            'motor_id'     => $motor ? $motor->id : null, // كيشوف يلا لقى الموتور كياخد id ديالو، يلا مالقاهش كيحط null
            'nom_guets' => Auth::check() ? Auth::user()->nom : $request->nom_guets,
            'prenom_guets' => Auth::check() ? Auth::user()->prenom : $request->prenom_guets,
            'phone' => $request->phone,
            'cost'         => 0,
            'start_date'   => null,
            'end_date'=>null,
        ]);
        if ($request->pieces) {
            $maintenance->pieces()->attach($request->pieces);
        }

        if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.maintenance.index')->with('success', 'Maintenance créée avec succès par l\'Admin.');
        }
        return redirect()->route('index')->with('success', 'Votre demande de maintenance a été enregistrée.');
    }

    return redirect()->route('index')->with('success', 'Votre demande de maintenance a bien été envoyée en tant qu\'invité.');
    }
    public function show(Maintenance $maintenance)
    {
        $maintenance->load('motor', 'pieces');

        return view('maintenance.show', compact('maintenance'));
    }
    public function edit(Maintenance $maintenance)
    {
        $motors = Motorcycle::all();
        $pieces = Piecesrech::all();

        return view('admin.maintenance.edit', compact('maintenance', 'motors', 'pieces'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'cost' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'pieces' => 'nullable|array',
        ]);

        $maintenance->update([
            'description' => $request->description,
            'status' => $request->status,
            'cost' => $request->cost,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // sync pieces (important)
        if ($request->pieces) {
            $maintenance->pieces()->sync($request->pieces);
        }

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance updated successfully');
    }

 

public function trackForm()
{
    return view('maintenance.track'); 
}

public function trackResult(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
    ]);
    
    $maintenances = Maintenance::where('phone', $request->phone)
                                ->latest()
                                ->get();

    return view('maintenance.track_results', compact('maintenances'));
}
}