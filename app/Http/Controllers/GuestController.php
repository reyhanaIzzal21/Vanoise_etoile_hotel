<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::all();
        return view('guests.index', compact('guests'));
    }

    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:guests,email',
            'phone' => 'string|min:10|max:20',
        ]);

        Guest::create($request->all());

        return redirect()->route('guests.index')->with('success', 'Berhasil Membuat.');
    }

    public function show(Guest $guest)
    {
        return view('guests.show', compact('guest'));
    }

    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:guests,email,' . $guest->id,
            'phone' => 'string|min:10|max:20',
        ]);

        $guest->update($request->all());

        return redirect()->route('guests.index')->with('success', 'Berhasil Mengedit.');
    }

    public function destroy(Guest $guest)
    {
        if ($guest->reservations()->exists()) {
            return redirect()->route('guests.index')->withErrors(['message' => 'Tidak bisa menghapus, karena sedang dalam proses reservasi.']);
        }

        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Berhasil Menghapus.');
    }
}
