<?php

namespace App\Http\Controllers;

use App\Models\Posterminal;
use Illuminate\Http\Request;

class SalesreportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Posterminal::getSalesReport();
        $totalSales = $sales->sum('total');

        return view('admin.dashboard.salesreport.index', compact('sales', 'totalSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.salesreport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:add_medicines,id',
            'category_id' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'prescription' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        Posterminal::create($validated);

        return redirect()->route('salesreports.index')
            ->with('success', 'Sale recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Posterminal::with(['medicine', 'category', 'user'])->findOrFail($id);
        return view('admin.dashboard.salesreport.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sale = Posterminal::findOrFail($id);
        return view('admin.dashboard.salesreport.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sale = Posterminal::findOrFail($id);

        $validated = $request->validate([
            'medicine_id' => 'required|exists:add_medicines,id',
            'category_id' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'prescription' => 'nullable|string',
        ]);

        $sale->update($validated);

        return redirect()->route('salesreports.index')
            ->with('success', 'Sale updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Posterminal::findOrFail($id);
        $sale->delete();

        return redirect()->route('salesreports.index')
            ->with('success', 'Sale record deleted successfully!');
    }
}
