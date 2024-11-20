<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Clock;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function listUsers()
    {
        $users = User::where('role', 'employee')->get();
        return view('admin.users', compact('users'));
    }

    public function viewReport(User $user)
    {
        $reports = Clock::where('user_id', $user->id)->get();

        foreach ($reports as $report) {
            $report->clock_in = Carbon::parse($report->clock_in);
            $report->clock_out = Carbon::parse($report->clock_out);
            $report->break_start = Carbon::parse($report->break_start);
            $report->break_end = Carbon::parse($report->break_end);

            if ($report->clock_in && $report->clock_out) {
                $report->work_duration = Carbon::parse($report->clock_out)->diff($report->clock_in)->format('%H:%I:%S');
            } else {
                $report->work_duration = 'N/A'; // If no clock_in or clock_out, set to N/A
            }

        }

        return view('admin.report', compact('user', 'reports'));
    }
}
