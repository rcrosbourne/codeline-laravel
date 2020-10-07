<?php

namespace App\Http\Controllers;

use App\WeekendTracker;

class WeekendTrackerController extends Controller
{
    public function index()
    {
        return view('weekends');
    }

    public function store()
    {
        // Validate response
        $validatedData = request()->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);
        // Create WeekendTracker model
        $tracker = new WeekendTracker($validatedData);
        // Calculate number of weekends
        $numberOfWeekends = $tracker->countWeekends();
        // Return message
        $message = "Number of weekends between ${validatedData['start_date']} and ${validatedData['end_date']} inclusive is ${numberOfWeekends['weekendCount']}";
        // Return with message
        return redirect()->back()->with('status', $message);
    }
}
