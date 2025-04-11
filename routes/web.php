<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\DashboardController;
Use App\Http\Controllers\PosterminalController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalhistoryController;
use App\Http\Controllers\SalesreportController;
use App\Http\Controllers\InventoryreportController;
use App\Http\Controllers\ExpiryalertsController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard.list');
// })->middleware(['auth', 'verified'])->name('dashboard');

// // Pharmacist routes (new)

//     Route::get('/pharmacist/dashboard', [DashboardController::class, 'index']);


// Admin Dashboard (protected by auth middleware)
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('admin.dashboard.list');
    })->name('dashboard');

    // Pharmacist Dashboard
    Route::get('/pharmacist/dashboard', function () {
        if (auth()->user()->role !== 'pharmacist') {
            abort(403, 'Unauthorized');
        }
        return view('pharmacist.dashboard.list');
    })->name('pharmacist.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/saleshistory', [DashboardController::class, 'saleshistory']);

Route::get('/pharmacist-dashboard', [DashboardController::class, 'pharmacist']);

Route::resource('posterminal', PosterminalController::class);

Route::resource('medicines', MedicineController::class);

Route::resource('categories', CategoryController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('stocks', StockController::class);

Route::resource('patients', PatientController::class);

Route::resource('medicalhistories', MedicalhistoryController::class);

Route::middleware(['auth'])->group(function () {
    // Sales Reports Resource Route
    Route::resource('salesreports', SalesreportController::class)->except(['create', 'store']);

    // Additional routes for sales reports
    Route::prefix('salesreports')->group(function () {
        Route::get('/create', [SalesreportController::class, 'create'])
            ->name('salesreports.create')
            ->middleware('can:create-sales');

        Route::post('/', [SalesreportController::class, 'store'])
            ->name('salesreports.store')
            ->middleware('can:create-sales');
    });
});

Route::resource('expiryalerts', ExpiryalertsController::class);

Route::resource('inventoryreports', InventoryreportController::class);
