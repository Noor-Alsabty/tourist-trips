@extends('layout.app')

@section('content')
<style>
body {
    font-family: 'Cairo', sans-serif;
    background: linear-gradient(to right, #e6f0f9, #f9fbfd);
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 750px;
    margin: auto;
    background: #fff;
    padding: 30px;
    text-transform: capitalize;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

h2 {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 25px;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
}

/* 🎨 كل حقل + ليبل */
.mb-3 {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
}

label {
    font-weight: bold;
    color: #34495e;
    margin-bottom: 6px;
}

/* 🎨 حقول الإدخال */
.form-control {
    border-radius: 8px;
    border: 1px solid #dcdde1;
    transition: 0.3s;
    padding: 12px 14px;
    font-size: 15px;
}

/* ألوان مختلفة للأنواع */
input[type="text"] { background: #ecf9ff; }
input[type="file"] { background: #f9f0ff; }
select { background: #f3f9ec; }

/* عند الفوكس */
.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 6px rgba(52,152,219,0.3);
    background: #fff;
    outline: none;
}

/* 🎨 الصور الحالية */
img {
    border-radius: 10px;
    border: 2px solid #dce6f0;
    transition: 0.3s;
}
img:hover {
    transform: scale(1.05);
    border-color: #3498db;
}

/* 🎨 زر التحديث */
.btn-primary {
    background: #3498db;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 10px;
    transition: 0.3s;
    width: 200px;
}

.btn-primary:hover {
    background: #fff;
    color: #3498db;
    border: 2px solid #3498db;
    transform: scale(1.03);
}
</style>
<div class="container">
    <h2> Update Hotel: </h2>

    <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label> name:</label>
            <input type="text" name="name" class="form-control" value="{{ $hotel->name }}">
        </div>
            @if($hotel->image)
    <div class="row mb-3">
        @foreach(json_decode($hotel->image) as $img)
            <div class="col-md-3">
                <img src="{{ asset('images/hotels/' . $img) }}" style="width: 100px" class="img-fluid rounded mb-2">
            </div>
        @endforeach
    </div>
@endif

<div class="mb-3">
    <label> new image (optional):</label>
    <input type="file" name="images[]" multiple class="form-control">
</div>
        

        {{-- <div class="mb-3">
            <label>change image: </label>
            <input type="file" name="image" class="form-control">
        </div> --}}

        <div class="mb-3">
            <label>evaluation:</label>
            <select name="rating" class="form-control">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $hotel->rating == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">update</button>
    </form>
</div>
@endsection

