<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'alamat',
        'hadir',
        'status',
    ];

    // Tambahkan cast untuk boolean
    protected $casts = [
        'hadir' => 'boolean',
        'status' => 'boolean',
    ];
}