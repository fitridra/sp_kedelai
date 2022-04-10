<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $table = "tb_jawaban";
    protected $fillable = ['id_jawaban','id','id_gejala','pilihan','bobot'];
    protected $primarykey = "id_jawaban";
    public $timestamps = false;
}
