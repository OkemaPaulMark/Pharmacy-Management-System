<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posterminal; // Make sure to import your Posterminal model

class SaleshistoryController extends Controller
{
    public function index()
    {
        // Fetch all transactions with related medicine and category
        $transactions = Posterminal::with(['medicine.category'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate total sales
        $totalSales = $transactions->sum('total');

        return view('pharmacist.dashboard.saleshistory', [
            'transactions' => $transactions,
            'totalSales' => $totalSales
        ]);
    }
}