@extends('layout_admin.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Ubah Data Gejala</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat mengubah data gejala anda!</h6><br>
                </div>
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="post" action="{{route('update_gejala',$gejala->id_gejala)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="id_gejala" value="{{$gejala->id_gejala}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nama Gejala</label>
                                    <input class="form-control" type="text" name="nm_gejala" value="{{$gejala->nm_gejala}}" placeholder="Masukkan Nama gejala..." required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nilai Prior</label>
                                    <input class="form-control" type="text" name="nilai_prior" value="{{$gejala->nilai_prior}}" placeholder="Masukkan Nilai Prior gejala..." required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nilai CPT</label>
                                    <input class="form-control" type="text" name="nilai_cpt" value="{{$gejala->nilai_cpt}}" placeholder="Masukkan Nilai CPT gejala..." required>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('gejala')}}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection