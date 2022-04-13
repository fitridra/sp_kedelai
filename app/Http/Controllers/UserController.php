<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
	public function index()
	{
		return view('user.index');
	}

	public function update_profile(Request $request, $id)
	{

		$user = User::where('id', $id)->first();
		$user->where('id', $user->id) //cek ini auth()->user()->id atau bukan
			->update([
				'email' => $request->input('email'),
				'nama' => $request->input('nama'),
			]);
		return redirect()->route('pengaturan')->with('sukses', 'Data Berhasil Diubah');
	}

	public function changepw()
	{
		return view('auth/changepw');
	}

	public function change_password(Request $request)
	{
		$request->validate([
			'current_password' => 'required',
			'password' => 'required|min:8|max:255|confirmed',
		]);

		if (Hash::check($request->current_password, auth()->user()->password)) {
			auth()->user()->update(['password' => Hash::make($request->password)]);

			return redirect('/pengaturan')->with('sukses', 'Your Password has been updated');
		}
		throw ValidationException::withMessages([
			'current_password' => 'Your current password does not match with our record',
		]);
	}

	public function index_admin()
	{
		$data_user = User::paginate(5);
		return view('user.index_admin', compact('data_user'));
	}

	public function tambah(Request $request)
	{

		$pengguna = new User;
		$pengguna->email = $request->email;
		$pengguna->nama = $request->nama;
		$pengguna->password = bcrypt($request->get('password'));
		$pengguna->role = $request->role;
		$pengguna->save();

		return redirect()->route('user')->with('sukses', 'Data Berhasil Ditambahkan');
	}

	public function edit($id)
	{
		$user = User::where('id', $id)->first();
		return view('user/edit', compact('user'));
	}

	public function update(Request $request, $id)
	{

		$user = User::where('id', $id)->first();
		$user->where('id', $user->id)
			->update([
				'email' => $request->input('email'),
				'nama' => $request->input('nama'),
				'role' => $request->input('role'),
			]);
		return redirect()->route('user')->with('sukses', 'Data Berhasil Diubah');
	}

	public function delete($id)
	{

		User::where('id', $id)->delete();
		return redirect()->route('user')->with('sukses', 'Data Berhasil Dihapus');
	}
}
