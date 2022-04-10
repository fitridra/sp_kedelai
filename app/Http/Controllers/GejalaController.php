<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Jawaban;
use App\Models\Hasil;
use App\Models\Basisaturan;
use Illuminate\Support\Facades\Auth;
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
		$nilai_prior = $request->nilai_prior; //GaHa
		$nilai_cpt = $request->nilai_cpt; //GaHt

		$priorAda = $nilai_prior;
		$priorTidakada = 1 - $nilai_prior;

		$JPD_GaHa = $nilai_prior * $priorAda;
		$JPD_GaHt = $nilai_cpt * $priorTidakada;

		$nilai_posterior = $JPD_GaHa / ($JPD_GaHa + $JPD_GaHt);

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
		$hapus_jawaban = Jawaban::where('id', auth()->user()->id)->get();
		foreach ($hapus_jawaban as $hapus) {
			$hapus->delete();
		}

		return view('konsultasi.konsultasi', compact('hapus_jawaban'));
	}

	public function mulai()
	{
		return redirect()->route('konsultasi_detail');
	}

	public function konsultasi_detail()
	{
		$dataJawaban = Jawaban::where('id', auth()->user()->id)->orderBy('id_jawaban', 'asc')->pluck('id_gejala')->toArray(); //daftar data jawaban
		$pilihanJawaban = Jawaban::where('id', auth()->user()->id)->pluck('pilihan')->toArray(); //pilihan dari data jawaban (salah/benar)
		$jumlahJawaban = Jawaban::where('id', auth()->user()->id)->count('id_jawaban'); //jumlah jawaban saat ini

		$irisanGejala1 = Basisaturan::groupby('id_gejala') // mencari gejala terbanyak irisannya pertama kali
			->orderByRaw('COUNT(*) DESC')
			->pluck('id_gejala')->toArray();

		if ($jumlahJawaban == null) { //jika jawaban masih nol
			$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $irisanGejala1[0])->first(); //tampilkan gejala berdasarkan irisan terbanyak
		} elseif ($jumlahJawaban == 1) { //jika jawaban sama dengan 1
			$jumlahIrisan = Basisaturan::where('id_gejala', $irisanGejala1[0])->pluck('id_gejala')->count('id_gejala'); //jumlah data dari irisan terbesar

			$hubHama1 = Basisaturan::select('kd_hama') //dari irisan tersebut dicari berhubungan dengan hama mana saja
				->where('id_gejala', $irisanGejala1[0])
				->pluck('kd_hama')->toArray();

			$hubGejala1 = Basisaturan::select('id_gejala') // lalu dari hama tersebut dilihat mana gejala yang berhubungan setelah gejala sebelumnya (seluruh gejala dari 5 hama)
				->whereIn('kd_hama', $hubHama1)
				->groupby('id_gejala')
				->orderByRaw('COUNT(*) DESC')
				->pluck('id_gejala')
				->whereNotIn('id_gejala', [$dataJawaban])
				->toArray();

			$idBasis = Basisaturan::select('id_basisaturan') //diambil id dari gejala tersebut
				->where('id_gejala', $hubGejala1[0])
				->pluck('id_basisaturan')->toArray();

			$callBack = array_map(function ($arrayData) {
				return $arrayData + 1;
			}, $idBasis);

			$idBasisGejala = Basisaturan::select('id_gejala') //dari id tersebut di ambil nilai gejala setelahnya yang berhubungan
				->whereIn('id_basisaturan', $callBack)
				->pluck('id_gejala')->toArray();

			$indexBasisGejala = array_search($hubGejala1[0], $hubGejala1); //mencari index pada array dari gejala tersebut

			$hamaHasil = Hasil::select('kd_hama')  //melihat hama mana paling banyak berdasarkan data hasil dari seluruh hama yang berhubungan tadi
				->whereIn('kd_hama', $hubHama1)
				->groupby('kd_hama')
				->orderByRaw('COUNT(*) DESC')
				->pluck('kd_hama')->toArray();

			$gejalaHasil = Basisaturan::select('id_gejala') //lalu dari hama tersebut dilihat gejala nya apa saja dari hama terbanyak tadi
				->where('kd_hama', $hamaHasil[0])
				->pluck('id_gejala')->toArray();

			$cariIndexHasil = array_search($gejalaHasil[0], $gejalaHasil); //mencari index pada array dari gejala data hasil tersebut
			$indexHasil = $cariIndexHasil + 1;

			$hamaJawaban1 = Basisaturan::select('kd_hama')->where('id_gejala', $dataJawaban[0])->pluck('kd_hama')->toArray(); //mengambil data hama dari gejala pertama

			$notGejala = Basisaturan::select('id_gejala') //mencari gejala kecuali dari data hama jawaban pertama karna di jawab tidak
				->whereNotIn('kd_hama', $hamaJawaban1)
				->groupby('id_gejala')
				->orderByRaw('COUNT(*) DESC')
				->pluck('id_gejala')->toArray();
			if ($pilihanJawaban[0] == 1) { //jika user memilih ya pada pilihan pertama
				if ($jumlahIrisan != 1) { //jika jumlah gejala dari irisan ini setelahnya memiliki kemungkinan lebih dari 1
					$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $gejalaHasil[$indexHasil])->first(); //tampilkan gejala berdasarkan data hasil terbanyak
				} elseif ($jumlahIrisan == 1) { //jika kemungkinan gejala setelahnya adalah 1
					$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $callBack[0])->first(); //tampilkan gejala berdasarkan gejala yang terjadi setelahnya
				}
			} elseif ($pilihanJawaban[0] == 0) { //jika user memilih tidak pada pilihan pertama
				$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $notGejala[0])->first(); //tampilkan gejala dengan irisan terbesar lainnya
			}
		} elseif ($jumlahJawaban > 1) { //jika jumlah jawaban sudah lebih dari 1
			$lastIndex = $jumlahJawaban - 1; //index terakhir
			$firstIndex = $lastIndex - 1; //index awal

			$firstPilihan = $pilihanJawaban[$firstIndex]; //jawaban di index awal
			$lastPilihan = $pilihanJawaban[$lastIndex]; //jawaban di index akhir

			if ($firstPilihan == 1 && $lastPilihan == 1) { //jika kedua pilihan di jawab iya
				$indexHama = Basisaturan::select('kd_hama') //hama pada gejala yang terdapat pada dua index 
					->where('id_gejala', [$dataJawaban[$lastIndex], $dataJawaban[$firstIndex]])
					->groupby('kd_hama')
					->orderByRaw('COUNT(*) DESC')
					->pluck('kd_hama');

				$indexGejala =  Basisaturan::select('id_gejala')
					->whereIn('kd_hama', $indexHama)
					->whereNotIn('id_gejala', $dataJawaban)
					->pluck('id_gejala')->toArray();

				if ($indexHama->count('kd_hama') != 1) { // jika hasil hama pada index lebih dari satu
					$hamaHasil = Hasil::select('kd_hama') //melihat hama berdasarkan data hasil
						->whereIn('kd_hama', $indexHama)
						->groupby('kd_hama')
						->orderByRaw('COUNT(*) DESC')
						->pluck('kd_hama')->toArray();

					if ($hamaHasil == null) {
						return redirect()->route('selesai');
					} elseif ($hamaHasil != null) {
						$gejalaHama = Basisaturan::select('id_gejala') //lalu dari hama tersebut dilihat gejala nya apa saja dari hama terbanyak tadi
							->where('kd_hama', $hamaHasil[0])
							->pluck('id_gejala')->toArray();

						$tampilGejala = Basisaturan::select('id_gejala') // tampilkan gejala berdasarkan data hasil
							->whereIn('id_gejala', $gejalaHama)
							->first();
					}
				} elseif ($indexHama->count('kd_hama') == 1) { //jika hasil hama pada index tersebut sama dengan satu
					if ($indexGejala == null) {
						return redirect()->route('selesai');
					} elseif ($indexGejala != null) {
						$tampilGejala = Basisaturan::select('id_gejala') //tampilkan gejala berdasarkan gejala setelahnya
							->whereIn('kd_hama', $indexGejala)
							->first();
					}
				}
			} elseif ($firstPilihan == 1 && $lastPilihan == 0) { //jika hanya pilihan pertama yang dijawab iya
				$firstHama = Basisaturan::select('kd_hama') //hama pada gejala yang dipilih pertama
					->whereIn('id_gejala', [$dataJawaban[$firstIndex]])
					->pluck('kd_hama')->toArray();

				$firstGejala = Basisaturan::select('id_gejala') //mencari gejala dengan irisan terbanyak pada hama gejala yang pertama
					->whereIn('kd_hama', $firstHama)
					->groupby('id_gejala')
					->orderByRaw('COUNT(*) DESC')
					->pluck('id_gejala')
					->whereNotIn('id_gejala', [$dataJawaban])
					->toArray();

				$idBasis = Basisaturan::select('id_basisaturan') //id dari gejala dengan irisan terbanyak
					->where('id_gejala', $firstGejala[0])
					->pluck('id_basisaturan')->toArray();

				$callBack = array_map(function ($arrayData) {
					return $arrayData + 1;
				}, $idBasis);

				$callbackHama = Basisaturan::select('kd_hama')
					->whereIn('id_basisaturan', $callBack)
					->whereNotIn('id_gejala', $dataJawaban)
					->pluck('kd_hama')->toArray();

				$hamaHasil = Hasil::select('kd_hama') //mencari hama terbanyak berdasarkan data hasil
					->where('kd_hama', $callbackHama[0])
					->groupby('kd_hama')
					->orderByRaw('COUNT(*) DESC')
					->pluck('kd_hama')->toArray();

				$gejalaHasil = Basisaturan::select('id_gejala') //lalu dari hama tersebut dilihat gejala nya apa saja dari hama terbanyak tadi
					->where('kd_hama', $hamaHasil)
					->pluck('id_gejala')->toArray();

				$jumlahIrisan = Basisaturan::where('id_gejala', $dataJawaban[$firstIndex])->pluck('id_gejala')->count('id_gejala'); //mencari jumlah irisan dari gejala

				if ($jumlahIrisan != 1) { //jika jumlah lebih dari satu
					if ($gejalaHasil == null) {
						return redirect()->route('selesai');
					} elseif ($gejalaHasil != null) {
						$indexJawaban1 = array_search($dataJawaban[$firstIndex], $gejalaHasil);  //mencari index dari jawaban terakhir user dari data hasil
						$indexJawaban2 = $indexJawaban1 + 1; //index setelah jawaban user dari data hasil

						$tampilGejala = Basisaturan::select('id_gejala') //mencampilkan gejala dari data hasil
							->where('id_gejala', $gejalaHasil[$indexJawaban2])
							->whereNotIn('id_gejala', $dataJawaban)
							->first();
					}
				} elseif ($jumlahIrisan == 1) { //jika jumlah sama dengan 1
					if ($callBack == null) {
						return redirect()->route('selesai');
					} elseif ($callBack != null) {
						$tampilGejala = Basisaturan::select('id_gejala') //menampilkan gejala selanjutnya dari gejala sebelumnya
							->where('id_basisaturan', $callBack[0])
							->whereNotIn('id_gejala', $dataJawaban)
							->groupby('id_gejala')
							->orderByRaw('COUNT(*) DESC')
							->first();
					}
				}
			} elseif ($firstPilihan == 0 && $lastPilihan == 1) { //jika hanya pilihan terakhir yang di jawab iya
				$lastHama = Basisaturan::select('kd_hama') //hama pada gejala yang dipilih pertama
					->whereIn('id_gejala', [$dataJawaban[$lastIndex]])
					->pluck('kd_hama')->toArray();

				$lastGejala = Basisaturan::select('id_gejala') //mencari gejala dengan irisan terbanyak pada hama gejala yang pertama
					->whereIn('kd_hama', $lastHama)
					->groupby('id_gejala')
					->orderByRaw('COUNT(*) DESC')
					->pluck('id_gejala')
					->whereNotIn('id_gejala', [$dataJawaban])
					->toArray();

				$indexBasis = array_search($dataJawaban[$lastIndex], $lastGejala);  //mencari index dari jawaban terakhir user dari data hasil

				$idBasis = Basisaturan::select('id_basisaturan') //id dari gejala dengan irisan terbanyak
					->where('id_gejala', $lastGejala[$indexBasis])
					->pluck('id_basisaturan')->toArray();

				$callBack = array_map(function ($arrayData) {
					return $arrayData + 1;
				}, $idBasis);

				$callbackHama = Basisaturan::select('kd_hama')
					->whereIn('id_basisaturan', $callBack)
					->whereNotIn('id_gejala', $dataJawaban)
					->pluck('kd_hama')->toArray();

				$hamaHasil = Hasil::select('kd_hama') //mencari hama terbanyak berdasarkan data hasil
					->where('kd_hama', $callbackHama[0])
					->groupby('kd_hama')
					->orderByRaw('COUNT(*) DESC')
					->pluck('kd_hama')->toArray();

				$gejalaHasil = Basisaturan::select('id_gejala') //lalu dari hama tersebut dilihat gejala nya apa saja dari hama terbanyak tadi
					->where('kd_hama', $hamaHasil)
					->pluck('id_gejala')->toArray();

				$indexJawaban1 = array_search($dataJawaban[$lastIndex], $gejalaHasil);  //mencari index dari jawaban terakhir user dari data hasil
				$indexJawaban2 = $indexJawaban1 + 1; //index setelah jawaban user dari data hasil

				$jumlahIrisan = Basisaturan::where('id_gejala', $dataJawaban[$lastIndex])->pluck('id_gejala')->count('id_gejala'); //mencari jumlah irisan dari gejala

				if ($jumlahIrisan != 1) { //jika jumlah lebih dari satu
					if ($gejalaHasil == null) {
						return redirect()->route('selesai');
					} elseif ($gejalaHasil != null) {
						$tampilGejala = Basisaturan::select('id_gejala') //mencampilkan gejala dari data hasil
							->where('id_gejala', $gejalaHasil[$indexJawaban2])
							->whereNotIn('id_gejala', $dataJawaban)
							->first();
					}
				} elseif ($jumlahIrisan == 1) { //jika jumlah sama dengan 1
					if ($callBack == null) {
						return redirect()->route('selesai');
					} elseif ($callBack != null) {
						$tampilGejala = Basisaturan::select('id_gejala') //menampilkan gejala selanjutnya dari gejala sebelumnya
							->where('id_basisaturan', $callBack[0])
							->whereNotIn('id_gejala', $dataJawaban)
							->groupby('id_gejala')
							->orderByRaw('COUNT(*) DESC')
							->first();
					}
				}
			} elseif ($firstPilihan == 0 && $lastPilihan == 0) {
				$truePilihan = Jawaban::select('pilihan')
					->whereIn('id_gejala', $dataJawaban)->where('pilihan', 1)->pluck('pilihan');

				$falsePilihan = Jawaban::select('pilihan')
					->whereIn('id_gejala', $dataJawaban)->where('pilihan', 0)->pluck('pilihan');

				$nullHama = Basisaturan::select('kd_hama')
					->whereIn('id_gejala', $dataJawaban)
					->groupby('kd_hama')
					->orderByRaw('COUNT(*) DESC')
					->pluck('kd_hama')->toArray();

				$nullGejala = Basisaturan::select('id_gejala') //mencari gejala kecuali dari data hama jawaban pertama karna di jawab tidak
					->whereNotIn('kd_hama', $nullHama)
					->pluck('id_gejala')->toArray();

				if ($truePilihan != null) {
					$sumPilihan = $truePilihan->count('pilihan');

					$indexPilihan = $sumPilihan - 1;

					$trueJawaban = Jawaban::select('id_gejala')
						->whereIn('pilihan', $truePilihan)
						->pluck('id_gejala');

					$falseJawaban = Jawaban::select('id_gejala')
						->whereIn('pilihan', $falsePilihan)
						->pluck('id_gejala')->toArray();

					$hamaJawabanT = Basisaturan::select('kd_hama')->where('id_gejala', $trueJawaban[$indexPilihan])->pluck('kd_hama')->toArray(); //mengambil data hama dari gejala pertama

					$hamaJawabanF = Basisaturan::select('kd_hama')->whereIn('id_gejala', $falseJawaban)->pluck('kd_hama')->toArray();

					$notGejala = Basisaturan::select('id_gejala') //mencari gejala kecuali dari data hama jawaban pertama karna di jawab tidak
						->whereIn('kd_hama', $hamaJawabanT)
						->whereNotIn('kd_hama', $hamaJawabanF)
						->whereNotIn('id_gejala', $dataJawaban)
						->groupby('id_gejala')
						->orderByRaw('COUNT(*) DESC')
						->pluck('id_gejala')->toArray();

					if ($notGejala == null) {
						return redirect()->route('selesai');
					} elseif ($notGejala != null) {
						$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $notGejala[0])->first(); //tampilkan gejala dengan irisan terbesar lainnya
					}
				} elseif ($truePilihan == null) {
					if ($nullGejala == null) {
						return redirect()->route('selesai');
					} elseif ($nullGejala != null) {
						$tampilGejala = Basisaturan::select('id_gejala')->where('id_gejala', $nullGejala[0])->first(); //tampilkan gejala dengan irisan terbesar lainnya
					}
				}
			}
		}
		return view('konsultasi.konsultasi_detail', compact('tampilGejala'));
	}

	public function r2()
	{
		$konsultasi = new Jawaban;
		$konsultasi->id = auth()->user()->id;
		$konsultasi->id_gejala = request()->id_gejala;
		$konsultasi->pilihan = request()->pilihan;
		$konsultasi->bobot = request()->bobot;
		$konsultasi->save();

		return redirect()->route('konsultasi_detail');
	}

	public function selesai()
	{
		// dd('selesai');
		$dataJawaban = Jawaban::where('id', auth()->user()->id)->where('pilihan', 1)->get();

		$probabilitas = $dataJawaban->sum('bobot');
		$countJawaban = $dataJawaban->count('bobot');

		$trueGejala = $dataJawaban->pluck('id_gejala');

		$trueHama = Basisaturan::select('kd_hama')
			->whereIn('id_gejala', $trueGejala)
			->groupby('kd_hama')
			->orderByRaw('COUNT(*) DESC')
			->pluck('kd_hama')->take(3);

		$trueHama2 = Basisaturan::select('kd_hama')
			->whereIn('id_gejala', $trueGejala)
			->groupby('kd_hama')
			->orderByRaw('COUNT(*) DESC')
			->pluck('kd_hama');

		$bobotProb = Gejala::whereIn('id_gejala', $trueGejala)
			->pluck('nilai_posterior');

		if ($trueHama2->count('kd_hama') == 2) {
			$probabilitas2 = Basisaturan::select('id_gejala')
				->where('kd_hama', $trueHama2[1])
				->whereIn('id_gejala', $trueGejala)
				->pluck('id_gejala');
		} elseif ($trueHama2->count('kd_hama') >= 3) {
			$probabilitas2 = Basisaturan::select('id_gejala')
				->where('kd_hama', $trueHama2[1])
				->whereIn('id_gejala', $trueGejala)
				->pluck('id_gejala');

			$probabilitas3 = Basisaturan::select('id_gejala')
				->where('kd_hama', $trueHama2[2])
				->whereIn('id_gejala', $trueGejala)
				->pluck('id_gejala');
		}

		$idGejala = Basisaturan::select('id_basisaturan')
			->whereIn('id_gejala', $trueGejala)
			->count('id_basisaturan');

		$totalBobot2 = Gejala::select('nilai_posterior')
			->whereIn('id_gejala', $probabilitas2)
			->sum('nilai_posterior');

		$totalBobot3 = Gejala::select('nilai_posterior')
			->whereIn('id_gejala', $probabilitas3)
			->sum('nilai_posterior');

		$bobot1 = $probabilitas / $countJawaban;

		$bobot2 = $totalBobot2 / $countJawaban;

		$bobot3 = $totalBobot3 / $countJawaban;

		$nilai = '["'.round($bobot1,2).'","'.round($bobot2,2).'","'.round($bobot3,2).'"]';

		$result = new Hasil;
		$result->id = auth()->user()->id;
		$result->kd_hama = $trueHama;
		$result->waktu = Carbon::now();
		$result->probabilitas = $nilai;
		$result->save();

		$hasil = Hasil::where('id', auth()->user()->id)->latest('id_hasil')->first();

		return view('hasil/detail1', compact('hasil', 'dataJawaban', 'probabilitas', 'countJawaban', 'trueHama', 'trueGejala', 'result'));
	}
}
