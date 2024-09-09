<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model
    protected $table = 'guests';

    // Tentukan kolom yang bisa diisi melalui mass assignment
    protected $fillable = ['name', 'email', 'phone',];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
