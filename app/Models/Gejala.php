<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;
    protected $table = "tb_gejala";
    protected $fillable = ['id_gejala','nm_gejala','nilai_prior','nilai_cpt','nilai_posterior','foto'];
    protected $primarykey = "id_gejala";
    public $timestamps = false;

    public function basisaturan(){
        return $this->hasMany(Basisaturan::class, 'id_basisaturan', 'id_basisaturan');
    }

}
