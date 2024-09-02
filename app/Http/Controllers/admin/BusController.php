<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class BusController extends Controller
{

    public function index($id)
    {
        $drivers = Driver::find($id);
        $buses = Bus::where('DriverID', $id)->get();
        return view('admin.bus.view', compact('drivers','buses'));
    }

    public function create($id)
    {
        $driver = Driver::find($id);
        $schedules = Schedule::all();
        return view('admin.bus.add', compact('driver', 'schedules'));
    }

    public function store(Request $request , $id)
    {

        $validatedData = $request->validate([
            'NumberPlate' => 'required|string|max:255',
            'Capacity' => 'required|integer',
        ]);

        DB::statement('CALL insert_bus(?,?,?)', [
            $validatedData['NumberPlate'],
            $validatedData['Capacity'],
            $id,
        ]);

        return redirect()->route('admin.bus.view',['id' => $id])->with('success', 'Bus created successfully.');
    }
        public function selectBus($id)
    {
        $drivers = Driver::find($id);
        $buses = Bus::all();

        return view('admin.bus.select', compact('buses','drivers'));
    }
    public function attachBusToDriver(Request $request, $driverId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'bus' => 'required|exists:buses,BusID', // Ensure selected bus exists in the buses table
        ]);

        // Retrieve the selected bus ID from the form
        $busId = $validatedData['bus'];

        // Find the driver by their ID
        $driver = Driver::findOrFail($driverId);

        // Retrieve bus details based on selected BusID
        $bus = Bus::findOrFail($busId);

        // Associate the bus with the driver
        $bus->DriverID = $driver->DriverID;
        $bus->save();

        // Redirect back with success message
        return redirect()->route('admin.bus.view', ['id' => $driverId])->with('success', 'Bus updated successfully.');
    }

    public function edit($id)
    {
        // Fetch the bus record based on $id and pass it to the view for editing
        $bus = Bus::findOrFail($id);
        return view('admin.bus.edit', compact('bus'));
    }

    public function destroy($id)
    {
         // Retrieve the bus to get the DriverID
        $bus = Bus::findOrFail($id);

        // Call the stored procedure to delete the bus by BusID
        DB::statement('CALL delete_bus(?)', [$id]);

    // Redirect back to the driver's bus list with a success message
        return redirect()->route('admin.bus.view', ['id' => $bus->DriverID])->with('success', 'Bus deleted successfully.');
}

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'NumberPlate' => 'required|string|max:255',
            'Capacity' => 'required|integer',
        ]);

        $bus = Bus::findOrFail($id);
        $bus->NumberPlate = $validatedData['NumberPlate'];
        $bus->Capacity = $validatedData['Capacity'];
        $bus->save();

        return redirect()->route('admin.bus.view',['id' => $bus->DriverID])->with('success', 'Bus updated successfully.');
    }

    public function findBus(Request $request)
{
    $destination = $request->input('destination');

    // Validate the destination input
    $request->validate([
        'destination' => 'required|string'
    ]);

    // Query the database using raw joins
    $buses = DB::table('buses')
        ->join('schedules', 'buses.BusID', '=', 'schedules.BusID')
        ->join('routes', 'schedules.RouteID', '=', 'routes.RouteID')
        ->select('buses.*', 'routes.Destination', 'schedules.date', 'schedules.Time')
        ->where('routes.Destination', 'like', '%' . $destination . '%')
        ->get();

    return view('user.find-bus-result', [
        'buses' => $buses,
        'destination' => $destination
    ]);
}



}

