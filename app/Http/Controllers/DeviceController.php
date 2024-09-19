<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\department;
use App\Models\devices;
use App\Models\maintenance;
use App\Models\stocks;
use App\Models\Supply;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function create()
    {
        $departs = department::all();
        $cats = category::all();
        return view('Device.create', compact('departs', 'cats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'depart_id' => 'required|integer|exists:departments,id',
            'ip_address' => 'unique:devices,ip_address'
        ], [
            'ip_address.unique' => 'This IP Address is already taken. Please choose another.', // Custom error message

        ]);
        devices::create([
            'device_name' => $request->device_name,
            'ip_address' => $request->ip_address,
            'operating_system' => $request->operating_system,
            'category_id' => $request->category_id,
            'depart_id' => $request->depart_id,
            'details' => $request->details
        ]);
        return redirect()->route('index.device');
    }


    public function index(Request $request)
    {
        // Bring The data from database
        $categoryId = $request->get('category_id');

        // Fetch all categories for buttons
        $categories = Category::all();
        $depart = devices::with('depart')->get();

        // Search Start
        $query = trim($request->input('search'));
        $searches = '';
    if ($query) {
        $searches = devices::where('ip_address', 'LIKE', "%$query%")->get(); 

    } else {
        // Display all records if there's no search query
        $devices = devices::all();
    }
        // Search End

        // send the Data to URL while loading the URL of user.index View
        if ($categoryId) {
            $devices = devices::where('category_id', $categoryId)->get();
        } else {
            $devices = devices::all(); // Show all devices if no category is selected
        }

        return view('device.index', compact('devices', 'categories', 'depart', 'categoryId','searches'));
    }


    // View Specific Device Detils
    public function view($id)
    {
        $device = devices::find($id);

        // Updated for test
        // $reports = devices::with('maintenance')->findOrFail($id);
        $reports = Maintenance::where('device_id', $id)
            ->with('supply') // Use the relationship method name
            ->orderBy('created_at','desc')->get();




        return view('device.view', [
            'device' => $device,
            'reports' => $reports// Convert newlines to <br> tags
        ]);
    }

    // Detele Device
    public function delete($id)
    {
        $device = devices::find($id);
        $device->delete();
        return redirect()->route('index.device');
    }

    // Update Device 1 - redirect to Edit URL
    public function edit($id)
    {
        $device = devices::find($id);
        $categories = devices::with('category')->get();
        $depart = devices::with('depart')->get();
        $departs = department::all();
        $cats = category::all();
        return view('device.edit', compact('device', 'categories', 'depart', 'cats', 'departs'));
    }
    // Send data to 
    public function update(Request $request)
    {
        $device = devices::find($request->id);

        if ($device->ip_address != $request->ip_address) {

            $request->validate([
                'ip_address' => 'unique:devices,ip_address'
            ], [
                'ip_address.unique' => 'This IP Address is already taken. Please choose another.', // Custom error message

            ]);
            $device->update([
                'ip_address' => $request->ip_address
            ]);
        }
        $device->update([
            'device_name' => $request->device_name,
            'operating_system' => $request->operating_system,
            'category_id' => $request->category_id,
            'depart_id' => $request->depart_id,
            'details' => $request->details
        ]);
        return redirect()->route('index.device');
    }



}
