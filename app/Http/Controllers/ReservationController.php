<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Guest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room', 'guest'])->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create(Reservation $reservation)
    {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('reservations.create', compact('reservation', 'rooms', 'guests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'exists:guests,id',
            'room_id' => 'exists:rooms,id',
            'check_in_date' => 'date|after_or_equal:today',
            'check_out_date' => 'date|after:check_in_date',
            'total_price' => 'numeric|min:1|max:100000000000',
        ]);

        $overlappingReservation = Reservation::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('check_in_date', '<=', $request->check_in_date)
                            ->where('check_out_date', '>=', $request->check_out_date);
                    });
            })
            ->exists();

        if ($overlappingReservation) {
            return redirect()->back()->withErrors(['message' => 'Kamar sudah dipesan untuk tanggal yang dipilih.']);
        }

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Berhasil Membuat Reservasi.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('reservations.edit', compact('reservation', 'rooms', 'guests'));
    }

    // Update the reservation
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in_date' => 'date|after_or_equal:today',
            'check_out_date' => 'date|after:check_in_date',
            'total_price' => 'required|numeric|min:1|max:100000000000',
        ]);

        // Validasi unikasi reservasi untuk room_id dan rentang tanggal
        $overlappingReservation = Reservation::where('room_id', $request->room_id)
            ->where('id', '!=', $reservation->id) // Ignore current reservation
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('check_in_date', '<=', $request->check_in_date)
                            ->where('check_out_date', '>=', $request->check_out_date);
                    });
            })
            ->exists();

        if ($overlappingReservation) {
            return redirect()->back()->withErrors(['message' => 'Kamar sudah dipesan untuk tanggal yang dipilih.']);
        }

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Berhasil Mengedit Reservasi.');
    }

    // Menghapus reservasi dari database
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Berhasil Menghapus Reservasi.');
    }
}
