
@extends('layout.app')

@section('content')
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #f7f9fc;
        margin: auto;
        padding: 20px;
        background: linear-gradient(to right, #dbe9f4, #f0f4f8);
    }

    .container {
        max-width: 700px;
        margin: auto;
        background: #fff;
        padding: 25px 30px;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    h2 {
        color: #2c3e50;
        font-size: 26px;
        margin-bottom: 20px;
        border-bottom: 3px solid #3498db;
        padding-bottom: 10px;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #34495e;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    input[type="text"] { background: #ecf9ff; }
    input[type="file"] { background: #fff7f7; }
    select { background: #f9f0ff; }

    input[type="text"],
    input[type="file"],
    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #dcdde1;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus,
    select:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 6px rgba(52,152,219,0.3);
        background: #fff;
    }

    button {
        padding: 12px;
        border: 2px solid #27ae60;
        border-radius: 10px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        background: #27ae60;
        color: white;
        transition: 0.3s;
    }

    button:hover {
        background: white;
        color: #27ae60;
        border: 2px solid #27ae60;
        transform: scale(1.03);
    }
</style>

<div class="container">
    <h2>Add New Hotel:</h2>

    <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>name:</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>image:</label>
            <input type="file" name="images[]" multiple>
        </div>

        <div>
            <label>evaluation:</label>
            <select name="rating">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <button type="submit">save</button>
    </form>
</div>
@endsection
