<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Kamar</title>
    <style>
        body {
            background-color: #000000;
            color: #c4c4c4;
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
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            border-bottom: 2px solid #EFD510;
            padding-bottom: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-primary {
            background-color: #EFD510;
            color: #000000;
        }
        .btn-primary:hover {
            background-color: #F2910A;
            transform: scale(1.05);
        }
        .alert-success {
            background-color: #38A169;
            color: #c4c4c4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .alert-danger {
            background-color: #ff3232;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: #2C2D34;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #EFD510;
        }
        .card-content {
            padding: 15px;
        }
        .card-content h2 {
            color: #EFD510;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
            margin-bottom: 10px;
        }
        .card-content p {
            margin: 5px 0;
            font-size: 0.9rem;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
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
            color: #fff;
        }
        .btn-group a.view:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-group a.edit {
            background-color: #FFC107;
            color: #000000;
        }
        .btn-group a.edit:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }
        .btn-group button.delete {
            background-color: #DC3545;
            color: #FFFFFF;
            border: none;
        }
        .btn-group button.delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
        .btn-group .icon-aksi {
            width: 20px;
            height: 20px;
            border: none;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1-header">Daftar Kamar</h1>

    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Kamar Baru</a>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('cannot_delete'))
        <div class="alert-danger">
            {{ session('cannot_delete') }}
        </div>
    @endif

    <div class="grid">
        @foreach($rooms as $room)
            <div class="card">
                @if($room->image)
                    <img src="{{ asset('images/rooms/' . $room->image) }}" alt="Gambar Kamar">
                @endif
                <div class="card-content">
                    <h2>Kamar Nomor: {{ $room->room_number }}</h2>
                    <p><strong>Tipe:</strong> {{ $room->roomType->name }}</p>
                    <p><strong>Deskripsi:</strong> {{ $room->description }}</p>
                    <div class="btn-group">
                        <a href="{{ route('rooms.show', $room->id) }}" class="view"><img class="icon-aksi" src="aset/show.png" alt="View"></a>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="edit"><img class="icon-aksi" src="aset/edit.png" alt="Edit"></a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="delete-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete"><img class="icon-aksi" src="aset/delate.png" alt="Delete"></button>
                        </form>
                    </div>
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
