<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posterminal;
use App\Models\AddMedicine;
use App\Models\Stock;
use App\Models\Supplier;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key metrics and charts.
     */
    public function dashboard(Request $request)
    {
        // Today's Sales (Sum of unit_price)
        $todaySales = Posterminal::whereDate('created_at', Carbon::today())->sum('unit_price');

        // Low-Stock Items
        $lowStockItems = AddMedicine::whereBetween('quantity', [50, 99])->count();

        // Expiring Soon
        $expiringSoon = Stock::where('expiry_date', '<=', Carbon::today()->addDays(180))
            ->where('expiry_date', '>=', Carbon::today())
            ->count();

        // Total Stocks
        $totalStocks = Stock::count();

        // Chart Data
        $stocks = Stock::with('supplier')->get();

        // Prepare chart data
        $chartData = $this->prepareChartData($stocks);

        return view('admin.dashboard.list', array_merge([
            'todaySales' => $todaySales,
            'lowStockItems' => $lowStockItems,
            'expiringSoon' => $expiringSoon,
            'totalStocks' => $totalStocks
        ], $chartData));
    }

    /**
     * Display the pharmacist dashboard with key metrics and charts.
     */
    public function index(Request $request)
    {
        // Today's Sales (Sum of unit_price)
        $todaySales = Posterminal::whereDate('created_at', Carbon::today())->sum('unit_price');

        // Low-Stock Items
        $lowStockItems = AddMedicine::whereBetween('quantity', [50, 99])->count();

        // Expiring Soon
        $expiringSoon = Stock::where('expiry_date', '<=', Carbon::today()->addDays(180))
            ->where('expiry_date', '>=', Carbon::today())
            ->count();

        // Total Stocks
        $totalStocks = Stock::count();

        // Chart Data
        $stocks = Stock::with('supplier')->get();

        // Prepare chart data
        $chartData = $this->prepareChartData($stocks);

        return view('pharmacist.dashboard.list', array_merge([
            'todaySales' => $todaySales,
            'lowStockItems' => $lowStockItems,
            'expiringSoon' => $expiringSoon,
            'totalStocks' => $totalStocks
        ], $chartData));
    }

    /**
     * Prepare chart data from stocks collection
     */
    private function prepareChartData($stocks)
    {
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

        return [
            'barLabels' => $barLabels,
            'barData' => $barData,
            'pieLabels' => $pieLabels,
            'pieData' => $pieData,
            'lineLabels' => $lineLabels,
            'lineData' => $lineData
        ];
    }

    /**
     * Display the sales history page.
     */
    public function saleshistory(Request $request)
    {
        return view('pharmacist.dashboard.saleshistory');
    }
}
