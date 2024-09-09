<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Menampilkan daftar kamar
    public function index()
    {
        $rooms = Room::with('roomType')->get();
        return view('rooms.index', compact('rooms'));
    }

    // Menampilkan form untuk menambah kamar baru
    public function create()
    {
        $roomTypes = RoomType::all();
        return view('rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'room_number' => 'string|max:50|unique:rooms,room_number',
            'room_type_id' => 'exists:room_types,id',
            'price' => 'numeric|min:1|max:100000000000',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $requiredFields = ['room_number', 'room_type_id', 'price'];
        foreach ($requiredFields as $field) {
            if (!$request->has($field)) {
                return redirect()->back()->withErrors(['message' => 'Data harus diisi semua'])->withInput();
            }
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hash nama file menggunakan sha1 dan tambahkan ekstensi
            $fileName = sha1(time() . $request->image->getClientOriginalName()) . '.' . $request->image->extension();
            $request->image->move(public_path('images/rooms'), $fileName);
            $data['image'] = $fileName;  // Simpan nama file ke dalam array $data
        }

        Room::create($data);  // Simpan data ke database

        return redirect()->route('rooms.index')->with('success', 'Berhasil Menambah Kamar Baru');
    }


    // Menampilkan detail kamar tertentu
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    // Menampilkan form untuk mengedit kamar
    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    // Memperbarui kamar di database
    public function update(Request $request, Room $room)
    {
        // Validasi input data
        $request->validate([
            'room_number' => 'string|max:50|unique:rooms,room_number,' . $room->id,
            'room_type_id' => 'exists:room_types,id',
            'price' => 'numeric|min:1|max:100000000000',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Memeriksa apakah semua input yang diperlukan sudah ada
        $requiredFields = ['room_number', 'room_type_id', 'price'];
        foreach ($requiredFields as $field) {
            if (!$request->has($field)) {
                return redirect()->back()->withErrors(['message' => 'Data harus diisi semua'])->withInput();
            }
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($room->image && file_exists(public_path('images/rooms/' . $room->image))) {
                unlink(public_path('images/rooms/' . $room->image));  // Hapus gambar lama
            }

            // Hash nama file menggunakan sha1 dan tambahkan ekstensi
            $fileName = sha1(time() . $request->image->getClientOriginalName()) . '.' . $request->image->extension();
            $request->image->move(public_path('images/rooms'), $fileName);
            $data['image'] = $fileName;  // Simpan nama file baru
        }

        $room->update($data);  // Update data di database

        return redirect()->route('rooms.index')->with('success', 'Berhasil Mengedit Kamar');
    }


    public function destroy(Room $room)
    {
        $activeReservations = Reservation::where('room_id', $room->id)->exists();

        if ($room->reservations()->exists()) {
            return redirect()->route('rooms.index')->with('cannot_delete', 'Tidak bisa menghapus kamar ini, karena sedang dalam proses reservasi.');
        }

        if ($room->image && file_exists(public_path('images/rooms/' . $room->image))) {
            unlink(public_path('images/rooms/' . $room->image));
        }

        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Berhasil Menghapus Kamar.');
    }
}
