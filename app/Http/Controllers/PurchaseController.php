<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Purchase;
use App\Models\Supply;
use DB;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create()
    {
        return view('purchases.create');
    }

    public function store(Request $request)
    {
        // Start a database transaction
        return DB::transaction(function () use ($request) {
            // Calculate total cost of supplies first
            $total = 0;
    
            foreach ($request->supply_name as $index => $supplyName) {
                $total += $request->price[$index] * $request->quantity[$index];
            }
    
            // Get the available credit
            $credit = Credit::first();
    
            // Check if available credit is sufficient
            if ($credit->available_credit < $total) {
                // Insufficient credit, redirect back with error message
                return redirect()->route('purchases.create')->withErrors('No available credit for this purchase.');
            }
    
            // Proceed if credit is sufficient
            $purchase = new Purchase();
            $purchase->purchase_details = $request->purchase_details;
            $purchase->amount = 0; // Initialize to 0, will calculate later
            $purchase->save();
    
            // Initialize StocksController
            $stockController = new StocksController();
    
            // Add supplies and calculate total
            foreach ($request->supply_name as $index => $supplyName) {
                $supply = new Supply();
                $supply->purchase_id = $purchase->id;
                $supply->supply_name = $supplyName;
                $supply->price = $request->price[$index];
                $supply->quantity = $request->quantity[$index];
    
                // Save the supply
                $supply->save();
    
                // Update stock after saving the supply
                $stockController->addToStock($supply->id, $supply->quantity, $supplyName);
            }
    
            // Deduct from available credit
            $credit->available_credit -= $total;
            $credit->save();
    
            // Update purchase total and save
            $purchase->amount = $total;
            $purchase->save();
    
            // Log the credit deduction
            CreditTransactionController::store(-$total, 'deduction', 'Purchase made: ' . $purchase->purchase_details);
    
            return redirect()->route('purchases.index')->with('message', 'Purchase successful.');
        });
    }


    public function index(Request $request)
    {

        $purchase = Purchase::query();

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
    
            // Apply the date filter to the query
            $purchase->whereBetween('created_at', [$startDate, $endDate]);
        }

        $purchases = $purchase->orderBy('created_at','desc')->get();

        // Pass the purchases to the view
        return view('purchases.index', compact('purchases'));
    }


    public function show($id)
    {
        $purchase = Purchase::with('supplies')->findOrFail($id);
        \Log::info($purchase); // Log the purchase data
        return view('purchases.show', ['purchase' => $purchase]);
    }


}
