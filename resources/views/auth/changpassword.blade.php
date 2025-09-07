@extends('layout.app')
@section('title','change password')
@section('content')
<style>
body{
            width: 100%;
            height: 100vh; 
            margin: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center; 
            background-color: #007bff;
            
        }
        h3{
            color: #007bff;
            text-align: center;
            font-family: Arial, sans-serif;
            font-weight: 700;
            font-size: 30px;
        }
       .form-change {
        width: 600px;
        height: 600px;
        background-color: #fff;
        padding: 30px; 
        margin: 20px;  
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.57);
        display: flex;
        flex-direction: column;
        gap: 15px;
        font-family: Arial, sans-serif;
        font-weight: 700;
        text-transform: capitalize;
}

    label {
        font-size: 16px;
        margin-bottom: 5px;
        color: #333;
}

    input{
        font-size: 16px;
        padding: 12px 15px;
        height: 42px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        width: 100%;
        box-sizing: border-box;
        background-color: white;
}

    input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

    .btn-change {
        font-size: 16px;
        height: 40px;
        background-color: #007bff;
        margin-top: 35px;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 80%;             
        align-self: center;     
}
    .btn-change:hover {
        background-color: #031425c0;
}

</style>
    <form method="POST" action="{{ route('admin.update-password') }}" class="form-change">
    @csrf
    <h3>change password</h3>
    <label>Old Password :</label><br>
    <input type="password" name="old_password" required><br><br>

    <label> New password:</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm the new password :</label><br>
    <input type="password" name="new_password_confirmation" required><br><br>

    <button type="submit" class="btn-change"> update </button>
</form>
@endsection

