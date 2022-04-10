<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    public $rememberToken = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role'
    ];

    public function hasil(){
        return $this->hasMany(Hasil::class, 'kd_hama', 'kd_hama');
    }
}
