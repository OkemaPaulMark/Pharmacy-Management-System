<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddMedicine; 
use App\Models\Stock;
use App\Models\Category; 
use App\Models\Supplier; 

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = AddMedicine::orderBy('created_at', 'desc')->paginate(3);
        $stocks = Stock::with('medicine')->get();
        $categories = Category::all();
        $suppliers = Supplier::all();
        
        return view('admin.dashboard.medicine.index', compact(
            'medicines', 
            'stocks', 
            'categories', 
            'suppliers'
        ));
    }

    // public function create()
    // {
    //     $categories = Category::all(); // Fetch all categories
    //     return view('medicines.create', compact('categories')); // Pass categories to the view
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medicine_id' => 'required|exists:stocks,id',
            'category' => 'required|exists:categories,id', // Validate category ID exists
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'supplier' => 'required|exists:suppliers,id',
            'expiry_date' => 'required|date|after:today',
            'description' => 'nullable|string',
        ]);
    
        $stock = Stock::findOrFail($request->medicine_id);
        $category = Category::findOrFail($request->category);
        $supplier = Supplier::findOrFail($request->supplier);
    
        AddMedicine::create([
            'name' => $stock->medicine,
            'category_id' => $category->id, // Store the category ID
            'category' => $category->category, // Also store the category name
            'unit_price' => $request->unit_price,
            'quantity' => $request->quantity,
            'supplier_id' => $supplier->id, // Store the supplier ID
            'supplier' => $supplier->supplier_name, // Also store the supplier name
            'expiry_date' => $request->expiry_date,
            'description' => $request->description,
            'medicine_id' => $request->medicine_id,
        ]);
    
        return redirect()->route('medicines.index')
                         ->with('success', 'Medicine added successfully!');
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
    public function edit(string $id)
    {
        $medicine = AddMedicine::findOrFail($id);
        $stocks = Stock::with('medicine')->get();
        $categories = Category::all();
        $suppliers = Supplier::all();
        
        return view('admin.dashboard.medicine.edit', compact(
            'medicine',
            'stocks',
            'categories',
            'suppliers'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'medicine_id' => 'required|exists:stocks,id',
            'category' => 'required|exists:categories,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'supplier' => 'required|exists:suppliers,id',
            'expiry_date' => 'required|date|after:today',
            'description' => 'nullable|string',
        ]);

        $medicine = AddMedicine::findOrFail($id);
        $stock = Stock::findOrFail($request->medicine_id);
        $category = Category::findOrFail($request->category);
        $supplier = Supplier::findOrFail($request->supplier);

        $medicine->update([
            'name' => $stock->medicine,
            'category_id' => $category->id,
            'category' => $category->category,
            'unit_price' => $request->unit_price,
            'quantity' => $request->quantity,
            'supplier_id' => $supplier->id,
            'supplier' => $supplier->supplier_name,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description,
            'medicine_id' => $request->medicine_id,
        ]);

        return redirect()->route('medicines.index')
                         ->with('success', 'Medicine updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicine = AddMedicine::findOrFail($id);
        $medicineName = $medicine->name;
        
        $medicine->delete();
        
        return redirect()->route('medicines.index')
                         ->with('success', "Medicine '$medicineName' has been deleted successfully!");
    }
}
