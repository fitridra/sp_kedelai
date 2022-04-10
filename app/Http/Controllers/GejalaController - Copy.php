<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Jawaban;
use App\Models\Hasil;
use App\Models\Basisaturan;
use Carbon\Carbon;

class GejalaController extends Controller
{

	public function index_admin()
	{
		$data_gejala = Gejala::all();
		$id_gejala = $data_gejala->count('id_gejala');
		return view('gejala.index_admin', compact('data_gejala', 'id_gejala'));
	}

	public function tambah()
	{
		$nilai_prior = request()->nilai_prior;
		$nilai_cpt = request()->nilai_cpt;

		$present = $nilai_prior;
		$absent = 1 - $nilai_prior;

		$p_jpd = $nilai_prior * $present;
		$a_jpd = $nilai_cpt * $absent;

		$nilai_posterior = $p_jpd / ($p_jpd + $a_jpd);

		if (request()->foto != null) {
			$input_s = request()->file('foto')->store('gejala');
		} else {
			$input_s = NULL;
		}

		$gejala = new Gejala;
		$gejala->id_gejala = request()->id_gejala;
		$gejala->nm_gejala = request()->nm_gejala;
		$gejala->nilai_prior = request()->nilai_prior;
		$gejala->nilai_cpt = request()->nilai_cpt;
		$gejala->nilai_posterior = $nilai_posterior;
		$gejala->foto = $input_s;
		$gejala->save();

		return redirect()->route('gejala')->with('sukses', 'Data Berhasil Ditambahkan');
	}

	public function edit($id)
	{
		$gejala = Gejala::where('id_gejala', $id)->first();
		return view('gejala/edit', compact('gejala'));
	}

	public function update(Request $request, $id)
	{
		$nilai_prior = $request->nilai_prior;
		$nilai_cpt = $request->nilai_cpt;

		$present = $nilai_prior;
		$absent = 1 - $nilai_prior;

		$p_jpd = $nilai_prior * $present;
		$a_jpd = $nilai_cpt * $absent;

		$nilai_posterior = $p_jpd / ($p_jpd + $a_jpd);

		$gejala = Gejala::where('id_gejala', $id)->first();

		$gejala->where('id_gejala', $gejala->id_gejala)
			->update([
				'nm_gejala' => $request->input('nm_gejala'),
				'nilai_prior' => $request->input('nilai_prior'),
				'nilai_cpt' => $request->input('nilai_cpt'),
				'nilai_posterior' => $nilai_posterior,
			]);
		return redirect()->route('gejala')->with('sukses', 'Data Berhasil Diubah');
	}

	public function updatefoto(Request $request, $id)
	{

		$gejala = Gejala::where('id_gejala', $id)->first();

		if ($request->foto != null) {
			$input_s = $request->file('foto')->store('gejala');
		} else {
			$input_s = NULL;
		}

		$gejala->where('id_gejala', $gejala->id_gejala)
			->update([
				'foto' => $input_s,
			]);
		return redirect()->route('gejala')->with('sukses', 'Gambar Gejala Berhasil Diubah');
	}

	public function delete($id)
	{

		Gejala::where('id_gejala', $id)->delete();
		return redirect()->route('gejala')->with('sukses', 'Data Berhasil Dihapus');
	}

	public function konsultasi()
	{
		$hapus_jawaban = Jawaban::where('tanggal', '>', Carbon::now()->subDays(1))->get();
		foreach ($hapus_jawaban as $hapus) {
			$hapus->delete();
		}

		// dd($hapus_jawaban);
		return view('konsultasi.konsultasi', compact('hapus_jawaban'));
	}

	public function mulai()
	{
		return redirect()->route('konsultasi_detail');
	}

	public function konsultasi_detail()
	{
		$dataJawaban = Jawaban::where('id', auth()->user()->id)->pluck('id_gejala')->toArray();
		$pilihanJawaban = Jawaban::where('id', auth()->user()->id)->pluck('pilihan')->toArray();;
		$jumlahJawaban = Jawaban::where('id', auth()->user()->id)->count('id_jawaban');

		$uy = $jumlahJawaban - 1;
		$uy2 = $uy - 1;

		$al = $pilihanJawaban[$uy];
		$al2 = $pilihanJawaban[$uy2];

		// dd($al.'+'.$al2);


		if ($dataJawaban = null) {
			$urutGejala1 = Basisaturan::groupby('id_gejala') // mencari gejala terbanyak irisannya (g6)
				->orderByRaw('COUNT(*) DESC')
				->pluck('id_gejala');
			$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $urutGejala1[0])->first();

			// dd($tampilGejala);

		} elseif ($dataJawaban != null) {
			if ($pilihanJawaban[0] == 1) {
				if ($al == 1 && $al2 == 1) {
					$tampilGejala = Basisaturan::select('kd_hama')->whereIn('id_gejala', [$dataJawaban[$uy], $dataJawaban[$uy2]])
						->groupby('kd_hama')->orderByRaw('COUNT(*) DESC')->pluck('kd_hama')->first();

					// dd($tampilGejala);
					// dd($tampilGejala);
				}
			} elseif ($pilihanJawaban[0] == 0) {
				# code...
			}
		}

		// // dd($urutGejala1);

		// $urutGejala1 = Basisaturan::groupby('id_gejala') // mencari gejala terbanyak irisannya (g6)
		// 	->orderByRaw('COUNT(*) DESC')
		// 	->pluck('id_gejala');

		// $au = Basisaturan::where('id_gejala', $urutGejala1[0])->pluck('id_gejala')->count('id_gejala');

		// // dd($au);

		// $yey = Basisaturan::select('kd_hama')
		// 	->whereIn('id_gejala', $dataJawaban)
		// 	->pluck('kd_hama')->toArray();

		// // dd($yey);

		// $urutGejala2 = Basisaturan::select('kd_hama') //dari irisan tersebut dicari berhubungan dengan hama mana saja (5 kode hama g6)
		// 	->where('id_gejala', $urutGejala1[0])
		// 	->whereNotIn('kd_hama', $yey)
		// 	->pluck('kd_hama');

		// // dd($urutGejala2);

		// $e = Basisaturan::select('id_gejala') // lalu dari hama tersebut dilihat mana gejala yang berhubungan setelah gejala sebelumnya (seluruh gejala dari 5 hama yang memiliki g6)
		// 	->whereIn('kd_hama', $urutGejala2)
		// 	->groupby('id_gejala')
		// 	->orderByRaw('COUNT(*) DESC')
		// 	->whereNotIn('id_gejala', [$dataJawaban])
		// 	->pluck('id_gejala')->toArray();

		// $kuy = Basisaturan::select('id_basisaturan')
		// 	->where('id_gejala', $e[0])
		// 	->pluck('id_basisaturan')->toArray();

		// $love = array_map(function ($b) {
		// 	return $b + 1;
		// }, $kuy);

		// $kuy2 = Basisaturan::select('id_gejala')
		// 	->whereIn('id_basisaturan', $love)
		// 	->pluck('id_gejala')->toArray();

		// $f = array_search($e[0], $e);
		// // $g = $f+1;

		// $c = Hasil::select('kd_hama')  //lalu dari 5 hama g6 tersebut dilihat hama mana paling banyak berdasarkan data hasil
		// 	->whereIn('kd_hama', $urutGejala2)
		// 	->groupby('kd_hama')
		// 	->orderByRaw('COUNT(*) DESC')
		// 	->pluck('kd_hama');

		// // dd($c);

		// $d = Basisaturan::select('id_gejala') //lalu dari hama tersebut dilihat gejala nya apa saja dari hama terbanyak tadi
		// 	->where('kd_hama', $c[0])
		// 	->pluck('id_gejala')->toArray();

		// $j = array_search($d[0], $d);
		// $k = $j + 1;

		// // dd($d);

		// // if ($au != 1) {
		// // 	dd($e[$g]);
		// // }elseif ($au == 1) {
		// // 	dd($d[$k]);
		// // }

		// if ($jumlahJawaban == null) {
		// 	$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $urutGejala1[0])->first();
		// } elseif ($jumlahJawaban != null) {
		// 	if ($pilihanJawaban[0] == 1) {
		// 		// $tampilGejala = $d[$g];
		// 		// dd($tampilGejala);
		// 		if ($au != 1) {
		// 			$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $kuy2[$f])->first();
		// 		} elseif ($au == 1) {
		// 			$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $d[$j])->first();
		// 		}
		// 	} elseif ($pilihanJawaban[0] == 0) {
		// 		dd("G3");
		// 	}
		// }
		return view('konsultasi.konsultasi_detail');
	}

	public function r2()
	{
		$konsultasi = new Jawaban;
		$konsultasi->id = auth()->user()->id;
		$konsultasi->id_gejala = request()->id_gejala;
		$konsultasi->pilihan = request()->pilihan;
		$konsultasi->bobot = request()->bobot;
		$konsultasi->tanggal = now();
		$konsultasi->save();

		return redirect()->route('konsultasi_detail');
	}

	public function selesai()
	{
		// dd('selesai');
		$array = Jawaban::where('id', auth()->user()->id)->get();

		$total = $array->sum('bobot');
		$count = $array->whereNotIn('bobot', [0.00, 0.00])->count('bobot');

		$data = $array->where('pilihan', 1)->pluck('id_gejala');

		$hama = Basisaturan::select('kd_hama')
			->whereIn('id_gejala', $data)
			->groupby('kd_hama')
			->orderByRaw('COUNT(*) DESC')
			->pluck('kd_hama')->take(3);

		$hasil_ = new Hasil;
		$hasil_->id = auth()->user()->id;
		$hasil_->kd_hama = $hama;
		$hasil_->waktu = Carbon::now();
		$hasil_->probabilitas = $total / $count;
		$hasil_->save();

		$hasil = Hasil::where('id', auth()->user()->id)->latest('id_hasil')->first();

		return view('hasil/detail1', compact('hasil', 'array', 'total', 'count', 'hama', 'data', 'hasil_'));
	}
}
