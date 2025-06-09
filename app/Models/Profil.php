<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id', 'nama', 'alamat_id', 'no_hp'
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }
    public function kambings()
    {
        return $this->hasMany(Kambing::class, 'pemasok_id');
    }
}
