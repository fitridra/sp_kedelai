<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $table = "tb_hasil";
    protected $fillable = ['id_hasil','id','kd_hama','waktu','probabilitas'];
    protected $primarykey = "id_hasil";
    public $timestamps = false;

    public function hama(){
		  return $this->belongsTo(Hama::class, 'kd_hama', 'kd_hama');
	  }

    public function user(){
      return $this->belongsTo(User::class, 'id', 'id');
    }
}
