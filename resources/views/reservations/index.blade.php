<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Reservasi</title>
    <style>
        body {
            background-color: #000;
            color: #FFF;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .h1-header {
            color: #EFD510;
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: bold;
            border-bottom: 2px solid #EFD510;
            padding-bottom: 10px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-bottom: 20px;
            background-color: #EFD510;
            color: #000;
        }
        .btn:hover {
            background-color: #F2910A;
            transform: scale(1.05);
        }
        .alert-success {
            background-color: #38A169;
            color: #FFF;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .reservation-card {
            background-color: #2C2D34;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .reservation-card:hover {
            transform: translateY(-5px);
        }
        .reservation-card .h2-header {
            font-weight: bold;
            color: #EFD510;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .reservation-card p {
            margin: 5px 0;
            font-size: 1rem;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }
        .btn-group a, .btn-group button {
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-group a.view {
            background-color: #007BFF;
            color: #FFF;
        }
        .btn-group a.view:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-group a.edit {
            background-color: #FFC107;
            color: #000;
        }
        .btn-group a.edit:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }
        .btn-group button.delete {
            background-color: #DC3545;
            color: #FFF;
            border: none;
        }
        .btn-group button.delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
        .btn-group .icon-aksi {
            width: 20px;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1-header">Daftar Reservasi</h1>

    <a href="{{ route('reservations.create') }}" class="btn">Tambah Reservasi Baru</a>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-grid">
        @foreach($reservations as $reservation)
            <div class="reservation-card">
                <h2 class="h2-header">{{ $reservation->guest->name }}</h2>
                <p><strong>Kamar Nomor:</strong> {{ $reservation->room->room_number }}</p>
                <p><strong>Check-in:</strong> {{ $reservation->check_in_date }}</p>
                <p><strong>Check-out:</strong> {{ $reservation->check_out_date }}</p>
                <p><strong>Total Harga:</strong> Rp{{ number_format($reservation->total_price, 2, ',', '.') }}</p>
                <div class="btn-group">
                    <a href="{{ route('reservations.show', $reservation->id) }}" class="view"><img class="icon-aksi" src="aset/show.png" alt="View"></a>
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="edit"><img class="icon-aksi" src="aset/edit.png" alt="Edit"></a>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete"><img class="icon-aksi" src="aset/delate.png" alt=""></button>
                    </form>                    
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); 
                const confirmed = confirm('Apakah Anda yakin untuk menghapus?');
                if (confirmed) {
                    form.submit(); 
                }
            });
        });
    });
</script>


</body>
</html>
