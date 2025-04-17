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
    // Admin Dashboard - Use the controller method that passes chart data
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Pharmacist Dashboard
Route::get('/pharmacist/dashboard', function () {
    if (auth()->user()->role !== 'pharmacist') {
        abort(403, 'Unauthorized');
    }
    // Call the controller method manually
    return app()->call('App\Http\Controllers\DashboardController@index');
})->middleware(['auth', 'verified'])->name('pharmacist.dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\SaleshistoryController;

Route::get('/saleshistory', [SaleshistoryController::class, 'index'])->name('sales.history');

Route::get('/pharmacist-dashboard', [DashboardController::class, 'pharmacist']);

Route::resource('posterminal', PosterminalController::class);

Route::post('/save-pos-data', [PosterminalController::class, 'store'])->name('posterminal.store');


Route::resource('medicines', MedicineController::class);

Route::resource('categories', CategoryController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('stocks', StockController::class);

Route::resource('patients', PatientController::class);

Route::resource('medicalhistories', MedicalhistoryController::class);

Route::resource('salesreports', SalesreportController::class);

Route::resource('expiryalerts', ExpiryalertsController::class);

Route::resource('inventoryreports', InventoryreportController::class);

Route::get('salesreport/pdf', [App\Http\Controllers\SalesreportController::class, 'generatePdf'])->name('salesreport.pdf');
Route::get('inventoryreport/pdf', [App\Http\Controllers\InventoryreportController::class, 'generatePdf'])->name('inventoryreport.pdf');
Route::get('expiryalerts/pdf', [App\Http\Controllers\ExpiryalertsController::class, 'generatePdf'])->name('expiryalerts.pdf');

//New
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/pharmacist/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('pharmacist.dashboard');
