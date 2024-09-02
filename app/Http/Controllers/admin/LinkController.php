<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stop;
use App\Models\Schedule;

class LinkController extends Controller
{
    public function create()
    {
        $stops = Stop::all();
        $schedules = Schedule::all();
        $linkedStops = Stop::with('schedule')->get();

        return view('admin.schedule.assign', compact('stops', 'schedules', 'linkedStops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'StopID' => 'required|exists:stops,StopID',
            'ScheduleID' => 'required|exists:schedules,ScheduleID',
        ]);

        $schedule = Schedule::findOrFail($request->ScheduleID);
        $stop = Stop::findOrFail($request->StopID);

        // Check if the stop is already linked to the schedule
          if ($schedule->stops()->where('stops.StopID', $request->StopID)->exists()) {
            return redirect()->route('admin.link.create')->withErrors(['error' => 'This stop is already added to the selected schedule.']);
        }

        // Attach the stop to the schedule
        $schedule->stops()->attach($stop->StopID);

        return redirect()->route('admin.link.create')->with('success', 'Stop added to Schedule successfully.');
    }
    public function destroy($stopId, $scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $stop = Stop::findOrFail($stopId);

        // Detach the stop from the schedule
        $schedule->stops()->detach($stop->StopID);

        return redirect()->route('admin.link.create')->with('success', 'Link between Stop and Schedule deleted successfully.');
    }
}
