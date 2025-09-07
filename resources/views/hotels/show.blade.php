{{-- @extends('layout.app')

@section('content')
<div class="container">
    <h2>Hotel details </h2>

    <div class="card">
        <div class="card-body">
            <h4>{{ $hotel->name }}</h4>
            <p>evaluation: {{ $hotel->rating }} ⭐</p>
            @if($hotel->image)
                <h5 class="mt-4">image:</h5>
                <div class="row">
                    @foreach(json_decode($hotel->image) as $img)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('images/hotels/' . $img) }}" class="img-fluid rounded shadow-sm" alt="صورة الفندق">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">لا توجد صور حالياً.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('hotels.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection --}}
@extends('layout.app')

@section('content')
<style>
body {
    font-family: 'Cairo', sans-serif;
    background: linear-gradient(to right, #dbe9f4, #f0f4f8);
    margin: 0;
    padding: 20px;
}

.card {
    max-width: 900px;
    margin: auto;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    padding: 25px 30px;
}

h2 {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 20px;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
}

.card-body h4 {
    font-size: 22px;
    color: #34495e;
    margin-bottom: 10px;
}

.card-body p {
    font-size: 16px;
    color: #555;
}

.card-body h5 {
    color: #2c3e50;
    margin-top: 20px;
    margin-bottom: 10px;
}

/* صور الفندق */
img.img-fluid {
    width: 100%;
    border-radius: 10px;
    border: 2px solid #dcdde1;
    transition: 0.3s;
}

img.img-fluid:hover {
    transform: scale(1.05);
    border-color: #3498db;
}

/* زر العودة */
a.btn-secondary, a.a-show {
    display: inline-block;
    background: #3498db;
    color: white;
    text-decoration: none; /* شيل underline */
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s;
}

a.btn-secondary:hover, a.a-show:hover {
    background: #2980b9;
    transform: scale(1.03);
}

/* نصوص لا توجد صور */
.text-muted {
    font-size: 15px;
    color: #888 !important;
}
a.a-show {
    display: inline-block;
    background: #3498db;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s;
}

a .a-show:hover {
    background: #2980b9;
    transform: scale(1.03);
}
</style>

    <div class="card">
    <h2>Hotel details </h2>
        
        <div class="card-body">
            <h4>{{ $hotel->name }}</h4>
            <p>evaluation: {{ $hotel->rating }} ⭐</p>
            @if($hotel->image)
                <h5 class="mt-4">image:</h5>
                <div class="row">
                    @foreach(json_decode($hotel->image) as $img)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('images/hotels/' . $img) }}" class="img-fluid rounded shadow-sm" alt="صورة الفندق">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">لا توجد صور حالياً.</p>
            @endif
        </div>
     <a href="{{ route('hotels.index') }}" class="a-show mt-3">Back</a>

    </div>
@endsection
