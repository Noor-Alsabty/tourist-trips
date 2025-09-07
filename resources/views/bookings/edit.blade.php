{{-- @extends('layout.app')
@section('title','edit booking')
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
    transition: 0.3s;  
}  

label:hover {
    color: #3498db;
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
<h3>Edit Booking</h3>

<form action="{{ route('bookings.update', $booking->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="trip_id">Select trip:</label>
    <select name="trip_id" class="form-control" required>
        @foreach($trip as $tripsingl)
        <option value="{{ $tripsingl->id }}" data-price="{{ $tripsingl->price }}"
            {{ $booking->trip_id == $tripsingl->id ? 'selected' : '' }}>
            {{ $tripsingl->name }} - available {{ $tripsingl->available_seats }} seat
        </option>
        @endforeach
    </select>

    <br>

    <label for="customer_name">Customer name:</label>
    <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" required>

    <br>

    <label for="customer_email">Email:</label>
    <input type="email" name="customer_email" class="form-control" value="{{ $booking->customer_email }}">

    <br>

    <label for="number_of_people">Number of people:</label>
    <input type="number" name="number_of_people" class="form-control" min="1" value="{{ $booking->number_of_people }}" required>

    <br>

    <label for="credit_card_number">Credit card number:</label>
    <input type="text" name="credit_card_number" class="form-control" value="{{ $booking->credit_card_number }}" required>

    <br>

    <label for="total_price">Total price:</label>
    <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" value="{{ $booking->total_price }}" readonly>

    <br>

    <button type="submit" class="btn btn-success">Update Booking</button>
</form>
</div>
<script>
    const tripSelect = document.querySelector('select[name="trip_id"]');
    const peopleInput = document.querySelector('input[name="number_of_people"]');
    const totalPriceInput = document.getElementById('total_price');

    function updateTotalPrice() {
        const selectedOption = tripSelect.options[tripSelect.selectedIndex];
        const pricePerSeat = parseFloat(selectedOption.dataset.price || 0);
        const numberOfPeople = parseInt(peopleInput.value || 0);
        const availableSeatsText = selectedOption.textContent.match(/available (\d+) seat/);
        const availableSeats = availableSeatsText ? parseInt(availableSeatsText[1]) : 0;

        if (numberOfPeople > availableSeats) {
            alert("عدد الأشخاص أكبر من عدد المقاعد المتاحة!");
            peopleInput.value = availableSeats;
        }

        const total = pricePerSeat * numberOfPeople;
        totalPriceInput.value = total.toFixed(2);
    }

    tripSelect.addEventListener('change', updateTotalPrice);
    peopleInput.addEventListener('input', updateTotalPrice);
</script>
@endsection
 --}}
@extends('layout.app')
@section('title','Edit Booking')
@section('content')

@if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    body {  
        font-family: 'Cairo', sans-serif;  
        background: linear-gradient(to right, #dbe9f4, #f0f4f8);  
        margin: 0;  
        padding: 20px;  
    }      
  
    .error-box {
        max-width: 600px;
        margin: 0 auto 20px auto;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-size: 16px;
        font-weight: bold;
    }

    .error-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .error-box li {
        margin: 5px 0;
    }

    .container {  
        max-width: 700px;  
        margin: auto;  
        background: #fff;  
        padding: 25px 30px;  
        border-radius: 15px;  
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);  
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
        transition: 0.3s;  
    }  

    label:hover {
        color: #3498db;
    }  
  
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
    <h3>Edit Booking</h3>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="trip_id">Select trip:</label>
        <select name="trip_id" class="form-control" required>
            @foreach($trip as $tripsingl)
                <option value="{{ $tripsingl->id }}" data-price="{{ $tripsingl->price }}"
                    {{ $booking->trip_id == $tripsingl->id ? 'selected' : '' }}>
                    {{ $tripsingl->name }} - available {{ $tripsingl->available_seats }} seat
                </option>
            @endforeach
        </select>

        <label for="customer_name">Customer name:</label>
        <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" required>

        <label for="customer_email">Email:</label>
        <input type="email" name="customer_email" class="form-control" value="{{ $booking->customer_email }}">

        <label for="number_of_people">Number of people:</label>
        <input type="number" name="number_of_people" class="form-control" min="1" value="{{ $booking->number_of_people }}" required>

        <label for="credit_card_number">Credit card number:</label>
        <input type="text" name="credit_card_number" class="form-control" value="{{ $booking->credit_card_number }}" required>

        <label for="total_price">Total price:</label>
        <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" value="{{ $booking->total_price }}" readonly>

        <button type="submit">Update Booking</button>
    </form>
</div>

<script>
    const tripSelect = document.querySelector('select[name="trip_id"]');
    const peopleInput = document.querySelector('input[name="number_of_people"]');
    const totalPriceInput = document.getElementById('total_price');

    function updateTotalPrice() {
        const selectedOption = tripSelect.options[tripSelect.selectedIndex];
        const pricePerSeat = parseFloat(selectedOption.dataset.price || 0);
        const numberOfPeople = parseInt(peopleInput.value || 0);
        const availableSeatsText = selectedOption.textContent.match(/available (\d+) seat/);
        const availableSeats = availableSeatsText ? parseInt(availableSeatsText[1]) : 0;

        if (numberOfPeople > availableSeats) {
            alert("عدد الأشخاص أكبر من عدد المقاعد المتاحة!");
            peopleInput.value = availableSeats;
        }

        const total = pricePerSeat * numberOfPeople;
        totalPriceInput.value = total.toFixed(2);
    }

    tripSelect.addEventListener('change', updateTotalPrice);
    peopleInput.addEventListener('input', updateTotalPrice);
</script>
@endsection
