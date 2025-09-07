@extends('layout.app')

@section('content')
<style>
body {
    font-family: 'Cairo', sans-serif;
    background-color: #eef2f3;
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center; 
    align-items: center;     
    padding: 15px;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 1000px; 
    text-align: center; 
    overflow-x: auto;  
    margin-left: 190px;
}

h2 {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 20px;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

.table {
    width: 100%;  
    min-width: 900px; 
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

a {
    text-decoration: none;
    color: inherit;
}

.btn {
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
    display: inline-block;
    margin: 5px;
}

.btn-primary {
    background-color: #1abc9c;
    color: white;
    border: none;
}

.btn-warning {
    background-color: #f39c12;
    color: white;
    border: none;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
    border: none;
}

.btn:hover {
    opacity: 0.95;
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.a-trip:hover {
    color: #1abc9c;
    border: 1px solid #1abc9c;
    text-decoration: none;
    background-color: white;
    transition: all 0.3s ease;
}
</style>
<div class="container">
    <h2> Tours Trips :</h2>

    <a href="{{ route('trips.create') }}" class="btn btn-primary mb-3">Add New Trip</a>

    @if($trips->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>the trip</th>
                    <th>description</th>
                    <th>price</th>
                    <th>start time </th>
                    <th>end time </th>
                    <th>seats</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trips as $trip)
                    <tr>
                        <td>{{ $trip->name }}</td>
                        <td>{{ Str::limit($trip->description, 50) }}</td>
                        <td>{{ $trip->price }} $</td>
                        <td>{{ $trip->start_date }}</td>
                        <td>{{ $trip->end_date }}</td>
                        <td>{{ $trip->available_seats }}</td>
                        <td>
                            <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-warning btn-sm a-trip">Update</a>
                            <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
                            
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="margin-top: 25px;">There aren't trips now!</p>
    @endif
</div>
@endsection
