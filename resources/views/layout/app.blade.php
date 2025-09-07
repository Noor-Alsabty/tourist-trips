<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f7f9fc;
}

.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 200px;
    height: 100vh; 
    text-transform: capitalize;
    background-color: #2c3e50; 
    color: #ecf0f1;
    padding-top: 20px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}

.sidebar .layout {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar .layout .layout-li{
    padding: 20px;
}

.sidebar .layout .layout-li .layout-a {
    color: #ecf0f1;
    text-decoration: none;
    display: block;
}

.sidebar .layout .layout-li :hover {
    background-color: #34495e;
    border-radius: 4px;
}

.sidebar .layout .layout-li form .layout-btn {
    width: 100%;
    padding: 10px 20px;
    background-color: #e74c3c;
    border: none;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
}

.sidebar .layout .layout-li form .layout-btn:hover {
    background-color: #c0392b;
}

.main-content {
    margin-left: 200px;
    padding: 20px;
}
</style>
<body>
@yield('content')
<div class="sidebar">
        <ul class="layout">
            <li class="layout-li"><a href="{{ route('trips.index') }}" class="layout-a">trips</a></li>
            <li class="layout-li"><a href="{{ route('activities.index') }}" class="layout-a">activities</a></li>
            <li class="layout-li"><a href="{{ route('bookings.index') }}" class="layout-a">booking</a></li>
            <li class="layout-li"><a href="{{ route('hotels.index') }}" class="layout-a">hotels</a></li>
            <li class="layout-li"><a href="{{ route('admin.change-password') }}" class="layout-a">change password</a></li>
            <li class="layout-li"><form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="layout-btn">Logout</button>
    </form></li>
        </ul>
    </div>
</body>
</html>