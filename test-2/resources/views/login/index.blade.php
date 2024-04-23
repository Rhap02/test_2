<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #2ecc71; 
        }

        .login-container {
            background-color: #fff; 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 200px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #2ecc71;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #27ae60; 
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="logo-container">
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo">
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Username</label>
            <input id="email" type="text" name="name" required>
        </div>

        <div>
            <label for="password">PIN</label>
            <input id="password" type="password" name="password" required>
        </div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</div>

</body>
</html>
