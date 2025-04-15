<?php

namespace App\Http\Controllers;

use App\Models\AddMedicine;
use App\Models\Category;
use App\Models\Posterminal;
use Illuminate\Support\Facades\Auth;
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
        // Validate incoming request
        $request->validate([
            'transactions' => 'required|array',
            'transactions.*.medicineId' => 'required|integer|exists:add_medicines,id',
            'transactions.*.categoryId' => 'required|integer|exists:categories,id',
            'transactions.*.quantity' => 'required|integer|min:1',
            'transactions.*.price' => 'required|numeric|min:0',
            'transactions.*.total' => 'required|numeric|min:0',
            'transactions.*.prescription' => 'nullable|string',
        ]);

        $transactions = $request->input('transactions');

        // Store each transaction in the posterminals table
        foreach ($transactions as $transaction) {
            Posterminal::create([
                'medicine_id' => $transaction['medicineId'],
                'category_id' => $transaction['categoryId'],
                'unit_price' => $transaction['price'],
                'quantity' => $transaction['quantity'],
                'total' => $transaction['total'],
                'prescription' => $transaction['prescription'] ?? null,
                'user_id' => Auth::id(),
            ]);
        }

        return response()->json(['message' => 'Transaction data saved successfully'], 200);
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
