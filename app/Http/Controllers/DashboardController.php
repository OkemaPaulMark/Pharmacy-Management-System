<?php
// File: app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posterminal;
use App\Models\AddMedicine;
use App\Models\Stock;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key metrics and charts.
     */
    public function dashboard(Request $request)
    {
        try {
            // Today's Sales: Count Posterminal records for today (April 16, 2025)
            $todaySales = Posterminal::whereDate('created_at', Carbon::today())->count();

            // Low-Stock Items: Count medicines with quantity between 50 and 99
            $lowStockItems = AddMedicine::whereBetween('quantity', [50, 99])->count();

            // Expiring Soon: Count stocks expiring between today and May 16, 2025
            $expiringSoon = Stock::where('expiry_date', '<=', Carbon::today()->addDays(180))
                ->where('expiry_date', '>=', Carbon::today())
                ->count();

            // Total Stocks: Count all medicines
            $totalStocks = Stock::count();

            // Chart Data
            $stocks = Stock::with('supplier')->get();

            // Bar Chart: Medicine Quantities
            $barLabels = $stocks->pluck('medicine')->toArray();
            $barData = $stocks->pluck('quantity')->toArray();

            // Pie Chart: Stock by Supplier
            $pieData = $stocks->groupBy('supplier_id')->map(function ($items) {
                return $items->sum('quantity');
            });
            $pieLabels = Supplier::whereIn('id', $pieData->keys())->pluck('supplier_name')->toArray();
            $pieData = $pieData->values()->toArray();

            // Line Chart: Stock Expiry Timeline
            $lineData = $stocks->groupBy('expiry_date')->map(function ($items) {
                return $items->sum('quantity');
            });
            $lineLabels = $lineData->keys()->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })->toArray();
            $lineData = $lineData->values()->toArray();

            // Log variables for debugging
            Log::info('Admin Dashboard Variables', [
                'todaySales' => $todaySales,
                'lowStockItems' => $lowStockItems,
                'expiringSoon' => $expiringSoon,
                'totalStocks' => $totalStocks,
                'barLabels_count' => count($barLabels),
                'pieLabels_count' => count($pieLabels),
                'lineLabels_count' => count($lineLabels)
            ]);

            // Return admin dashboard view with metrics and chart data
            return view('admin.dashboard.list', compact(
                'todaySales', 'lowStockItems', 'expiringSoon', 'totalStocks',
                'barLabels', 'barData', 'pieLabels', 'pieData', 'lineLabels', 'lineData'
            ));
        } catch (\Exception $e) {
            // Log error and return fallback view
            Log::error('Admin Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard.list', [
                'todaySales' => 0,
                'lowStockItems' => 0,
                'expiringSoon' => 0,
                'totalStocks' => 0,
                'barLabels' => [],
                'barData' => [],
                'pieLabels' => [],
                'pieData' => [],
                'lineLabels' => [],
                'lineData' => [],
                'error' => 'Failed to load dashboard metrics: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the pharmacist dashboard with key metrics and charts.
     */
    public function index(Request $request)
    {
        try {
            // Today's Sales: Count Posterminal records for today (April 16, 2025)
            $todaySales = Posterminal::whereDate('created_at', Carbon::today())->count();

            // Low-Stock Items: Count medicines with quantity between 50 and 99
            $lowStockItems = AddMedicine::whereBetween('quantity', [50, 99])->count();

            // Expiring Soon: Count stocks expiring between today and May 16, 2025
            $expiringSoon = Stock::where('expiry_date', '<=', Carbon::today()->addDays(180))
                ->where('expiry_date', '>=', Carbon::today())
                ->count();

            // Total Stocks: Count all medicines
            $totalStocks = Stock::count();

            // Chart Data
            $stocks = Stock::with('supplier')->get();

            // Bar Chart: Medicine Quantities
            $barLabels = $stocks->pluck('medicine')->toArray();
            $barData = $stocks->pluck('quantity')->toArray();

            // Pie Chart: Stock by Supplier
            $pieData = $stocks->groupBy('supplier_id')->map(function ($items) {
                return $items->sum('quantity');
            });
            $pieLabels = Supplier::whereIn('id', $pieData->keys())->pluck('supplier_name')->toArray();
            $pieData = $pieData->values()->toArray();

            // Line Chart: Stock Expiry Timeline
            $lineData = $stocks->groupBy('expiry_date')->map(function ($items) {
                return $items->sum('quantity');
            });
            $lineLabels = $lineData->keys()->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })->toArray();
            $lineData = $lineData->values()->toArray();

            // Log variables for debugging
            Log::info('Pharmacist Dashboard Variables', [
                'todaySales' => $todaySales,
                'lowStockItems' => $lowStockItems,
                'expiringSoon' => $expiringSoon,
                'totalStocks' => $totalStocks,
                'barLabels_count' => count($barLabels),
                'pieLabels_count' => count($pieLabels),
                'lineLabels_count' => count($lineLabels)
            ]);

            // Return pharmacist dashboard view with metrics and chart data
            return view('pharmacist.dashboard.list', compact(
                'todaySales', 'lowStockItems', 'expiringSoon', 'totalStocks',
                'barLabels', 'barData', 'pieLabels', 'pieData', 'lineLabels', 'lineData'
            ));
        } catch (\Exception $e) {
            // Log error and return fallback view
            Log::error('Pharmacist Dashboard Error: ' . $e->getMessage());
            return view('pharmacist.dashboard.list', [
                'todaySales' => 0,
                'lowStockItems' => 0,
                'expiringSoon' => 0,
                'totalStocks' => 0,
                'barLabels' => [],
                'barData' => [],
                'pieLabels' => [],
                'pieData' => [],
                'lineLabels' => [],
                'lineData' => [],
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
