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
            $x = substr($hasil->kd_hama, -9, 2);
            $y = App\Models\Hama::where('kd_hama',$x)->first();
            $c = substr($hasil->kd_hama, -4, 2);
            $d = App\Models\Hama::where('kd_hama',$c)->first();
            $prob1a = substr($hasil->probabilitas, -20, 4);
            $prob1b = substr($hasil->probabilitas, -13, 4);
            $prob1c = substr($hasil->probabilitas, -6, 4);
            @endphp
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p>{{$b->nm_hama}}</p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob1a*100}}"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p>{{$y->nm_hama}}</p>
                    <div id="bar2" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob1b*100}}"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p>{{$d->nm_hama}}</p>
                    <div id="bar3" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob1c*100}}"></span>
                    </div>
                </div>
            </div>
            @elseif(strlen($hasil->kd_hama) == 11)
            @php
            $e = substr($hasil->kd_hama, -9, 2);
            $f = App\Models\Hama::where('kd_hama',$e)->first();
            $g = substr($hasil->kd_hama, -4, 2);
            $h = App\Models\Hama::where('kd_hama',$g)->first();
            $prob2a = substr($hasil->probabilitas, -13, 4); 
            $prob2b = substr($hasil->probabilitas, -6, 4);
            @endphp
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p>{{$f->nm_hama}}</p>
                    <div id="bar1" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob2a*100}}"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <!-- Single Progress Bar -->
                <div class="single_progress_bar">
                    <p>{{$h->nm_hama}}</p>
                    <div id="bar2" class="barfiller">
                        <div class="tipWrap">
                            <span class="tip"></span>
                        </div>
                        <span class="fill" data-percentage="{{$prob2b*100}}"></span>
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
                    <p>{{$j->nm_hama}}</p>
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
                    <p>{{$l->nm_hama}}</p>
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
                    <p>{{$hasil->hama->nm_hama}}</p>
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
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                        @if(strlen($hasil->kd_hama) == 16)
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">{{$b->nm_hama}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">{{$y->nm_hama}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#reviews" class="nav-link" data-toggle="tab" role="tab">{{$d->nm_hama}}</a>
                        </li>
                        @elseif(strlen($hasil->kd_hama) == 11)
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">{{$f->nm_hama}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">{{$h->nm_hama}}</a>
                        </li>
                        @elseif(strlen($hasil->kd_hama) == 6)
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">{{$j->nm_hama}}</a>
                        </li>
                        @elseif(strlen($hasil->kd_hama) == 7)
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">{{$l->nm_hama}}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">{{$hasil->hama->nm_hama}}</a>
                        </li>
                        @endif
                    </ul>
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
                                                        <a class="product-img" href="{{ asset('storage/'.$b->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$b->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$b->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$b->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$b->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$b->nm_hama}}</span></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="addi-info">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$y->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$y->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$y->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$y->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$y->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$y->nm_hama}}</span></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$d->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$d->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$d->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$d->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$d->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$d->nm_hama}}</span></p>
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
                                                        <a class="product-img" href="{{ asset('storage/'.$f->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$f->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$f->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$f->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$f->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$f->nm_hama}}</span></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="addi-info">
                            <div class="description_area">
                                <div class="row justify-content-between">

                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="single_product_thumb">
                                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <a class="product-img" href="{{ asset('storage/'.$h->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$h->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$h->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$h->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$h->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$h->nm_hama}}</span></p>
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
                                                        <a class="product-img" href="{{ asset('storage/'.$j->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$j->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$j->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$j->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$j->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$j->nm_hama}}</span></p>
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
                                                        <a class="product-img" href="{{ asset('storage/'.$l->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$l->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$l->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$l->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$l->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$l->nm_hama}}</span></p>
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
                                                        <a class="product-img" href="{{ asset('storage/'.$hasil->hama->foto) }}" title="Product Image">
                                                            <img class="d-block w-100" src="{{ asset('storage/'.$hasil->hama->foto) }}" alt="1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="single_product_desc">
                                            <h4 class="title">{{$hasil->hama->nm_hama}}</h4>
                                            <div class="short_overview">
                                                <p>{{$hasil->hama->solusi}}</p>
                                            </div>

                                            <div class="products--meta">
                                                <p><span>Tanggal Konsultasi:</span> <span>{{$hasil->waktu}}</span></p>
                                                <p><span>Kode Hama:</span> <span>{{$hasil->kd_hama}}</span></p>
                                                <p><span>Nama Hama:</span> <span>{{$hasil->hama->nm_hama}}</span></p>
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