<?php

namespace App\Http\Controllers\admin;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    // Method to display the form
    public function showAddDriverForm()
    {
        return view('admin.driver.add');
    }

    // Method to handle form submission
    public function addDriver(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255|unique:drivers',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Hash the password using Bcrypt
            $hashedPassword = Hash::make($request->input('password'));

            // Create a new user
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $hashedPassword;
            $user->usertype = 'driver';
            $user->phone = $request->input('phone');
            $user->save();

            // Create a new driver
            $driver = new Driver();
            $driver->name = $request->input('name');
            $driver->license_number = $request->input('license_number');
            $driver->phone = $request->input('phone');
            $driver->save();

            return redirect()->route('admin.driver.view')->with('success', 'Driver added successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error adding the driver: ' . $e->getMessage());
        }
    }

    // Method to display the list of drivers
    public function viewDriver()
    {
        $drivers = Driver::all(); // Retrieve all drivers from the database
        return view('admin.driver.view', compact('drivers'));
    }
    public function viewDriverDetail($id)
    {
        $driver = DB::select('CALL driver_detail(?)', [$id]);

        // Since DB::select returns an array, you might want to get the first result
        $driver = $driver[0];

        return view('admin.driver.detail', [
            'driver' => $driver,
            'email' => $driver->email,
        ]);
    }

    public function viewReport()
    {
        $drivers = DB::select('CALL view_report()');

        return view('admin.driver.report', compact('drivers'));
    }



    // Method to show the edit driver form
    public function editDriver($id)
    {
        $driver = DB::select('CALL edit_driver(?)', [$id]);

        if (!empty($driver)) {
            $driver = $driver[0]; // Get the first result (since you're expecting a single driver)
        }
        return view('admin.driver.edit', [
            'driver' => $driver,
            'email' => $driver->email,
        ]);
    }

    // Method to update driver details
    public function updateDriver(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',

        ]);

        try {
            DB::statement('CALL update_driver(?, ?, ?, ?)', [
                $id,
                $request->input('name'),
                $request->input('license_number'),
                $request->input('phone'),
            ]);

            DB::table('users')
            ->where('phone', $request->input('phone'))
            ->update(['email' => $request->input('email')]);

            return redirect()->route('admin.driver.view')->with('success', 'Driver updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error updating the driver: ' . $e->getMessage());
        }
    }

    // Method to delete a driver
    public function deleteDriver($id)
{
    try {
        DB::statement('CALL delete_driver(?)', [$id]);

        return redirect()->route('admin.driver.view')->with('success', 'Driver deleted successfully');
    } catch (\Exception $e) {
        return back()->with('error', 'There was an error deleting the driver: ' . $e->getMessage());
    }
}
}
