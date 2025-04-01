<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        return view('admin.dashboard.list');
     }

     public function saleshistory(Request $request){
        return view('admin.dashboard.saleshistory');
     }
 }

