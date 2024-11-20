<?php

namespace App\Http\Controllers;

use App\Models\Clock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockController extends Controller
{
    //


    public function clockIn()
    {
        Clock::create([
            'user_id' => Auth::id(),
            'clock_in' => now(),
        ]);
        return back()->with('success', 'Clocked in successfully.');
    }

    public function clockOut()
    {
        $clock = Clock::where('user_id', Auth::id())->latest()->first();
        $clock->update(['clock_out' => now()]);
        return back()->with('success', 'Clocked out successfully.');
    }

    public function manageBreak(Request $request)
{
    $log = Clock::where('user_id', auth()->id())->latest()->first();

    if ($request->has('start_break')) {
        $log->update(['break_start' => now()]);
        return redirect()->back()->with('status', 'Break started!');
    }

    if ($request->has('end_break')) {
        $log->update(['break_end' => now()]);
        return redirect()->back()->with('status', 'Break ended!');
    }
}
}
