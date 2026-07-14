<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MechanicControlle;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\RentaleController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

// motor afichage on accuiel
route::get('/', [MotorcycleController::class, 'index'])->name('index');
route::get('/moto/create', [MotorcycleController::class, 'create'])->name('moto.create');
route::post('/store', [MotorcycleController::class, 'store'])->name('admin.store');
// authcontoller
Route::get('/showLogin', [AuthController::class, 'showLogin'])->name('showLogin');
Route::get('/create', [AuthController::class, 'create'])->name('rego.create');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');



route::get('/main.create', [MaintenanceController::class, 'create'])->name('main.create');
Route::post('/main.store', [MaintenanceController::class, 'store'])->name('main.store');
Route::get('/maintenance.track.form', [MaintenanceController::class, 'trackForm'])->name('maintenance.track.form');
Route::post('/track-maintenance', [MaintenanceController::class, 'trackResult'])->name('maintenance.track.result');


Route::get('/sales/create/{motor}', [SaleController::class, 'create'])->name('sales.create');
Route::post('/sales/store', [SaleController::class, 'store'])->name('sales.store');

Route::get('/rentale/create/{id}', [RentaleController::class, 'create'])->name('rentale.create');
Route::post('/rentale/store', [RentaleController::class, 'store'])->name('rentale.store');
Route::get('/rentale.track.form', [RentaleController::class, 'trackForm'])->name('rentale.track.form');
Route::post('/track-rentale', [RentaleController::class, 'trackResult'])->name('rentale.track.result');


Route::get('/mechanic/maintenances', [MechanicControlle ::class, 'index'])->name('mecanicien.maintenance.index')->middleware('auth');
Route::PUT('mechanic.accept/{id}', [MechanicControlle ::class, 'accept'])->name('mechanic.accept');
Route::PUT('mechanic.refuse/{id}', [MechanicControlle ::class, 'refuse'])->name('mechanic.refuse');

Route::get('/admin/index', [AdminController ::class, 'index'])->name('admin.index')->middleware('auth');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');



