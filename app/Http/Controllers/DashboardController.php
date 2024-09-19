<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use App\Models\devices;
use App\Models\maintenance;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(Request $request)
    {

        // If no input is provided, use the current month and year
        $month = $request->input('month', date('m')); // Default to current month
        $year = $request->input('year', date('Y')); // Default to current year

        // If the "Show All" button is clicked, ignore the date filters
        if ($request->has('show_all')) {
            // Count all devices
            $maintenances = maintenance::count();
            $deviceCount = devices::count();
            $totalAddition = DB::table('credit_transactions')
                ->where('transaction_type', 'addition')
                ->sum('amount');
            $totalDeduction = DB::table('credit_transactions')
                ->where('transaction_type', 'deduction')
                ->sum('amount');
            $totalDeductionNum = $totalDeduction * -1;



            // Last Update to Counts
            $pcs = devices::where('category_id', 1)->count();
            $printers = devices::where('category_id', 5)->count();
            $VMTs = devices::where('category_id', 2)->count();
            $PDAs = devices::where('category_id', 3)->count();
            $RDTs = devices::where('category_id', 4)->count();
            $VSPLAN = devices::where('depart_id', 1)->count();
            $YRPLAN = devices::where('depart_id', 2)->count();
            $CustSRV = devices::where('depart_id', 4)->count();
            $BillSRV = devices::where('depart_id', 5)->count();
            $Resrv = devices::where('depart_id', 9)->count();
            $Gates = devices::where('depart_id', 3)->count();
            
            
            
            return view('dashboard', compact(
                'maintenances',
                'deviceCount',
                'totalAddition',
                'totalDeductionNum',
                'totalDeduction',
                'pcs',
                'printers',
                'VMTs',
                'RDTs',
                'PDAs',
                'VSPLAN',
                'YRPLAN',
                'CustSRV','Gates'
                ,
                'BillSRV',
                'Resrv'
                
                ))->with('showAll', true);
            }
            
            
            
            $Gates = devices::where('depart_id', 3)->count();
        $pcs = devices::where('category_id', 1)->count();
        $printers = devices::where('category_id', 5)->count();
        $VMTs = devices::where('category_id', 2)->count();
        $PDAs = devices::where('category_id', 3)->count();
        $RDTs = devices::where('category_id', 4)->count();
        $VSPLAN = devices::where('depart_id', 1)->count();
        $YRPLAN = devices::where('depart_id', 2)->count();
        $CustSRV = devices::where('depart_id', 4)->count();
        $BillSRV = devices::where('depart_id', 5)->count();
        $Resrv = devices::where('depart_id', 9)->count();


        $deviceCount = devices::count();
        // Count devices created in the specified month and year
        $maintenances = maintenance::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();


        $totalAddition = DB::table('credit_transactions')
            ->where('transaction_type', 'addition')->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->sum('amount');
        $totalDeduction = DB::table('credit_transactions')
            ->where('transaction_type', 'deduction')->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->sum('amount');
        $totalDeductionNum = $totalDeduction * -1;
        return view('dashboard', compact(
            'deviceCount',
            'maintenances',
            'totalAddition',
            'totalDeductionNum',
            'totalDeduction',
            'pcs',
            'printers',
            'VMTs',
            'PDAs',
            'RDTs',
            'VSPLAN',
            'YRPLAN',
            'CustSRV'
            ,'Gates',
            'BillSRV',
            'Resrv',
            'month',
            'year'
        ))->with('showAll', false);
    }
}
