@extends('layout.app')
@section('title','activities')
@section('content')
<style>
    body {
    font-family: 'Cairo', sans-serif;
    background-color: #eef2f3;
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center; /* توسيط أفقي */
    align-items: center;     /* توسيط عمودي */
    padding: 15px;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 750px; 
    width: 100%;
    text-align: center; 
}

h2 {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 20px;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

.act-a {
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none; 
    background-color: #1abc9c;
    color: white;
    border: none;
    display: inline-block; /* لتسهيل التوسيط */
    margin-top: 10px;
}

.act-a:hover {
    color: #1abc9c;
    border: 1px solid #1abc9c;
    text-decoration: none;
    background-color: white;
    transition: all 0.3s ease;
}
table {
    margin-top: 50px;
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

table th {
    background-color: #3498db;
    color: white;
    padding: 12px;
    text-align: center;
    font-weight: bold;
    font-size: 15px;
}

table td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
    background-color: #f9f9f9;
    font-size: 14px;
    border: 1px solid #ddd;
}

table tbody tr:nth-child(even) {
    background-color: #f2f7fb;
}

table tbody tr:hover {
    background-color: #d6eaf8;
    transition: background-color 0.3s ease;
}

table a.btn-sm,
table button.btn-sm {
    font-size: 13px;
    padding: 6px 10px;
    margin: 2px;
    border-radius: 4px;
    display: inline-block;
    transition: all 0.3s ease;
    cursor: pointer;
}

table a.btn-warning {
    background-color: #f39c12;
    color: white;
    border: none;
}
table a.btn-warning:hover {
    background-color: white;
    color: #f39c12;
    border: 1px solid #f39c12;
}

table .btn-danger {
    background-color: #e74c3c;
    color: white;
    border: none;
}
table .btn-danger:hover {
    background-color: white;
    color: #e74c3c;
    border: 1px solid #e74c3c;
}
</style>
<div class="container">
<h2>Activities:</h2>
<a href="{{ route('activities.create') }}" class="btn btn-primary mb-3 act-a" >  Add activity </a>
@if($activity->count())
<table>
    <thead>
        <tr>
    <th>the activity</th>
    <th>Trip Name</th>
    <th>description</th>
    <th>start_time</th>
    <th>end_time</th>
</tr>
    </thead>
    <tbody>
        @foreach($activity as $activit)
<tr>
    <td>{{ $activit->name }}</td>
    <td>{{ $activit->trip->name }}</td>
    <td>{{ $activit->description }}</td>
    <td>{{ $activit->start_time }}</td>
    <td>{{ $activit->end_time }}</td>
    <td>
    <a href="{{ route('activities.edit', $activit->id) }}" class="btn btn-warning btn-sm">Update</a>
    <form action="{{ route('activities.destroy', $activit->id) }}" method="POST" style="display:inline;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm btn-activ">Delete</button>
    </form>
    </td>
</tr>
@endforeach
    </tbody>
</table>
@else
        <p style="margin-top: 25px;"> There aren't Activities !</p>
        @endif
</div>
@endsection