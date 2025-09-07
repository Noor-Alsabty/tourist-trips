@extends('layout.app')
@section('title','edit activity')
@section('content')
<style>
    body {
    font-family: 'Cairo', sans-serif;
    background: linear-gradient(to right, #dbe9f4, #f0f4f8);
    margin: 0;
    padding: 20px;
}    

.container {
    max-width: 700px;
    margin: auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    text-transform: capitalize;
}

h3 {
    color: #2c3e50;
    font-size: 24px;
    margin-bottom: 20px;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

label {
    font-weight: bold;
    color: #34495e;
    margin-bottom: 5px;
}

/* 🎨 الحقول */
input[type="text"] { background: #ecf9ff; }
input[type="number"] { background: #fef6e4; }
input[type="date"] { background: #f3f9ec; }
input[type="time"] { background: #f3f9ec; }
select { background: #f9f0ff; }
textarea { background: #fff7f7; }

input[type="text"],
input[type="number"],
input[type="date"],
input[type="time"],
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
<h3>Edit Activity:</h3>

<form action="{{ route('activities.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>the trip:</label>
    <select name="trip_id">
        @foreach($trip as $singltrip)
            <option value="{{ $singltrip->id }}" {{ $singltrip->id == $activity->trip_id ? 'selected' : '' }}>
                {{ $singltrip->name }}
            </option>
        @endforeach
    </select>
    <br>

    <label>activity :</label>
    <input type="text" name="name" value="{{ $activity->name }}" required>
    <br>

    <label>description:</label>
    <textarea name="description">{{ $activity->description }}</textarea>
    <br>

    <label>start time:</label>
    <input type='time' name="start_time" value="{{ $activity->start_time }}">
    <br>

    <label>end time:</label>
    <input type='time' name="end_time" value="{{ $activity->end_time }}">
    <br>

    <button type="submit">update</button>
</form>
</div>
@endsection
