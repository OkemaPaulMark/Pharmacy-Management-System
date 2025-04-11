<?php

namespace App\Http\Controllers;

use App\Models\AddMedicine;
use App\Models\Category;
use App\Models\PosTransaction;
use Illuminate\Http\Request;

class PosterminalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = AddMedicine::with('category')->get();
        $categories = Category::all();
        
        return view('pharmacist.dashboard.posterminal.index', compact('medicines', 'categories'));
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
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'prescription' => 'nullable|string',
        ]);

        $transaction = PosTerminal::create([
            'medicine_id' => $request->medicine_id,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total' => $request->total,
            'prescription' => $request->prescription,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => true, 'transaction' => $transaction]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
