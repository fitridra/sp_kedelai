@extends('layout.master')

@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(./assets/user/img/bg-img/31.png);">
        <h2>Konsultasi Hama</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Konsultasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Konsultasi Area Start ##### -->
<section class="testimonial-area section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="testimonials-slides owl-carousel">

                    <!-- Single Konsultasi Slide -->
                    <div class="single-testimonial-slide">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <div class="testimonial-thumb">
                                    <img src="{{ asset('storage/'.$tampilGejala->gejala->foto) }}" style="border-radius:0%;" alt="">
                                    <span style="font-size:12px;">Note: Gambar hanya referensi dalam memilih gejala</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="testimonial-content">
                                    <!-- Section Heading Pertanyaan-->
                                    <div class="section-heading">
                                        <h2 class="text-center">Apakah terdapat {{$tampilGejala->gejala->nm_gejala}}?</h2>
                                        <br>
                                        <div class="row">

                                            <div class="form-group col-6 text-right">
                                                <form action="{{route('r2')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                                    <input type="hidden" name="id_gejala" value="{{$tampilGejala->id_gejala}}">
                                                    <input type="hidden" name="pilihan" value="1">
                                                    <input type="hidden" name="bobot" value="{{$tampilGejala->gejala->nilai_posterior}}">
                                                    <button class="btn btn-lg btn-success" type="submit">Ya</button>
                                                </form>
                                            </div>

                                            <div class="form-group col-6">
                                                <form action="{{route('r2')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                                                    <input type="hidden" name="id_gejala" value="{{$tampilGejala->id_gejala}}">
                                                    <input type="hidden" name="pilihan" value="0">
                                                    <input type="hidden" name="bobot" value="0">
                                                    <button class="btn btn-lg btn-danger" type="submit">Tidak</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Konsultasi Area End ##### -->

@endsection