<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Supplier;

class ExpiryalertsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all stock records with their supplier relationship
        // Removed category relationship loading
        $stocks = Stock::with('supplier')->paginate(10);
        return view('admin.dashboard.expiryalert.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all suppliers for dropdown
        // Removed categories fetching
        $suppliers = Supplier::all();
        return view('admin.dashboard.expiryalert.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        // Removed category_id validation
        $validated = $request->validate([
            'medicine' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'required|date|after:today',
            'unit_cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date|before_or_equal:today',
        ]);

        // Create a new stock entry
        Stock::create($validated);

        // Redirect to index with success message
        return redirect()->route('expiryalerts.index')->with('success', 'Stock added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the stock with its supplier
        // Removed category relationship
        $stock = Stock::with('supplier')->findOrFail($id);
        return view('admin.dashboard.expiryalert.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the stock and suppliers
        // Removed categories fetching
        $stock = Stock::findOrFail($id);
        $suppliers = Supplier::all();
        return view('admin.dashboard.expiryalert.edit', compact('stock', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        // Removed category_id validation
        $validated = $request->validate([
            'medicine' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'required|date|after:today',
            'unit_cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date|before_or_equal:today',
        ]);

        // Update the stock entry
        $stock = Stock::findOrFail($id);
        $stock->update($validated);

        // Redirect to index with success message
        return redirect()->route('expiryalerts.index')->with('success', 'Stock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the stock entry
        $stock = Stock::findOrFail($id);
        $stock->delete();

        // Redirect to index with success message
        return redirect()->route('expiryalerts.index')->with('success', 'Stock deleted successfully.');
    }
w
}
