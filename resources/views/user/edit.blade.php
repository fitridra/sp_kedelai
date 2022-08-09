@extends('layout_admin.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Ubah Data Pengguna</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat mengubah data pengguna anda!</h6><br>
                </div>
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="post" action="{{route('update_user',$user->id)}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}" placeholder="Masukkan Email Pengguna..." required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama" value="{{$user->nama}}" placeholder="Masukkan Nama Pengguna..." required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="role" required>
                                        @if($user->role == 2)
                                        <option value="2" selected>Admin</option>
                                        <option value="1">Petani/Masyarakat Umum</option>
                                        @else
                                        <option value="1" selected>Petani/Masyarakat Umum</option>
                                        <option value="2">Admin</option>
                                        @endif
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('user')}}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection