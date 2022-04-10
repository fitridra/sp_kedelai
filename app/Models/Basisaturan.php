<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basisaturan extends Model
{
    use HasFactory;
    protected $table = "tb_basisaturan";
    protected $fillable = ['id_basisaturan','kd_hama','id_gejala'];
    protected $primarykey = "id_basisaturan";
    public $timestamps = false;

    public function hama(){
		  return $this->belongsTo(Hama::class, 'kd_hama', 'kd_hama');
	}

    public function gejala(){
        return $this->belongsTo(Gejala::class, 'id_gejala', 'id_gejala');
  }
}

    