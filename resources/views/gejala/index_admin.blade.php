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
                    <h3 class="font-weight-bold">Halaman Data Gejala</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat melihat berbagai data gejala yang ada di web anda!</h6><br>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
                                {{session('sukses')}}
                            </div>
                            @endif
                            <button type="button" class="btn btn-info btn-icon-text mt-2 mb-2" data-toggle="modal" data-target="#tambah_gejala"><i class="ti-plus btn-icon-prepend"></i>Tambah</button>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Kode Gejala</th>
                                            <th class="text-center">Nama Gejala</th>
                                            <th class="text-center">Nilai Prior</th>
                                            <th class="text-center">Nilai CPT</th>
                                            <th class="text-center">Nilai Posterior</th>
                                            <th class="text-center">Gambar Gejala</th>
                                            <th class="text-center" colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach($data_gejala as $gejala)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>G{{$gejala->id_gejala}}</td>
                                            <td style="white-space: normal">{{$gejala->nm_gejala}}</td>
                                            <td>{{$gejala->nilai_prior}}</td>
                                            <td>{{$gejala->nilai_cpt}}</td>
                                            <td>{{$gejala->nilai_posterior}}</td>
                                            <td>
                                                <div class="card user-info-card">
                                                    <div class="user-profile"><img src="{{ asset('storage/'.$gejala->foto) }}">
                                                        <form method="post" action="{{route('update_gbgejala',$gejala->id_gejala)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input class="form-control" name="foto" type="file" onchange="this.form.submit();">
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            @csrf
                                            <td><a href="{{route('edit_gejala',$gejala->id_gejala)}}" class="btn btn-warning btn-sm"><i class="ti-pencil-alt"></i></a></td>
                                            @method('delete')
                                            @csrf
                                            <td><a href="{{route('delete_gejala',$gejala->id_gejala)}}" class="btn btn-danger btn-sm delete" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                                <div class="pagging text-center">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            {{ $data_gejala->links() }}
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
        <div class="modal fade" id="tambah_gejala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">MASUKKAN DATA GEJALA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('tambah_gejala')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id_gejala" value="{{$id_gejala+1}}" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama Gejala</label>
                                <input class="form-control" type="text" name="nm_gejala" placeholder="Masukkan Nama Gejala..." required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nilai Prior</label>
                                <input class="form-control" type="text" name="nilai_prior" placeholder="Masukkan Nilai Prior gejala..." required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nilai CPT</label>
                                <input class="form-control" type="text" name="nilai_cpt" placeholder="Masukkan Nilai CPT gejala..." required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Gambar Gejala</label>
                                <input class="form-control" type="file" name="foto">
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

        @section('search')
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <form method="GET" action="{{ url()->current() }}">
                    <input name="cari" type="text" class="form-control" id="navbar-search-input" placeholder="Search..." aria-label="search" aria-describedby="search">
                </div>
            </li>
            </form>
        </ul>
        @stop