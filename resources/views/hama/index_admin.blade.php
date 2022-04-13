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
                    <h3 class="font-weight-bold">Halaman Data Hama</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat melihat berbagai data hama yang ada di web anda!</h6><br>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
                                {{session('sukses')}}
                            </div>
                            @endif
                            <button type="button" class="btn btn-info btn-icon-text mt-2 mb-2" data-toggle="modal" data-target="#tambah_hama"><i class="ti-plus btn-icon-prepend"></i>Tambah</button>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Kode Hama</th>
                                            <th class="text-center">Nama Hama</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Solusi</th>
                                            <th class="text-center">Gambar Hama</th>
                                            <th class="text-center" colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach($data_hama as $hama)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$hama->kd_hama}}</td>
                                            <td>{{$hama->nm_hama}}</td>
                                            <td style="white-space: normal">{{$hama->deskripsi}}</td>
                                            <td style="white-space: normal">{{$hama->solusi}}</td>
                                            <td>
                                                <div class="card user-info-card">
                                                    <div class="user-profile"><img src="{{ asset('storage/'.$hama->foto) }}">
                                                        <form method="post" action="{{route('update_gbhama',$hama->kd_hama)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input class="form-control" name="foto" type="file" onchange="this.form.submit();">
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            @csrf
                                            <td><a href="{{route('edit_hama',$hama->kd_hama)}}" class="btn btn-warning btn-sm"><i class="ti-pencil-alt"></i></a></td>
                                            @method('delete')
                                            @csrf
                                            <td><a href="{{route('delete_hama',$hama->kd_hama)}}" class="btn btn-danger btn-sm delete" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                                <div class="pagging text-center">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            {{ $data_hama->links() }}
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
        <div class="modal fade" id="tambah_hama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">MASUKKAN DATA HAMA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('tambah_hama')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Kode Hama</label>
                                <input class="form-control" type="text" name="kd_hama" value="H{{$id_hama+1}}" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama Hama</label>
                                <input class="form-control" type="text" name="nm_hama" placeholder="Masukkan Nama Hama..." required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" cols="3" rows="5" placeholder="Masukkan Deskripsi Hama..." required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Solusi</label>
                                <textarea class="form-control" name="solusi" cols="3" rows="5" placeholder="Masukkan Solusi Hama..." required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Gambar Hama</label>
                                <input class="form-control" type="file" name="foto" required>
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