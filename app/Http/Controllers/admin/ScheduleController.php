<?php

namespace App\Http\Controllers\admin;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Stop;
use App\Models\Route;
use App\Models\Semester;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('bus', 'stops', 'semester')->get();
        return view('admin.schedule.view', compact('schedules'));
    }
    public function viewSchedule(Request $request)
    {
        $query = Schedule::with('bus', 'stops', 'semester');
        // Filter by predefined week ranges
    if ($request->has('week')) {
        $week = $request->week;

        switch ($week) {
            case 'current':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'next':
                $query->whereBetween('date', [Carbon::now()->addWeek()->startOfWeek(), Carbon::now()->addWeek()->endOfWeek()]);
                break;
            case 'last':
                $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                break;
        }
    }

    $schedules = $query->get();
        return view('user.schedule', compact('schedules'));
    }
    public function viewbeforedelete()
    {
        $schedules = Schedule::with('bus', 'stops', 'semester')->get();
        return view('admin.schedule.viewdelete', compact('schedules'));
    }

    // Method to show the form for creating a new schedule
    public function create()
    {
        $buses = Bus::all();
        $routes = Route::all();
        $stops = Stop::all();
        $semesters = Semester::all();
        return view('admin.schedule.add', compact('buses', 'stops', 'semesters','routes'));
    }

    // Method to store a new schedule
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'Time' => 'required|string',
            'BusID' => 'required|exists:buses,BusID',
            'RouteID' => 'required|exists:routes,RouteID',
            'SemesterID' => 'required|exists:semesters,SemesterID',

        ]);

        DB::statement('CALL add_schedule(?,?,?,?,?)', [
            $validatedData['date'],
            $validatedData['Time'],
            $validatedData['BusID'],
            $validatedData['SemesterID'],
            $validatedData['RouteID'],
        ]);


        return redirect()->route('admin.schedule.view')->with('success', 'Schedule created successfully.');
    }
    public function edit(Schedule $schedule)
    {
        $buses = Bus::all();
        $semesters = Semester::all();
        $routes = Route::all();
        return view('admin.schedule.edit', compact('buses', 'semesters', 'routes', 'schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        // Update the schedule here
        $schedule->update($request->all());
        return redirect()->route('admin.schedule.view')->with('success', 'Schedule updated successfully!');
    }

    public function delete($scheduleID)
{
    DB::statement('CALL DeleteSchedule(?)', [$scheduleID]);

    return redirect()->route('admin.schedule.beforedelete')->with('success', 'Schedule deleted successfully.');
}
}
