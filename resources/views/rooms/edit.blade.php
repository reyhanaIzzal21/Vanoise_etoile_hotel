<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kamar</title>
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
        .form-control, .form-select, .form-textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #333333;
            border-radius: 4px;
            background-color: #2C2D34;
            color: #1A1A1A;
        }
        .form-select, .form-textarea {
            padding: 0.75rem;
        }
        .form-textarea {
            resize: vertical;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #FFFFFF;
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
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="h1-header">Edit Kamar</h1>

        @if($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="room_number" class="form-label">Nomor Kamar</label>
                <input type="text" class="form-control" id="room_number" name="room_number" value="{{ old('room_number', $room->room_number) }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $room->price) }}">
            </div>
            <div class="mb-3">
                <label for="room_type_id" class="form-label">Tipe Kamar</label>
                <select class="form-select" id="room_type_id" name="room_type_id">
                    <option value="">Select Room Type</option>
                    @foreach($roomTypes as $roomType)
                        <option value="{{ $roomType->id }}" {{ old('room_type_id', $room->room_type_id) == $roomType->id ? 'selected' : '' }}>
                            {{ $roomType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-textarea" id="description" name="description">{{ old('description', $room->description) }}</textarea>
            </div>

            @if($room->image)
            <div class="mb-3">
                <label for="current_image" class="form-label">Gambar Saat Ini</label>
                <br>
                <img src="{{ asset('images/rooms/' . $room->image) }}" alt="Gambar Kamar" style="max-width: 200px;">
            </div>
        @endif
        
        <div class="mb-3">
            <label for="image" class="form-label">Foto Kamar</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        

            <button type="submit" class="btn">Update</button>
        </form>
    </div>
    @endsection

</body>
</html>
