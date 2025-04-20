<?php

namespace App\Http\Controllers;

use App\Models\AddMedicine;
use App\Models\Category;
use App\Models\Posterminal;
use App\Models\Stock; 
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
    
        // Use database transaction to ensure data consistency
        \DB::beginTransaction();
        
        try {
            foreach ($transactions as $transaction) {
                // 1. Get the medicine record
                $medicine = AddMedicine::findOrFail($transaction['medicineId']);
                
                // 2. Check if sufficient quantity exists
                if ($medicine->quantity < $transaction['quantity']) {
                    throw new \Exception("Insufficient quantity for {$medicine->name}. Available: {$medicine->quantity}");
                }
                
                // 3. Reduce the quantity in add_medicines table
                $medicine->decrement('quantity', $transaction['quantity']);
                
                // 4. Reduce the quantity in stocks table (if medicine_id is the same)
                Stock::where('id', $medicine->medicine_id)
                    ->decrement('quantity', $transaction['quantity']);
                
                // 5. Create the POS transaction record
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
            
            \DB::commit();
            
            return response()->json([
                'message' => 'Transaction completed successfully',
                'remaining_quantities' => AddMedicine::whereIn('id', 
                    collect($transactions)->pluck('medicineId'))->pluck('quantity', 'id')
            ], 200);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'message' => 'Transaction failed: ' . $e->getMessage()
            ], 400);
        }
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
