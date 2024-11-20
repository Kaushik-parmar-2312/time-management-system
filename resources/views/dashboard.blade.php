<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 'admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      <a href="{{ route('admin.users') }}">  <button type="submit" class="btn btn-primary">User List</button></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'employee')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container">
                            <h2><b>Clock In/Out</b></h2>

                            <form action="/clock-in" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Clock In</button>
                            </form>

                            <form action="/clock-out" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Clock Out</button>
                            </form>

                            <form action="/break" method="POST">
                                @csrf
                                <button type="submit" name="start_break" class="btn btn-warning">Start Break</button>
                                <button type="submit" name="end_break" class="btn btn-success">End Break</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


</x-app-layout>
