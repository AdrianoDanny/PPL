<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kambing extends Model
{
    use HasFactory;

    protected $fillable = [
        'berat', 'usia', 'status_tersedia', 'jenis',
        'harga', 'deskripsi', 'pemasok_id', 'foto_kambing'
    ];

    protected $casts = [
        'status_tersedia' => 'boolean',
        'harga' => 'decimal:2'
    ];

    public function pemasok()
    {
        return $this->belongsTo(Profil::class, 'pemasok_id');
    }
}
