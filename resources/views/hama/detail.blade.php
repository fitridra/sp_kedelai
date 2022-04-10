@extends('layout.master')

@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(../assets/user/img/bg-img/31.png);">
        <h2>Informasi Hama</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('info_hama')}}">Informasi Hama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Informasi Hama</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Single Product Details Area Start ##### -->
<section class="single_product_details_area mb-50">
    <div class="produts-details--content mb-50">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-12 col-md-6 col-lg-5">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a class="product-img" href="{{ asset('storage/'.$hama->foto) }}" title="Hama">
                                        <img class="d-block w-100" src="{{ asset('storage/'.$hama->foto) }}" alt="1">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="single_product_desc">
                        <h4 class="title">{{$hama->nm_hama}}</h4>
                        <div class="short_overview">
                            <p>{{$hama->deskripsi}}</p>
                        </div>

                        <div class="products--meta">
                            <p><span>Kode Hama:</span> <span>{{$hama->kd_hama}}</span></p>
                            <p><span>Nama Hama:</span> <span>{{$hama->nm_hama}}</span></p>
                            <p><span>Solusi:</span> <span>{{$hama->solusi}}</span></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- ##### Single Product Details Area End ##### -->

@endsection