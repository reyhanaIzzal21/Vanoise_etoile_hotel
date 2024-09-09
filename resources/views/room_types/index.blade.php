<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dafar Tipe Kamar</title>
    <style>
        body {
            background-color: #000000;
            color: #c4c4c4;
            font-family: Arial, sans-serif;
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
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #EFD510;
            color: #000000;
            margin-bottom: 20px;
        }
        .btn-primary:hover {
            background-color: #F2910A;
        }
        .alert-success {
            background-color: #38A169;
            color: #c4c4c4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-danger{
            background-color: #ff2f2f;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .card {
            background-color: #2C2D34;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .card h2 {
            font-weight: bold;
            font-size: 1.25rem;
            color: #EFD510;
            margin-bottom: 10px;
        }
        .card p {
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
            transition: background-color 0.3s ease;
        }
        .btn-group a.view {
            background-color: #007BFF;
            color: #FFFFFF;
        }
        .btn-group a.view:hover {
            background-color: #0056b3;
        }
        .btn-group a.edit {
            background-color: #FFC107;
            color: #000000;
        }
        .btn-group a.edit:hover {
            background-color: #e0a800;
        }
        .btn-group button.delete {
            background-color: #DC3545;
            color: #FFFFFF;
            border: none;
        }
        .btn-group .icon-aksi{
            width: 20px;
        }
        .btn-group button.delete:hover {
            background-color: #c82333;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body>

    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="h1-header">Daftar Tipe Kamar</h1>
    
        <a href="{{ route('room-types.create') }}" class="btn btn-primary">Tambah Tipe Kamar Baru</a>
    
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
    
        <div class="grid">
            @foreach($roomTypes as $roomType)
                <div class="card">
                    <h2>{{ $roomType->name }}</h2>
                    <p><strong>Deskripsi:</strong> {{ $roomType->description }}</p>
                    <div class="btn-group">
                        <a href="{{ route('room-types.show', $roomType->id) }}" class="view"><img class="icon-aksi" src="aset/show.png" alt=""></a>
                        <a href="{{ route('room-types.edit', $roomType->id) }}" class="edit"><img class="icon-aksi" src="aset/edit.png" alt=""></a>
                        <form action="{{ route('room-types.destroy', $roomType->id) }}" method="POST" class="delete-form">
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
