<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddMedicine;
use App\Models\Stock;

class InventoryreportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all medicines with stock relationship
        $medicines = AddMedicine::with('stock')->paginate(10);;

        // Calculate total inventory value and items
        $totalValue = $medicines->sum('stock_value');
        $totalItems = $medicines->sum('quantity');

        // Return index view with medicines and totals
        return view('admin.dashboard.inventoryreport.index', compact('medicines', 'totalValue', 'totalItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch stocks for medicine_id dropdown
        $stocks = Stock::all();
        return view('admin.dashboard.inventoryreport.create', compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'supplier' => 'required|string|max:255',
            'expiry_date' => 'required|date|after:today',
            'description' => 'nullable|string',
            'medicine_id' => 'nullable|exists:stocks,id',
        ]);

        // Create new medicine
        AddMedicine::create($validated);

        // Redirect with success message
        return redirect()->route('inventoryreport.index')->with('success', 'Medicine added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch medicine with stock
        $medicine = AddMedicine::with('stock')->findOrFail($id);
        return view('admin.dashboard.inventoryreport.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch medicine and stocks
        $medicine = AddMedicine::findOrFail($id);
        $stocks = Stock::all();
        return view('admin.dashboard.inventoryreport.edit', compact('medicine', 'stocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'supplier' => 'required|string|max:255',
            'expiry_date' => 'required|date|after:today',
            'description' => 'nullable|string',
            'medicine_id' => 'nullable|exists:stocks,id',
        ]);

        // Update medicine
        $medicine = AddMedicine::findOrFail($id);
        $medicine->update($validated);

        // Redirect with success message
        return redirect()->route('inventoryreport.index')->with('success', 'Medicine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete medicine
        $medicine = AddMedicine::findOrFail($id);
        $medicine->delete();

        // Redirect with success message
        return redirect()->route('inventoryreport.index')->with('success', 'Medicine deleted successfully.');
    }


}
