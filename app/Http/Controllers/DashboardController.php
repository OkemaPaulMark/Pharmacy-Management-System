<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Sale;

class DashboardController extends Controller
{
   public function dashboard(Request $request)
   {
       $stocks = Stock::with('supplier')->get();
   
       // Bar Chart Data
       $barLabels = $stocks->pluck('medicine')->toArray();
       $barData = $stocks->pluck('quantity')->toArray();
   
       // Pie Chart Data
       $pieData = $stocks->groupBy('supplier_id')->map(function ($items) {
           return $items->sum('quantity');
       });
       $pieLabels = Supplier::whereIn('id', $pieData->keys())->pluck('supplier_name')->toArray();
       $pieData = $pieData->values()->toArray();
   
       // Line Chart Data
       $lineData = $stocks->groupBy('expiry_date')->map(function ($items) {
           return $items->sum('quantity');
       });
       $lineLabels = $lineData->keys()->map(function ($date) {
           return \Carbon\Carbon::parse($date)->format('Y-m-d');
       })->toArray();
       $lineData = $lineData->values()->toArray();
   
       return view('admin.dashboard.list', compact(
           'barLabels', 'barData', 
           'pieLabels', 'pieData',
           'lineLabels', 'lineData'
       ));
   }

     public function index(Request $request){
      $stocks = Stock::with('supplier')->get();
   
      // Bar Chart Data
      $barLabels = $stocks->pluck('medicine')->toArray();
      $barData = $stocks->pluck('quantity')->toArray();
  
      // Pie Chart Data
      $pieData = $stocks->groupBy('supplier_id')->map(function ($items) {
          return $items->sum('quantity');
      });
      $pieLabels = Supplier::whereIn('id', $pieData->keys())->pluck('supplier_name')->toArray();
      $pieData = $pieData->values()->toArray();
  
      // Line Chart Data
      $lineData = $stocks->groupBy('expiry_date')->map(function ($items) {
          return $items->sum('quantity');
      });
      $lineLabels = $lineData->keys()->map(function ($date) {
          return \Carbon\Carbon::parse($date)->format('Y-m-d');
      })->toArray();
      $lineData = $lineData->values()->toArray();
  
      return view('pharmacist.dashboard.list', compact(
          'barLabels', 'barData', 
          'pieLabels', 'pieData',
          'lineLabels', 'lineData'
      ));
     }

     public function saleshistory(Request $request){

      return view('pharmacist.dashboard.saleshistory');
      
   }
 }
