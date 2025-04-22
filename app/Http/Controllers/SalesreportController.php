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
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all transactions with related medicine
        $transactions = Posterminal::with('medicine')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // or any number of items per page
    

        // Calculate total sales
        $totalSales = $transactions->sum('total');

        // Return the sales report index view with transactions and total sales
        return view('admin.dashboard.salesreport.index', [
            'transactions' => $transactions,
            'totalSales' => $totalSales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all medicines for dropdown
        $medicines = Medicine::all();
        return view('admin.dashboard.salesreport.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'created_at' => 'required|date',
        ]);

        // Calculate total
        $validated['total'] = $validated['unit_price'] * $validated['quantity'];

        // Create a new transaction
        Posterminal::create($validated);

        // Redirect to index with success message
        return redirect()->route('salesreport.index')->with('success', 'Transaction added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the transaction with its medicine
        $transaction = Posterminal::with('medicine')->findOrFail($id);
        return view('admin.dashboard.salesreport.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the transaction and medicines
        $transaction = Posterminal::findOrFail($id);
        $medicines = Medicine::all();
        return view('admin.dashboard.salesreport.edit', compact('transaction', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'created_at' => 'required|date',
        ]);

        // Calculate total
        $validated['total'] = $validated['unit_price'] * $validated['quantity'];

        // Update the transaction
        $transaction = Posterminal::findOrFail($id);
        $transaction->update($validated);

        // Redirect to index with success message
        return redirect()->route('salesreport.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the transaction
        $transaction = Posterminal::findOrFail($id);
        $transaction->delete();

        // Redirect to index with success message
        return redirect()->route('salesreport.index')->with('success', 'Transaction deleted successfully.');
    }

    public function generatePDF()
    {
        $transactions = Posterminal::with('medicine')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSales = $transactions->sum('total');

        $pdf = Pdf::loadView('admin.dashboard.salesreport.pdf', [
            'transactions' => $transactions,
            'totalSales' => $totalSales
        ]);

        return $pdf->download('sales-report.pdf');
    }



}
