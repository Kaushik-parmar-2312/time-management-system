@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Clock In/Out</h2>

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
@endsection
