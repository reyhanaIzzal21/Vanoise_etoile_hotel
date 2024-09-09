<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar sebagai tamu</title>
    <style>
        body {
            background-color: #000000;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #1A1A1A;
            border-radius: 8px;
        }
        .h1-header {
            color: #EFD510;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }
        .alert {
            background-color: #E94822;
            color: #FFFFFF;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .alert ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .alert li {
            margin-bottom: 0.5rem;
        }
        .item {
            margin-bottom: 1rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #EFD510;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            border: 1px solid #333333;
            background-color: #2C2D34;
            color: #1A1A1A;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: bold;
            color: #1A1A1A;
            border: none;
            border-radius: 4px;
            background-color: #F2910A;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-top: 1rem;
        }
        .btn:hover {
            background-color: #E94822;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="h1-header">Daftar Tamu</h1>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                <li>Data harus di isi semua.</li>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form action="{{ route('guests.store') }}" method="POST">
            @csrf
            <div class="item">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
            </div>
            <div class="item">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" >
            </div>
            <div class="item">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" >
            </div>
            <button type="submit" class="btn">Buat</button>
        </form>
    </div>
    @endsection

</body>
</html>
