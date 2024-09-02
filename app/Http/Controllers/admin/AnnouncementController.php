<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Route;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcement.view', compact('announcements'));
    }
    public function show()
    {
        $announcements = Announcement::all();
        return view('user.mainpage', compact('announcements')); // Adjust the view name as necessary
    }

    // Show the form for creating a new resource
    public function create()
    {
        $routes = Route::all();
        return view('admin.announcement.add',compact('routes'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required|string|max:50',
            'Description' => 'required|string|max:100',
            'DatePosted' => 'required|date',
            'RouteID' => 'required|exists:routes,RouteID',
        ]);

        Announcement::create($request->all());

        return redirect()->route('admin.announcement.view')->with('success', 'Announcement created successfully.');
    }



    // Show the form for editing the specified resource
    public function edit(Announcement $announcement)
    {
        $routes = Route::all(); // Retrieve all routes
        return view('admin.announcement.edit', compact('announcement', 'routes'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'Title' => 'required|string|max:50',
            'Description' => 'required|string|max:100',
            'DatePosted' => 'required|date',
            'RouteID' => 'required|exists:routes,RouteID',
        ]);

        $announcement->update($request->all());

        return redirect()->route('admin.announcement.view')->with('success', 'Announcement updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcement.view')->with('success', 'Announcement deleted successfully.');
    }
}
