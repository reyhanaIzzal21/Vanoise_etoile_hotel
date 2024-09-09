<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vanoise Etoile Hotel - Login</title>
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
            padding: 2rem;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .logo-vanoise {
            width: 100px;
            margin-bottom: 20px;
        }
        .h2-header {
            color: #EFD510;
            font-size: 35px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            color: #EFD510;
            margin-bottom: 0.5rem;
            text-align: left;
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
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            color: #FFF;
            margin-bottom: 1rem;
        }
        .checkbox-label input {
            margin-right: 0.5rem;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #FFF;
            width: 100%;
            background-color: #E94822;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }
        .btn:hover {
            background-color: #F2910A;
        }
        .link, .secondary-link {
            color: #EFD510;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link-tree .secondary-link {
            display: flex;
            align-items: end;
            justify-content: end;
        }
        .link:hover, .secondary-link:hover {
            color: #F2910A;
        }
        .link-tree{
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }
        .link-tree .link-lf{
            display: flex;
            flex-direction: column;
        }
        .link-tree .link-lf .link{
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="aset/logo-vanoise.png" alt="Vanoise Etoile Hotel Logo" class="logo-vanoise">

    <h2 class="h2-header">LOGIN</h2>

    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="new-email" />
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Remember Me -->
            <div class="checkbox-label">
                <input id="remember_me" type="checkbox" name="remember" />
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <div class="link-tree">
                <div class="link-lf">
                    <button type="submit" class="btn">{{ __('Log in') }}</button>
                </div>

                <a class="secondary-link" href="{{ route('register') }}">Belum Punya Akun? Daftar</a>
            </div>
        </form>
    </x-guest-layout>
</div>

</body>
</html>
