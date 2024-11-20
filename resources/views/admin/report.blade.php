<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h2 class="text-center mb-4">User Time Tracking Report</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Clock In</th>
                        <th scope="col">Clock Out</th>
                        <th scope="col">Break Start</th>
                        <th scope="col">Break End</th>
                        <th scope="col">Total Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->user_id }}</td>
                            <td>{{ $report->clock_in ? $report->clock_in->format('H:i:s') : 'N/A' }}</td>
                            <td>{{ $report->clock_out ? $report->clock_out->format('H:i:s') : 'N/A' }}</td>
                            <td>{{ $report->break_start ? $report->break_start->format('H:i:s') : 'N/A' }}</td>
                            <td>{{ $report->break_end ? $report->break_end->format('H:i:s') : 'N/A' }}</td>
                            <td>

                                {{ $report->work_duration ? $report->work_duration : 'N/A' }}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
