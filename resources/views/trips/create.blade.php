<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        display: flex;
        gap: 10px;
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

    /* ستايل للحقول */
    input[type="text"] { background: #ecf9ff; }
    input[type="number"] { background: #fef6e4; }
    input[type="date"] { background: #f3f9ec; }
    select { background: #f9f0ff; }
    textarea { background: #fff7f7; }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #dcdde1;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 6px rgba(52,152,219,0.3);
        background: #fff;
    }

    textarea { resize: none; }

    /* 🎨 input file */
    .file-input {
        position: relative;
        display: inline-block;
    }
    .file-input input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 120px; 
        height: 40px;
        cursor: pointer;
    }
    .file-input-label {
        display: inline-block;
        background: #3498db;
        color: #fff;
        padding: 8px 75px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
    }
    .file-input-label:hover {
        background: #2980b9;
    }

    /* 🎨 زر الحفظ */
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
    <h2> <i class="fa fa-map-marker" style="font-size: 30px; color:red;"></i> Add New Trip</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label><i class="fa fa-tag" style="color:#2980b9"></i> The Name:</label>
            <input type="text" name="name" required placeholder='Enter the trip name'>
        </div>

        <div>
            <label><i class="fa fa-pencil" style="color:#8e44ad"></i> Description:</label>
            <textarea name="description" rows="3" required placeholder='Description of the trip'></textarea>
        </div>

        <div>
            <label><i class="fa fa-image" style="color:#e67e22"></i> Image</label>
            <div class="file-input">
                <label class="file-input-label">Browse</label>
                <input type="file" name="images[]" multiple>
            </div>
        </div>

        <div>
            <label><i class="fa fa-calendar" style="color:#16a085"></i> Start Time: </label>
            <input type="date" name="start_date" required>
        </div>
        <div>
            <label><i class="fa fa-calendar-check-o" style="color:#27ae60"></i> End Time: </label>
            <input type="date" name="end_date" required>
        </div>

        <div>
            <label><i class="fa fa-money" style="color:#d35400"></i> Price</label>
            <input type="number" name="price" required>
        </div>

        <div>
            <label><i class="fa fa-users" style="color:#c0392b"></i> Number Of Seats </label>
            <input type="number" name="available_seats" required>
        </div>

        <div>
            <label><i class="fa fa-suitcase" style="color:#3498db"></i> Type of Trip</label>
            <select name="type_id">
                @foreach($triptype as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label><i class="fa fa-building" style="color:#f39c12"></i> The Hotel</label>
            <select name="hotel_id">
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"><i class="fa fa-save"></i> Save</button>
    </form>
</div>
@endsection