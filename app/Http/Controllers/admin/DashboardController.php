<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $userCounts = [];
        $totalUsers = User::whereIn('usertype', ['user', 'driver'])
            ->select('usertype', DB::raw('count(*) as total'))
            ->groupBy('usertype')
            ->pluck('total', 'usertype')
            ->toArray();

            $facultyCounts = User::where('usertype', 'user')
            ->select('faculty', DB::raw('count(*) as count'))
            ->groupBy('faculty')
            ->get();

        $faculties = $facultyCounts->pluck('faculty')->toArray();
        $counts = $facultyCounts->pluck('count')->toArray();



        $ageCounts = User::where('usertype', 'user')
            ->select('age', DB::raw('count(*) as count'))
            ->groupBy('age')
            ->get();
        $ageLabels = $ageCounts->pluck('age');
        $ageValues = $ageCounts->pluck('count');

        $genderCounts = User::where('usertype', 'user')
            ->select('gender', DB::raw('count(*) as count'))
            ->groupBy('gender')
            ->get();
        $genderLabels = $genderCounts->pluck('gender');
        $genderValues = $genderCounts->pluck('count');

        $courseCounts = User::where('usertype', 'user')
            ->select('course', DB::raw('count(*) as count'))
            ->groupBy('course')
            ->get();
        $courseLabels = $courseCounts->pluck('course');
        $courseValues = $courseCounts->pluck('count');

        // Calculate average working time for each user in hours
        $workingTimes = DB::table('checkins')
            ->select('UserID', DB::raw('AVG(TIMESTAMPDIFF(MINUTE, checkin_time, checkout_time)) / 60 as average_working_hours'))
            ->groupBy('UserID')
            ->pluck('average_working_hours', 'UserID')
            ->toArray();

        $userNames = User::whereIn('id', array_keys($workingTimes))
            ->pluck('name', 'id')
            ->toArray();


        // User count per month (dummy data)
        foreach ($months as $index => $month) {
            $userCounts[] = User::whereMonth('created_at', $index + 1)->count();
        }
        // Aggregate the number of schedules for each bus
        $scheduleCounts = DB::table('schedules')
            ->select('BusID', DB::raw('COUNT(*) as schedule_count'))
            ->groupBy('BusID')
            ->get();

        // Fetch the bus information for labeling purposes
        $buses = DB::table('buses')->pluck('NumberPlate', 'BusID')->toArray();

        // Prepare data for the chart
        $busLabels = [];
        $scheduleValues = [];

        foreach ($scheduleCounts as $count) {
            $busLabels[] = $buses[$count->BusID] ?? 'Unknown Bus';
            $scheduleValues[] = $count->schedule_count;
        }



        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'userCounts' => $userCounts,
            'months' => $months,
            'faculty' => $faculties,
            'count' => $counts,
            'ageLabels' => $ageLabels,
            'ageValues' => $ageValues,
            'genderLabels' => $genderLabels,
            'genderValues' => $genderValues,
            'courseLabels' => $courseLabels,
            'courseValues' => $courseValues,
            'workingTimes' => $workingTimes,
            'userNames' => $userNames,
            'busLabels' => $busLabels,
            'scheduleValues' => $scheduleValues,
        ]);
    }
}
