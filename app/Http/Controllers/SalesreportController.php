<?php

namespace App\Http\Controllers;

use App\Models\Posterminal;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SalesreportController extends Controller
{
    /**
     * Display a listing of the sales reports.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sales = Posterminal::with(['medicine', 'category', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $totalSales = $sales->sum('total');

        return view('admin.dashboard.salesreport.index', compact('sales', 'totalSales'));
    }

    /**
     * Show the form for creating a new sale record.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $medicines = Medicine::with('category')->get();
        return view('admin.dashboard.salesreport.create', compact('medicines'));
    }

    /**
     * Store a newly created sale record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:add_medicines,id',
            'category_id' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0.01',
            'prescription' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = auth()->id();

        Posterminal::create($validated);

        return redirect()->route('salesreports.index')
            ->with('success', 'Sale recorded successfully!');
    }

    /**
     * Display the specified sale record.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $sale = Posterminal::with(['medicine', 'category', 'user'])
            ->findOrFail($id);

        return view('admin.dashboard.salesreport.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified sale record.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $sale = Posterminal::findOrFail($id);
        Gate::authorize('update', $sale);

        $medicines = Medicine::with('category')->get();
        return view('admin.dashboard.salesreport.edit', compact('sale', 'medicines'));
    }

    /**
     * Update the specified sale record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $sale = Posterminal::findOrFail($id);
        Gate::authorize('update', $sale);

        $validated = $request->validate([
            'medicine_id' => 'required|exists:add_medicines,id',
            'category_id' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0.01',
            'prescription' => 'nullable|string|max:500',
        ]);

        $sale->update($validated);

        return redirect()->route('salesreports.index')
            ->with('success', 'Sale updated successfully!');
    }

    /**
     * Remove the specified sale record from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $sale = Posterminal::findOrFail($id);
        Gate::authorize('delete', $sale);

        $sale->delete();

        return redirect()->route('salesreports.index')
            ->with('success', 'Sale record deleted successfully!');
    }

    /**
     * Export sales report to PDF/Excel
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function export()
    {
        $sales = Posterminal::with(['medicine', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSales = $sales->sum('total');

        // Implementation for exporting would go here
        // Typically using Laravel Excel or similar package

        // For now, we'll return a response
        return response()->json([
            'message' => 'Export functionality will be implemented here',
            'data' => $sales,
            'total' => $totalSales
        ]);
    }
}
