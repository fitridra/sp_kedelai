@extends('layout_admin.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Ubah Data Basis Aturan</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat mengubah data basis aturan anda!</h6><br>
                </div>
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="post" action="{{route('update_basisaturan',$basisaturan->id_basisaturan)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Hama</label>
                                    <select class="form-control" name="kd_hama" required>
                                        <option value="{{ $basisaturan->kd_hama }}" selected>{{ $basisaturan->hama->nm_hama }}</option>
                                        @foreach ($data_hama as $hama)
                                        <option value="{{$hama->kd_hama}}">{{$hama->nm_hama}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Gejala</label>
                                    <select class="form-control" name="id_gejala" required>
                                        <option value="{{ $basisaturan->id_gejala }}" selected>{{ $basisaturan->gejala->nm_gejala }}</option>
                                        @foreach ($data_gejala as $gejala)
                                        <option value="{{$gejala->id_gejala}}">{{$gejala->nm_gejala}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('basisaturan')}}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection