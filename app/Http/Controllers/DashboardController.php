<?php
// File: app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posterminal;
use App\Models\AddMedicine;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key metrics.
     */
    public function dashboard(Request $request)
    {
        try {
            // Today's Sales: Count Posterminal records for today (April 16, 2025)
            $todaySales = Posterminal::whereDate('created_at', Carbon::today())->count();

            // Low-Stock Items: Count medicines with quantity between 50 and 99
            $lowStockItems = AddMedicine::whereBetween('quantity', [50, 99])->count();

            // Expiring Soon: Count stocks expiring between today and May 16, 2025
            $expiringSoon = Stock::where('expiry_date', '<=', Carbon::today()->addDays(30))
                ->where('expiry_date', '>=', Carbon::today())
                ->count();

            // Total Stocks: Count all medicines
            $totalStocks = AddMedicine::count();

            // Log variables for debugging
            Log::info('Admin Dashboard Variables', [
                'todaySales' => $todaySales,
                'lowStockItems' => $lowStockItems,
                'expiringSoon' => $expiringSoon,
                'totalStocks' => $totalStocks
            ]);

            // Return admin dashboard view with metrics
            return view('admin.dashboard.list', compact('todaySales', 'lowStockItems', 'expiringSoon', 'totalStocks'));
        } catch (\Exception $e) {
            // Log error and return fallback view
            Log::error('Admin Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard.list', [
                'todaySales' => 0,
                'lowStockItems' => 0,
                'expiringSoon' => 0,
                'totalStocks' => 0,
                'error' => 'Failed to load dashboard metrics: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the pharmacist dashboard with key metrics.
     */
    public function index(Request $request)
    {
        try {
            // Today's Sales: Count Posterminal records for today (April 16, 2025)
            $todaySales = Posterminal::whereDate('created_at', Carbon::today())->count();

            // Low-Stock Items: Count medicines with quantity between 50 and 99
            $lowStockItems = AddMedicine::whereBetween('quantity', [50, 99])->count();

            // Expiring Soon: Count stocks expiring between today and May 16, 2025
            $expiringSoon = Stock::where('expiry_date', '<=', Carbon::today()->addDays(30))
                ->where('expiry_date', '>=', Carbon::today())
                ->count();

            // Total Stocks: Count all medicines
            $totalStocks = AddMedicine::count();

            // Log variables for debugging
            Log::info('Pharmacist Dashboard Variables', [
                'todaySales' => $todaySales,
                'lowStockItems' => $lowStockItems,
                'expiringSoon' => $expiringSoon,
                'totalStocks' => $totalStocks
            ]);

            // Return pharmacist dashboard view with metrics
            return view('pharmacist.dashboard.list', compact('todaySales', 'lowStockItems', 'expiringSoon', 'totalStocks'));
        } catch (\Exception $e) {
            // Log error and return fallback view
            Log::error('Pharmacist Dashboard Error: ' . $e->getMessage());
            return view('pharmacist.dashboard.list', [
                'todaySales' => 0,
                'lowStockItems' => 0,
                'expiringSoon' => 0,
                'totalStocks' => 0,
                'error' => 'Failed to load dashboard metrics: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the sales history page.
     */
    public function saleshistory(Request $request)
    {
        return view('pharmacist.dashboard.saleshistory');
    }
}
