<?php

namespace App\Http\Controllers;

use App\Models\stocks;
use App\Models\Supply;
use Illuminate\Http\Request;

class StocksController extends Controller
{

    public function index(){
        $stocks = stocks::select('stocks.*', 'supplies.supply_name')
            ->join('supplies', 'stocks.supply_id', '=', 'supplies.id')
            ->orderBy('updated_at','desc')->get();
        return view('credits.stock',compact('stocks'));
    }
    public function deductFromStock($supplyId, $quantity)
    {
        $stock = stocks::where('supply_id', $supplyId)->first();

        if ($stock && $stock->quantity >= $quantity) {
            $stock->quantity -= $quantity;
            $stock->save();
        } 
    }

    // Add supply to stock (restock)
    public function addToStock($supplyId, $quantity,$supplyName)
    {
        $stock = stocks::firstOrCreate(
            ['supply_id' => $supplyId],
            ['quantity' => 0, 'supply_name' => $supplyName] // Initial quantity if doesn't exist
        );

        $stock->quantity += $quantity;
        $stock->save();
    }
}
