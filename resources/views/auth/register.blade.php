<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vanoise Etoile Hotel - Register</title>
    <style>
        body {
            background: linear-gradient(135deg, #000000 0%, #2C2D34 100%);
            color: #FFFFFF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #1A1A1A;
            padding: 2.5rem;
            border-radius: 10px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .h2-header {
            color: #EFD510;
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 25px;
            font-weight: bold;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            color: #EFD510;
            margin-bottom: 0.5rem;
            text-align: left;
            font-weight: bold;
            display: block;
        }
        .form-group input {
            width: 90%;
            padding: 0.75rem;
            border-radius: 6px;
            border: 1px solid #444;
            background-color: #2C2D34;
            color: #FFF;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            border-color: #EFD510;
            outline: none;
        }
        .form-group .error-message {
            color: #DC3545;
            font-size: 0.875rem;
            text-align: left;
            margin-top: 0.5rem;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #FFF;
            background-color: #E94822;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1.5rem;
        }
        .btn:hover {
            background-color: #F2910A;
        }
        .link {
            color: #EFD510;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
            transition: color 0.3s ease;
        }
        .link:hover {
            color: #F2910A;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="h2-header">REGISTER</h2>

    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="new-text" />
                <x-input-error :messages="$errors->get('name')" class="error-message" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" :value="old('email')" required/>
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>

            <button type="submit" class="btn">{{ __('Register') }}</button>

            <a class="link" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        </form>
    </x-guest-layout>
</div>

</body>
</html>
