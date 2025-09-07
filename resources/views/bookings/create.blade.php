@extends('layout.app')
@section('title', 'Add New Booking')
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(to right, #dbe9f4, #f0f4f8);
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
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    label {
        font-size: 18px;
        font-weight: bold;
        color: #34495e;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    input[type="text"] { background: #ecf9ff; }
    input[type="number"] { background: #fef6e4; }
    input[type="date"] { background: #f3f9ec; }
    input[type="email"] { background: #ffecf9; }
    select { background: #f0fff0; }

    input, select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #dcdde1;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus, select:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 6px rgba(52,152,219,0.3);
        background: #fff;
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
</style>

<div class="container">
    <h2><i class="fa-solid fa-calendar-plus" style="color:#3498db;"></i> Add Booking</h2>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <label for="trip_id"><i class="fa-solid fa-bus" style="color:#3498db;"></i> Select Trip:</label>
        <select name="trip_id" class="form-control" required>
            @foreach($trip as $tripsingl)
                <option value="{{ $tripsingl->id }}" data-price="{{ $tripsingl->price }}">
                    {{ $tripsingl->name }} - available {{ $tripsingl->available_seats }} seat
                </option>
            @endforeach
        </select>

        <label for="customer_name"><i class="fa-solid fa-user" style="color:#2ecc71;"></i> Customer Name:</label>
        <input type="text" name="customer_name" class="form-control" required>

        <label for="customer_email"><i class="fa-solid fa-envelope" style="color:#e67e22;"></i> Email:</label>
        <input type="email" name="customer_email" class="form-control">

        <label for="number_of_people"><i class="fa-solid fa-users" style="color:#9b59b6;"></i> Number of People:</label>
        <input type="number" name="number_of_people" class="form-control" min="1" required>

        <label for="credit_card_number"><i class="fa-solid fa-credit-card" style="color:#c0392b;"></i> Credit Card Number:</label>
        <input type="text" name="credit_card_number" class="form-control" required>

        <label for="total_price"><i class="fa-solid fa-dollar-sign" style="color:#16a085;"></i> Total Price:</label>
        <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" readonly>

        <button type="submit">Booking</button>
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
