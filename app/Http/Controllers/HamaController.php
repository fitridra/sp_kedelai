<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hama;
use App\Models\Hasil;

class HamaController extends Controller
{
	public function index()
	{
		$data_hama = Hama::paginate(4);
	
		$dataHama = Hasil::where('id', auth()->user()->id)->latest('id_hasil')->take(3)->get();
		return view('hama.index', compact('data_hama','dataHama'));
	}

	public function detail($id)
	{
		$hama = Hama::where('kd_hama', $id)->first();
		return view('hama/detail', compact('hama'));
	}

	public function index_admin(Request $request)
	{
		$data_hama = Hama::when($request->cari, function ($query) use ($request) {
			$query->where('nm_hama', 'LIKE', "%{$request->cari}%");
		})->paginate(5);

		$data_hama->appends($request->only('cari'));
		
		$id_hama = Hama::all()->count('kd_hama');
		return view('hama.index_admin', compact('data_hama', 'id_hama'));
	}

	public function tambah(Request $request)
	{

		$validatedData = $request->validate([
			'kd_hama' => 'required',
			'nm_hama' => 'required',
			'deskripsi' => 'required',
			'solusi' => 'required',
			'foto' => 'required|image',
		]);

		if ($request->file('foto')) {
			$validatedData['foto'] = $request->file('foto')->store('hama');
		}

		Hama::create($validatedData);

		return redirect()->route('hama')->with('sukses', 'Data Berhasil Ditambahkan');
	}

	public function edit($id)
	{
		$hama = Hama::where('kd_hama', $id)->first();
		return view('hama/edit', compact('hama'));
	}

	public function update(Request $request, $id)
	{

		$hama = Hama::where('kd_hama', $id)->first();
		$hama->where('kd_hama', $hama->kd_hama)
			->update([
				'nm_hama' => $request->input('nm_hama'),
				'deskripsi' => $request->input('deskripsi'),
				'solusi' => $request->input('solusi'),
			]);
		return redirect()->route('hama')->with('sukses', 'Data Berhasil Diubah');
	}

	public function updatefoto(Request $request, $id)
	{

		$hama = Hama::where('kd_hama', $id)->first();
		$hama->where('kd_hama', $hama->kd_hama)
			->update([
				'foto' => $request->file('foto')->store('hama'),
			]);
		return redirect()->route('hama')->with('sukses', 'Gambar Hama Berhasil Diubah');
	}

	public function delete($id)
	{

		Hama::where('kd_hama', $id)->delete();
		return redirect()->route('hama')->with('sukses', 'Data Berhasil Dihapus');
	}
}
