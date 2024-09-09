<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model
    protected $table = 'room_types';

    // Tentukan kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi dengan model Room
     * Satu RoomType bisa memiliki banyak Room
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
