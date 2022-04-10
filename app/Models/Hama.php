<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hama extends Model
{
    use HasFactory;
    protected $table = "tb_hama";
    protected $fillable = ['kd_hama','nm_hama','deskripsi','solusi','foto'];
    protected $primarykey = "kd_hama";
    public $timestamps = false;

    public function basisaturan(){
        return $this->hasMany(Basisaturan::class, 'id_basisaturan', 'id_basisaturan');
    }

    public function hasil(){
        return $this->hasMany(Hasil::class, 'id_hasil', 'id_hasil');
    }

}
