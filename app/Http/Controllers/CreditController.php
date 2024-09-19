<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function index()
    {
 
        $credit = Credit::first();
        return view('credits.index', ['available_credit' => $credit->available_credit]);
    }
    

    public function addCredit(Request $request)
    {
        $credit = Credit::first();
        $credit->available_credit += $request->amount;
        $credit->save();
    
        CreditTransactionController::store($request->amount, 'addition', 'Credit added');
        return redirect()->route('credits.index')->with('message', 'Credits added successfully.');
    }
    
}
