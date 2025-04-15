<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard.supplier.index', compact('suppliers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers,email',
            'supplier_type' => 'required|string|max:255',
        ]);

        // Create a new supplier in the database
        Supplier::create([
            'supplier_name' => $validated['supplier_name'],
            'contact_person' => $validated['contact_person'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'supplier_type' => $validated['supplier_type'],
        ]);

        // Redirect back to the suppliers list with a success message
        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
/**
 * Show the form for editing the specified resource.
 */
public function edit(string $id)
{
    // Find the supplier by ID
    $supplier = Supplier::findOrFail($id);

    // Pass the supplier to the edit view
    return view('admin.dashboard.supplier.edit', compact('supplier'));
}


    /**
     * Update the specified resource in storage.
     */
/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Find the supplier by ID
    $supplier = Supplier::findOrFail($id);

    // Validate the incoming request data
    $validated = $request->validate([
        'supplier_name' => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:suppliers,email,' . $id, // Ensure unique email, except for the current supplier
        'supplier_type' => 'required|string|max:255',
    ]);

    // Update the supplier in the database
    $supplier->update([
        'supplier_name' => $validated['supplier_name'],
        'contact_person' => $validated['contact_person'],
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'email' => $validated['email'],
        'supplier_type' => $validated['supplier_type'],
    ]);

    // Redirect back to the suppliers list with a success message
    return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    // Find the supplier by ID
    $supplier = Supplier::findOrFail($id);

    // Delete the supplier
    $supplier->delete();

    // Redirect back to the suppliers list with a success message
    return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
}

}
