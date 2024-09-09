<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    // Menampilkan daftar tipe kamar
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('room_types.index', compact('roomTypes'));
    }

    // Menampilkan form untuk menambah tipe kamar baru
    public function create()
    {
        return view('room_types.create');
    }

    // Menyimpan tipe kamar baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:room_types,name',
            'description' => 'nullable|string',
        ]);

        // Check if the fields are filled
        if (empty($request->input('name')) || empty($request->input('description'))) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Data harus diisi semua']);
        }

        RoomType::create($request->all());
        return redirect()->route('room-types.index')->with('success', 'Berhasil Menambah Tipe Kamar Baru');
    }

    // Menampilkan detail tipe kamar tertentu
    public function show(RoomType $roomType)
    {
        return view('room_types.show', compact('roomType'));
    }

    // Menampilkan form untuk mengedit tipe kamar
    public function edit(RoomType $roomType)
    {
        return view('room_types.edit', compact('roomType'));
    }

    // Memperbarui tipe kamar di database
    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:room_types,name,' . $roomType->id,
            'description' => 'nullable|string',
        ]);

        // Check if the fields are filled
        if (empty($request->input('name')) || empty($request->input('description'))) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Data harus diisi semua']);
        }

        $roomType->update($request->all());
        return redirect()->route('room-types.index')->with('success', 'Berhasil Mengedit Tipe Kamar.');
    }

    public function destroy(RoomType $roomType)
    {
        if ($roomType->rooms()->count() > 0) {
            return redirect()->route('room-types.index')
                ->with('error', 'Tidak bisa menghapus tipe kamar ini, karena sedang digunakan.');
        }

        $roomType->delete();
        return redirect()->route('room-types.index')
            ->with('success', 'Berhasil Menghapus Tipe Kamar.');
    }
}
