<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Motorcycle;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function index()
    {
         $maintenances = Maintenance::all();
            $motorcycles=Motorcycle::all();
            $suplier=Supplier::all();
            $user=User::where('role', '!=', 'admin')->get();
            return view('admin.index', compact('maintenances',
        'motorcycles',
        'suplier',
        'user'
    ));

    }
    public function destroy($id)
{
    $maintenance = Maintenance::findOrFail($id);
    $maintenance->delete();

    return back()->with('success', 'Deleted successfully');
}

}
