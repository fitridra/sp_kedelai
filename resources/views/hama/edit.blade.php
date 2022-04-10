@extends('layout_admin.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Ubah Data Hama</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat mengubah data hama anda!</h6><br>
                </div>
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="post" action="{{route('update_hama',$hama->kd_hama)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Kode Hama</label>
                                    <input class="form-control" type="text" name="kd_hama" value="{{$hama->kd_hama}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nama Hama</label>
                                    <input class="form-control" type="text" name="nm_hama" value="{{$hama->nm_hama}}" placeholder="Masukkan Nama Hama..." required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" cols="3" rows="5" placeholder="Masukkan Deskripsi Hama..." required>{{$hama->deskripsi}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Solusi</label>
                                    <textarea class="form-control" name="solusi" cols="3" rows="5" placeholder="Masukkan Solusi Hama..." required>{{$hama->solusi}}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('hama')}}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection