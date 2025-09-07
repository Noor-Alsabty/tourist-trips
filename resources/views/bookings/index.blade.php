@extends('layout.app')
@section('title', 'Bookings')
@section('content')

<style>
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #f8f9fa;
        padding: 30px 15px
    }

    .container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: 250px;
    }

    h2 {
        color: #2c3e50;
        font-size: 28px;
        margin-bottom: 25px;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
        text-align: center;
    }

    .a-book {
        background-color: #1abc9c;
        color: white;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 20px;
    }

    .a-book:hover {
        background-color: white;
        color: #2ecc71;
        border: 1px solid #2ecc71;
        transition: all 0.3s ease;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    table th {
        background-color: #3498db;
        color: white;
        padding: 12px;
        font-size: 15px;
        text-transform: capitalize;
    }

    table td {
        padding: 10px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        color: #333;
        text-align: center;
    }

    table tr:hover {
        background-color: #f2f9ff;
        transition: background-color 0.3s ease;
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 13px;
        border-radius: 4px;
        margin: 2px;
        text-decoration: none;
        display: inline-block;
        font-weight: bold;
    }

    .btn-info { background-color: #2980b9; color: white; }
    .btn-warning { background-color: #e67e22; color: white; }
    .btn-danger { background-color: #e74c3c; color: white; }

    .btn-info:hover { background-color: white; color: #2980b9; border: 1px solid #2980b9; }
    .btn-warning:hover { background-color: white; color: #e67e22; border: 1px solid #e67e22; }
    .btn-danger:hover { background-color: white; color: #e74c3c; border: 1px solid #e74c3c; }

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.table th, .table td {
    text-align: center;
    padding: 12px;
    border: 1px solid #dcdcdc;
}

.table th {
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table tbody tr:hover {
    background-color: #d6eaf8;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

</style>

<div class="container">
    <h2>Management Booking</h2>
    <a href="{{ route('bookings.create') }}" class="a-book">Add Booking</a>
    @if($bookings->count())
        <form method="GET" action="{{ route('bookings.index') }}" class="mb-3">
            <label for="trip_id">Select Trip:</label>
            <select name="trip_id" id="trip_id" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
                <option value="">All Trips</option>
                @foreach($trips as $trip)
                    <option value="{{ $trip->id }}" {{ request('trip_id') == $trip->id ? 'selected' : '' }}>
                        {{ $trip->name }}
                    </option>
                @endforeach
            </select>
        </form>
<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Trip</th>
                    <th>Number of People</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->trip->name }}</td>
                        <td>{{ $booking->number_of_people }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <a href="/bookings/{{ $booking->id }}/confirm" class="btn-sm btn-info">Confirm</a>
                            <a href="/bookings/{{ $booking->id }}/cancel" class="btn-sm btn-warning">Cancel</a>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-sm btn-info">Edit</a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="margin-top: 25px;">There aren't any bookings now!</p>
    @endif
</div>
@endsection