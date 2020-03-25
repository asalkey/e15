<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaverController extends Controller
{
    public function show()
    {
        return view('saver.show');
    }
    
    public function calculate(Request $request)
    {
        
       $request->validate([
           'item_cost' => 'required|numeric|min:1',
           'percent_off' => 'required|integer|between:1,100',
       ]);
       
       $percentOff = $request->percent_off / 100;
       $savings = $percentOff * $request->item_cost;
       $totalCost = $request->item_cost - $savings;
       $salesTax = ($request->sales_tax) ? true : false; 
       
       return redirect('/')->with(['savings' => $savings, 'totalCost'=> $totalCost, 'salesTax'=> $salesTax]);
    }
}
