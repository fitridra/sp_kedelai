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
                        <div class="testimonial-content">
                            <!-- Section Heading Pertanyaan-->
                            <div class="section-heading">
                                <h2 class="text-center">Tekan Tombol <span style="font-weight: bold;">'Mulai Konsultasi'</span> Untuk Melakukan Konsultasi</h2>
                                <br>
                                <form action="{{route('mulai')}}" method="post">
                                    @csrf
                                    <center><button class="btn btn-lg btn-success" type="submit">Mulai Konsultasi</button></center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- ##### Konsultasi Area End ##### -->
@endsection