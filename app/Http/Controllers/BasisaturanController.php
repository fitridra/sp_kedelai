<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basisaturan;
use App\Models\Hama;
use App\Models\Gejala;
use Illuminate\Support\Str;

class BasisaturanController extends Controller
{
	public function index_admin(Request $request)
	{
		$data_basisaturan = Basisaturan::when($request->cari, function ($query) use ($request) {
			$query->where('kd_hama', 'LIKE', "%{$request->cari}%");
		})->paginate(5);

		$data_basisaturan->appends($request->only('cari'));

		$data_hama = Hama::all();
		$data_gejala = Gejala::all();
		return view('basisaturan.index_admin', compact('data_basisaturan', 'data_hama', 'data_gejala'));
	}

	public function tambah(Request $request)
	{

		$validatedData = $request->validate([
			'kd_hama' => 'required',
			'id_gejala' => 'required'
		]);
		$slug1 = Str::slug($request->kd_hama);
		$slug2 = Str::slug($request->id_gejala);

		if ($slug1 && $slug2) {
			return redirect()->route('basisaturan')->with('gagal', 'Data Basis Aturan Sudah Ada!');
		} else {
			Basisaturan::create($validatedData);

			return redirect()->route('basisaturan')->with('sukses', 'Data Berhasil Ditambahkan');
		}
	}

	public function edit($id)
	{
		$basisaturan = Basisaturan::where('id_basisaturan', $id)->first();
		$data_hama = Hama::all();
		$data_gejala = Gejala::all();
		return view('basisaturan/edit', compact('basisaturan', 'data_hama', 'data_gejala'));
	}

	public function update(Request $request, $id)
	{

		$basisaturan = Basisaturan::where('id_basisaturan', $id)->first();
		$slug1 = Str::slug($request->kd_hama);
		$slug2 = Str::slug($request->id_gejala);
		if ($slug1 && $slug2) {
			return redirect()->route('basisaturan')->with('gagal', 'Data Basis Aturan Sudah Ada!');
		} else {
			$basisaturan->where('id_basisaturan', $basisaturan->id_basisaturan)
				->update([
					'kd_hama' => $request->input('kd_hama'),
					'id_gejala' => $request->input('id_gejala')
				]);
			return redirect()->route('basisaturan')->with('sukses', 'Data Berhasil Diubah');
		}
	}

	public function delete($id)
	{

		Basisaturan::where('id_basisaturan', $id)->delete();
		return redirect()->route('basisaturan')->with('sukses', 'Data Berhasil Dihapus');
	}
}
