@extends('layout.app')

@section('content')
<style></style>
<style>
    body {
    font-family: 'Cairo', sans-serif;
    background-color: #eef2f3;
    margin: 0;
    padding: 15px;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-left: 250px;
    width: calc(100% - 350px);
    box-sizing: border-box;
}

h2 {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 20px;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
}

.a-hotel{
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    background-color: #1abc9c;
    color: white;
    border: 1px solid transparent; 
    box-sizing: border-box;
}

.a-hotel:hover {
    color: #1abc9c;
    border: 1px solid #1abc9c;
    background-color: white;
    transition: color 0.3s ease;
    text-decoration: none;
}

.table {
    margin-top: 50px;
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background-color: #3498db;
    color: white;
    padding: 12px;
    text-align: center;
}

.table td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
    background-color: #f9f9f9;
}

.table a.btn-sm {
    font-size: 13px;
    padding: 6px 10px;
    margin: 2px;
    border-radius: 4px;
    display: inline-block;
}

.table a.btn-info {
    background-color: #3498db;
    color: white;
}

.table a.btn-info:hover {
    background-color: white;
    color: #3498db;
    border: 1px solid #3498db;
}

.table a.btn-warning {
    background-color: #f39c12;
    color: white;
}

.table a.btn-warning:hover {
    background-color: white;
    color: #f39c12;
    border: 1px solid #f39c12;
}

.table .btn-danger {
    background-color: #e74c3c;
    color: white;
    border: none;
}

.table .btn-danger:hover {
    background-color: white;
    color: #e74c3c;
    border: 1px solid #e74c3c;
}

</style>
<div class="container">
    <h2>The Hotels: </h2>
    <a href="{{ route('hotels.create') }}" class="btn btn-primary mb-3 a-hotel"> Add New Hotel </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" style="margin-top:50px;">
        <thead>
            <tr>
                <th>name:</th>
                <th>image:</th>
                <th>evaluation:</th>
                <th>actions:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
            <tr>
                <td>{{ $hotel->name }}</td>

    <td>
    @if($hotel->image)
    @foreach(json_decode($hotel->image) as $img)
        <img src="{{ asset('images/hotels/' . $img) }}" width="100" style="margin:5px;">
    @endforeach
@else
    لا توجد صور
@endif
</td>

                <td>{{ $hotel->rating }} ⭐</td>
                <td>
                    <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning btn-sm">Update</a>
                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('are you sure you want to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
