@extends('layout_admin.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Data Basis Aturan</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat melihat berbagai data basis aturan yang ada di web anda!</h6><br>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
                                {{session('sukses')}}
                            </div>
                            @elseif(session('gagal'))
                            <div class="alert alert-danger" role="alert">
                                {{session('gagal')}}
                            </div>
                            @endif
                            <button type="button" class="btn btn-info btn-icon-text mt-2 mb-2" data-toggle="modal" data-target="#tambah_basisaturan"><i class="ti-plus btn-icon-prepend"></i>Tambah</button>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Hama</th>
                                            <th class="text-center">Nama Gejala</th>
                                            <th class="text-center" colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach($data_basisaturan as $basisaturan)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$basisaturan->kd_hama}} ({{$basisaturan->hama->nm_hama}})</td>
                                            <td>Terdapat {{$basisaturan->gejala->nm_gejala}}</td>
                                            @csrf
                                            <td><a href="{{route('edit_basisaturan',$basisaturan->id_basisaturan)}}" class="btn btn-warning btn-sm"><i class="ti-pencil-alt"></i></a></td>
                                            @method('delete')
                                            @csrf
                                            <td><a href="{{route('delete_basisaturan',$basisaturan->id_basisaturan)}}" class="btn btn-danger btn-sm delete" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tambah_basisaturan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">MASUKKAN DATA BASIS ATURAN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('tambah_basisaturan')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Hama</label>
                                <select class="form-control" name="kd_hama" required aria-label="Default select example">
                                    <option value="#" selected>Pilih Hama</option>
                                    @foreach ($data_hama as $hama)
                                    <option value="{{$hama->kd_hama}}">{{$hama->nm_hama}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Gejala</label>
                                <select class="form-control" name="id_gejala" required aria-label="Default select example">
                                    <option value="#" selected>Pilih Gejala</option>
                                    @foreach ($data_gejala as $gejala)
                                    <option value="{{$gejala->id_gejala}}">{{$gejala->nm_gejala}}</option>
                                    @endforeach
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