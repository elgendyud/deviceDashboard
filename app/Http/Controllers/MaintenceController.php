<?php

namespace App\Http\Controllers;

use App\Models\devices;
use App\Models\maintenance;
use App\Models\stocks;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenceController extends Controller
{
    // Show all Maintenances
    public function index(Request $request){

        $maintenance = maintenance::query();
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
    
            // Apply the date filter to the query
            $maintenance->whereBetween('created_at', [$startDate, $endDate]);
        }

        // $maintenances = $maintenance->get();
        $maintenances = $maintenance->orderBy('created_at','desc')->get();
        $device = maintenance::whereIn('id',maintenance::pluck('device_id'))->get();
        // send the Data to URL while loading the URL of user.index View
        return view('Maintenance.index',compact('maintenances','device'));
    }
    // Create Maintenances 1 - open URL 
    public function create(){
        // $user = maintenance::with('User')->get();
        $user = Auth::user();
        $devices = devices::all();
        $supplies = stocks::all();
        return view('Maintenance.create',compact('user','devices','supplies'));
    }
    public function store(Request $request){
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'report' =>'required',
            'new_supply' =>'nullable'
        ],[
            'report.required' => 'Please inform the Reason of this Maintenance on Report'
        ]);


        $stockController = new StocksController();
        $new_supply = $request->new_supply;

        maintenance::create([
            'device_id' => $request->device_id,
            'report' => $request->report,
            'user_id' => $request->user_id,
            'new_supply' =>$request->new_supply
            // Loop for The Devices to show on Options [ maintenance.create ]
        ]);
        $stockController->deductFromStock($new_supply, 1);

        return redirect()->route('index.maintenance'); 

    } 
    public function delete($id){
        $report = maintenance::find($id);
        $report->delete();
        return redirect()->route('index.maintenance')->with('success', 'Maintenance deleted successfully');
        ;
    }
    public function view($id){
        // Supplies update Start
        // Supplies update End

        $report = maintenance::find($id);
        $device = maintenance::whereIn('id',maintenance::pluck('device_id'))->get();
        $supply = maintenance::whereIn('id',maintenance::pluck('new_supply'))->get();
        return view('maintenance.view', compact('report','device','supply'));
    }
}
