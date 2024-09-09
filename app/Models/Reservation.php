<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model
    protected $table = 'reservations';

    // Tentukan kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'room_id',
        'guest_id',
        'check_in_date',
        'check_out_date',
        'total_price',
    ];

    /**
     * Relasi dengan model Room
     * Satu Reservation dimiliki oleh satu Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relasi dengan model Guest
     * Satu Reservation dimiliki oleh satu Guest
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
