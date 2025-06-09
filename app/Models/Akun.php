<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Akun extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'email', 'password', 'role'
    ];

    protected $hidden = [
        'password'
    ];

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
}
