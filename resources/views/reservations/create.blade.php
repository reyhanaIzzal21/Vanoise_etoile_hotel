<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi</title>
    <style>
        body {
            background-color: #000000;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #1A1A1A;
            border-radius: 8px;
        }
        .h1-header {
            color: #EFD510;
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }
        .alert {
            background-color: #E94822;
            color: #FFFFFF;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .alert ul {
            list-style: none;
            padding: 0;
        }
        .alert li {
            margin-bottom: 0.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #EFD510;
        }
        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #333333;
            border-radius: 4px;
            background-color: #2C2D34;
            color: #1A1A1A;
        }

        .container-btn{
            display: flex;
            justify-content: space-between;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #1A1A1A;
            background-color: #F2910A;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #E94822;
        }
        .daftar-tamu{
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #1A1A1A;
            background-color: #F2910A;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .daftar-tamu:hover{
            background-color: #E94822;
        }
        .create-acount{
            display: flex;
        }
        .create-acount .p-bds{
            margin: 0.75rem;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="h1-header">Buat Reservasi</h1>

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

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="guest_id" class="form-label">Nama Tamu</label>
                <select class="form-select" id="guest_id" name="guest_id">
                    <option value="">Pilih Tamu</option>
                    @foreach($guests as $guest)
                        <option value="{{ $guest->id }}" {{ old('guest_id') == $guest->id ? 'selected' : '' }}>
                            {{ $guest->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="room_id" class="form-label">Kamar</label>
                <select class="form-select" id="room_id" name="room_id" >
                    <option value="">Pilih Kamar</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $reservation->room_id) == $room->id ? 'selected' : '' }} data-price="{{ $room->price }}">
                            {{ $room->room_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total_price" name="total_price" value="{{ old('total_price', $reservation->total_price) }}" >
            </div>
            
            <div class="mb-3">
                <label for="check_in_date" class="form-label">Tanggal Check-in</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="{{ old('check_in_date') }}" >
            </div>
            <div class="mb-3">
                <label for="check_out_date" class="form-label">Tanggal Check-out</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="{{ old('check_out_date') }}" >
            </div>
            <div class="container-btn">
                <button type="submit" class="btn btn-primary">Buat</button>
                <div class="create-acount">
                    <p class="p-bds">Belum Daftar Sebagai Tamu?</p>
                    <a class="daftar-tamu" href="{{route('guests.create')}}">Daftar</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('room_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            document.getElementById('total_price').value = price;
        });
    </script>
    @endsection

</body>
</html>
