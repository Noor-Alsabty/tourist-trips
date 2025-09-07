<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
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
        h2{
            color: #007bff;
            text-align: center;
            font-family: Arial, sans-serif;
            font-weight: 700;
        }
        form {
        width: 500px;
        height: 400px;
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

    input[type="submit"] {
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

    input[type="submit"]:hover {
        background-color: #031425c0;
}
</style>
</head>
<body>
    <form action="{{ route('login') }}" method="POST">
    @csrf
    <h2>login</h2>
    <label for="email">the email</label>
    <input type="email" name="email">
    <label for="password">the password</label>
    <input type="password" name="password">
    <input type="submit" value="Send">
    </form>
</body>
</html>