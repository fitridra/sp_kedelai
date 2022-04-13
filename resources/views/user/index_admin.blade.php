@extends('layout_admin.master')

@section('content')
<style>
    .table td img,
    .jsgrid .jsgrid-table td img {
        width: 100%;
        height: 70%;
        border-radius: 0%;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Data Pengguna</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat melihat berbagai data pengguna yang ada di web anda!</h6><br>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
                                {{session('sukses')}}
                            </div>
                            @endif
                            <button type="button" class="btn btn-info btn-icon-text mt-2 mb-2" data-toggle="modal" data-target="#tambah_user"><i class="ti-plus btn-icon-prepend"></i>Tambah</button>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center" colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach($data_user as $user)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$user->nama}}</td>
                                            <td>{{$user->email}}</td>
                                            @if($user->role == 2)
                                            <td>Admin</td>
                                            @elseif($user->role == 3)
                                            <td>Pakar</td>
                                            @else
                                            <td>Petani/Masyarakat Umum</td>
                                            @endif
                                            @csrf
                                            <td><a href="{{route('edit_user',$user->id)}}" class="btn btn-warning btn-sm"><i class="ti-pencil-alt"></i></a></td>
                                            @method('delete')
                                            @csrf
                                            <td><a href="{{route('delete_user',$user->id)}}" class="btn btn-danger btn-sm delete" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                                <div class="pagging text-center">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            {{ $data_user->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">MASUKKAN DATA PENGGUNA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('tambah_user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Masukkan Email Pengguna..." required>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama Pengguna..." required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Masukkan Password Pengguna..." required>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="role" required>
                                    <option value="#" selected>Pilih Status Pengguna</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Petani/Masyarakat Umum</option>
                                    <option value="3">Pakar</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endsection