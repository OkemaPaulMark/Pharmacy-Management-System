<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosterminalController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalhistoryController;
use App\Http\Controllers\SalesreportController;
use App\Http\Controllers\InventoryreportController;
use App\Http\Controllers\ExpiryalertsController;
use App\Http\Controllers\SaleshistoryController;

// Public Routes
Route::get('/', function () {
    return view('auth.login');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pharmacist/dashboard', [DashboardController::class, 'index'])->name('pharmacist.dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Routes
    Route::resource('posterminal', PosterminalController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('medicalhistories', MedicalhistoryController::class);
    Route::resource('salesreports', SalesreportController::class);
    Route::resource('expiryalerts', ExpiryalertsController::class);
    Route::resource('inventoryreports', InventoryreportController::class);

    // Custom Routes
    Route::post('/save-pos-data', [PosterminalController::class, 'store'])->name('posterminal.store');
    Route::get('/saleshistory', [SaleshistoryController::class, 'index'])->name('sales.history');

});

// Authentication Routes
require __DIR__.'/auth.php';
