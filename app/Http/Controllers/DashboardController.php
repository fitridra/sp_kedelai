<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hasil;
use App\Models\Hama;
use App\Models\Gejala;
use App\Models\Basisaturan;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
  {
    $hasil = Hasil::where('id', auth()->user()->id)->latest('id_hasil')->take(4)->get();
    $data_hama = Hama::take(3)->get();

    return view('dashboard.index',compact('hasil','data_hama'));
  }

  public function index_admin()
  {
    $tk = Hasil::all()->count('id_hasil');
    $jh = Hama::all()->count('kd_hama');
    $jg = Gejala::all()->count('kd_gejala');
    $jba = Basisaturan::all()->count('id_basisaturan');
    $jp = User::all()->count('id');
    return view('dashboard.index_admin', compact('tk', 'jh', 'jg', 'jba', 'jp'));
  }

  public function pengaturan()
  {
    return view('dashboard.pengaturan');
  }
}
