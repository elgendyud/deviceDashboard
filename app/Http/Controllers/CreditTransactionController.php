<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use Illuminate\Http\Request;

class CreditTransactionController extends Controller
{
  // Log credit transaction (addition or deduction)
  public static function store($amount, $transaction_type, $description = null)
  {
      $transaction = new CreditTransaction();
      $transaction->amount = $amount;
      $transaction->transaction_type = $transaction_type;
      $transaction->description = $description;
      $transaction->save();


      return route('credits.index');


  }

  // View all credit transactions
  public function index(Request $request)
  {
      $transaction = CreditTransaction::query();  

      $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);
    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Apply the date filter to the query
        $transaction->whereBetween('created_at', [$startDate, $endDate]);
    }

      $transactions = $transaction->orderBy('created_at','desc')->get();
      return view('transactions.index', ['transactions' => $transactions]);
  }
  
}
