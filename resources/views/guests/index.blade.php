<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Tamu</title>
    <style>
        body {
            background-color: #000000;
            color: #FFFFFF;
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
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-primary {
            background-color: #EFD510;
            color: #000000;
            margin-bottom: 20px;
        }
        .btn-primary:hover {
            background-color: #F2910A;
            transform: scale(1.05);
        }
        .alert-success {
            background-color: #38A169;
            color: #FFFFFF;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .alert-danger {
            background-color: #ff3535;
            color: #FFFFFF;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: #2C2D34;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .card h2 {
            font-weight: bold;
            font-size: 1.5rem;
            color: #EFD510;
            margin-bottom: 10px;
        }
        .card p {
            margin: 5px 0;
            font-size: 1rem;
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
            color: #FFFFFF;
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
        }
    </style>
</head>
<body>

    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="h1-header">Daftar Tamu</h1>
    
        <a href="{{ route('guests.create') }}" class="btn btn-primary">Tambah Tamu</a>
    
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        @if($errors->any())
            <div class="alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
    
        <div class="grid-container">
            @foreach($guests as $guest)
                <div class="card">
                    <h2>{{ $guest->name }}</h2>
                    <p><strong>Email:</strong> {{ $guest->email }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $guest->phone }}</p>
                    <div class="btn-group">
                        <a href="{{ route('guests.show', $guest->id) }}" class="view"><img class="icon-aksi" src="aset/show.png" alt=""></a>
                        <a href="{{ route('guests.edit', $guest->id) }}" class="edit"><img class="icon-aksi" src="aset/edit.png" alt=""></a>
                        <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="delete-form" style="display:inline;">
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
                    event.preventDefault(); // Mencegah form submit secara langsung
                    const confirmed = confirm('Apakah Anda yakin untuk menghapus?');
                    if (confirmed) {
                        form.submit(); // Jika dikonfirmasi, submit form
                    }
                });
            });
        });
    </script>
    


</body>
</html>
