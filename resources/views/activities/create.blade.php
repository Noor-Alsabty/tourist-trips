@extends('layout.app')
@section('title', 'Create Activity')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        height: 670px;
        margin: auto;
        background: #fff;
        padding: 25px 30px;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        text-transform: capitalize;

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
        position: relative;
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
    .form-group {
    position: relative;
}
 .form-group i {
    position: absolute;
    top: 65%;
    left: 15px;
    transform: translateY(-50%);
    color: #27ae60;
    font-size: 18px;
}
    input[type="text"],
    input[type="time"],
    select,
    textarea {
        width: 100%;
        padding: 12px 15px 12px 38px;
        border: 1px solid #dcdde1;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 15px;
        background-color: #f9fdfb;
        color: #2d4059;
        transition: all 0.3s ease;
    }
     input[type="text"] { background: #f3f9ec; }
    input[type="time"] { background: #f3f9ec; }
    select { background: #ecf9ff;}
    textarea { background: #fff7f7;}


    input:focus,
    select:focus,
    textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 6px rgba(52,152,219,0.3);
        background: #fff;
    }

    textarea {
        resize: none; /* ثابت الحجم */
        min-height: 100px;
    }

    button {
        margin-top: 30px;
        padding: 14px 28px;
        background-color: #27ae60;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        text-transform: capitalize;
        letter-spacing: 1px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        width: 100%;
    }

    button:hover {
        color: #27ae60;
        border: 1px solid #27ae60;
        background-color: white;
        transform: translateY(-2px);
    }

    button:active {
        transform: scale(0.98);
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
<h2><i class="fas fa-calendar-plus" style="font-size: 30px; color: rgb(205, 5, 5);"></i> Add New Activity</h2>

<form action="{{ route('activities.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="trip_id" class="table">The Trip:</label>
        <i class="fas fa-route" style="color:#2980b9"></i>
        <select name="trip_id" id="trip_id" required>
            @foreach($trip as $singltrip)
                <option value="{{ $singltrip->id }}">{{ $singltrip->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="name">Activity:</label>
        <i class="fas fa-running"></i>
        <input type="text" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="description"><i class="fa fa-pencil" style="color:#8e44ad"></i>Description:</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <div class="form-group">
        <label for="start_time">Start Time:</label>
        <i class="fas fa-clock"></i>
        <input type="time" name="start_time" id="start_time">
    </div>

    <div class="form-group">
        <label for="end_time">End Time:</label>
        <i class="fas fa-hourglass-end"></i>
        <input type="time" name="end_time" id="end_time">
    </div>

    <button type="submit"><i class="fas fa-save"></i> Save Activity</button>
</form>
</div>
@endsection
