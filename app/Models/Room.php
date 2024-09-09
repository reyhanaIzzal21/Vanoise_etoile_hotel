<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model
    protected $table = 'rooms';

    // Tentukan kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'room_number',
        'room_type_id',
        'price',
        'description',
        'image',
    ];

    /**
     * Relasi dengan model RoomType
     * Satu Room dimiliki oleh satu RoomType
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Relasi dengan model Reservation
     * Satu Room bisa memiliki banyak Reservation
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
