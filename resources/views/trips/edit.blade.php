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

    img {
        border-radius: 10px;
        margin-bottom: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 100%;
    }
</style>

<div class="container">
    <h2>Update trip: {{ $trip->name }}</h2>

    <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div>
            <label>the trip</label>
            <input type="text" name="name" value="{{ $trip->name }}" required>
        </div>

        <div>
            <label>description</label>
            <textarea name="description" rows="3" required>{{ $trip->description }}</textarea>
        </div>

        <div>
            <label>الصور الحالية:</label>
            @foreach (json_decode($trip->image) as $img)
                <img src="/images/trips/{{ $img }}" alt="">
            @endforeach
        </div>

        <div>
            <label>رفع صور جديدة (اختياري):</label>
            <div class="file-input">
                <label class="file-input-label">Browse</label>
                <input type="file" name="images[]" multiple>
            </div>
        </div>

        <div>
            <label>start date</label>
            <input type="date" name="start_date" value="{{ $trip->start_date }}" required>
        </div>

        <div>
            <label>end date</label>
            <input type="date" name="end_date" value="{{ $trip->end_date }}" required>
        </div>

        <div>
            <label>price</label>
            <input type="number" name="price" value="{{ $trip->price }}" required>
        </div>

        <div>
            <label>number of seats</label>
            <input type="number" name="available_seats" value="{{ $trip->available_seats }}" required>
        </div>

        <div>
            <label>type of trip</label>
            <select name="type_id">
                @foreach($triptype as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>the hotel</label>
            <select name="hotel_id">
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">تحديث الرحلة</button>
    </form>
</div>
@endsection
