<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Hama;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class HasilController extends Controller
{
	public function index($id_user)
	{
		$riwayat1 = Hasil::where('id', $id_user)->get()->pluck('kd_hama');
		$riwayat = Hasil::where('id', $id_user)->paginate(5);
		$id_user = Auth::user()->id;

		return view('hasil.index', compact('riwayat','riwayat1', 'id_user'));
	}

	public function riwayat_hasil($id_hasil)
	{
		$hasil = Hasil::where('id_hasil', $id_hasil)->first();
		return view('hasil/detail', compact('hasil'));
	}

	public function index_admin()
	{
		$data_hasil = Hasil::paginate(5);
		return view('hasil.index_admin', compact('data_hasil'));
	}

	public function detail($id)
	{
		$hasil = Hasil::where('id_hasil', $id)->first();
		return view('hasil/detail1', compact('hasil'));
	}

	// public function pdf($id)
	// {
	// 	$hasil = Hasil::where('id_hasil', $id)->first();
	// 	$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'dpi' => 150, 'defaultFont' => 'sans-serif'])
	// 		->loadView('hasil.print', compact('hasil'));

	// 	return $pdf->download('hasil-konsultasi.pdf');
	// }

	public function delete($id)
	{

		Hasil::where('id_hasil', $id)->delete();
		return redirect()->route('hasil')->with('sukses', 'Data Berhasil Dihapus');
	}
}
