<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posterminal; 
use Barryvdh\DomPDF\Facade\Pdf;


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
    
    public function generatePDF()
    {
        $transactions = Posterminal::with(['medicine.category'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSales = $transactions->sum('total');

        // Load a view and pass data to it
        $pdf = Pdf::loadView('pharmacist.dashboard.saleshistory_pdf', [
            'transactions' => $transactions,
            'totalSales' => $totalSales
        ]);

        return $pdf->download('sales-history.pdf');
    }
}