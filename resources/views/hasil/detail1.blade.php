@extends('layout.master')

@section('content')
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(../assets/user/img/bg-img/31.png);">
        <h2>Hasil Konsultasi</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('riwayat',Auth::user()->id)}}">Riwayat Hasil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Hasil Konsultasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Single Product Details Area Start ##### -->
<section class="single_product_details_area mb-50">

    <div class="container">
        <div class="row">
            @if(strlen($hasil->kd_hama) == 16)
            @php
            $a = substr($hasil->kd_hama, -14, 2);
            $b = App\Models\Hama::where('kd_hama',$a)->first();
            $prob1a = substr($hasil->probabilitas, -20, 4);
            @endphp
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p class="mb-4"><a href="{{route('detail_hama',$b->kd_hama)}}" style="font-size: 24px;">Hama {{$b->nm_hama}}</a></p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob1a*100}}"></span>
                    </div>
                </div>
            </div>

            @elseif(strlen($hasil->kd_hama) == 11)
            @php
            $e = substr($hasil->kd_hama, -9, 2);
            $f = App\Models\Hama::where('kd_hama',$e)->first();
            $prob2a = substr($hasil->probabilitas, -13, 4);
            @endphp
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p class="mb-4"><a href="{{route('detail_hama',$f->kd_hama)}}" style="font-size: 24px;">Hama {{$f->nm_hama}}</a></p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob2a*100}}"></span>
                    </div>
                </div>
            </div>

            @elseif(strlen($hasil->kd_hama) == 6)
            @php
            $i = substr($hasil->kd_hama, -4, 2);
            $j = App\Models\Hama::where('kd_hama',$i)->first();
            $prob3a = substr($hasil->probabilitas, -6, 4);
            @endphp
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p class="mb-4"><a href="{{route('detail_hama',$j->kd_hama)}}" style="font-size: 24px;">Hama {{$j->nm_hama}}</a></p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob3a*100}}"></span>
                    </div>
                </div>
            </div>
            @elseif(strlen($hasil->kd_hama) == 7)
            @php
            $k = substr($hasil->kd_hama, -5, 3);
            $l = App\Models\Hama::where('kd_hama',$k)->first();
            $prob4a = substr($hasil->probabilitas, -6, 4);
            @endphp
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p class="mb-4"><a href="{{route('detail_hama',$l->kd_hama)}}" style="font-size: 24px;">Hama {{$l->nm_hama}}</a></p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob4a*100}}"></span>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p class="mb-4"><a href="{{route('detail_hama',$hasil->hama)}}" style="font-size: 24px;">Hama {{$hasil->hama->nm_hama}}</a></p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$hasil->probabilitas*100}}"></span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="product_details_tab clearfix">

                    <!-- Tab Content -->
                    <div class="tab-content">
                        @if(strlen($hasil->kd_hama) == 16)
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$b->foto) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$b->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <a class="product-img" href="{{ asset('storage/'.$b->foto2) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$b->foto2) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h6 class="title" style="font-size: 16px;">Solusi Pengendalian Hama</h6>
                                            <div class="short_overview" style="margin-left: 15px;">
                                                <p>{!!$b->solusi!!}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif(strlen($hasil->kd_hama) == 11)
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$f->foto) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$f->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <a class="product-img" href="{{ asset('storage/'.$f->foto2) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$f->foto2) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h6 class="title" style="font-size: 16px;">Solusi Pengendalian Hama</h6>
                                            <div class="short_overview" style="margin-left: 15px;">
                                                <p>{!!$f->solusi!!}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif(strlen($hasil->kd_hama) == 6)
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$j->foto) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$j->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <a class="product-img" href="{{ asset('storage/'.$j->foto2) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$j->foto2) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h6 class="title" style="font-size: 16px;">Solusi Pengendalian Hama</h6>
                                            <div class="short_overview" style="margin-left: 15px;">
                                                <p>{!!$j->solusi!!}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif(strlen($hasil->kd_hama) == 7)
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$l->foto) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$l->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <a class="product-img" href="{{ asset('storage/'.$l->foto2) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$l->foto2) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h6 class="title" style="font-size: 16px;">Solusi Pengendalian Hama</h6>
                                            <div class="short_overview" style="margin-left: 15px;">
                                                <p>{!!$l->solusi!!}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$hasil->hama->foto) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$hasil->hama->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <a class="product-img" href="{{ asset('storage/'.$hasil->hama->foto2) }}" title="Hama">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$hasil->hama->foto2) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h6 class="title">Solusi Pengendalian Hama</h4>
                                                <div class="short_overview" style="margin-left: 15px;">
                                                    <p>{!!$hasil->hama->solusi!!}</p>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Single Product Details Area End ##### -->

@endsection