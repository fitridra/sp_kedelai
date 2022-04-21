@extends('layout_admin.master')

@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Selamat Datang, {{auth()->user()->nama}}</h3>
                        <h6 class="font-weight-normal mb-0">Sistem Pakar Identifikasi Hama Tanaman Kedelai</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white" type="button">
                                    Today ({{Carbon\Carbon::now()->isoFormat('D MMM Y')}})
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card green-bg">
                    <div class="card-people mt-auto">
                        <img src="{{asset('assets/admin/images/dashboard/1.png')}}" alt="kedelai">
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Data Hama</p>
                                <p class="fs-30 mb-2">{{$jh}}</p>
                                <p>(Jumlah) Hama</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Data Gejala</p>
                                <p class="fs-30 mb-2">{{$jg}}</p>
                                <p>(Jumlah) Gejala</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Konsultasi</p>
                                <p class="fs-30 mb-2">{{$tk}}</p>
                                <p>(Jumlah) Konsultasi</p>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->role == 3)
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Data Basis Aturan</p>
                                <p class="fs-30 mb-2">{{$jba}}</p>
                                <p>(Jumlah) Basis Aturan</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Data Pengguna</p>
                                <p class="fs-30 mb-2">{{$jp}}</p>
                                <p>(Jumlah) Pengguna</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection