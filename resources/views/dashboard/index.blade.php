@extends('layout.master')

@section('content')
<!-- ##### Hero Area Start ##### -->
<section class="hero-area">
    <div class="hero-post-slides owl-carousel">

        <!-- Single Hero Post -->
        <div class="single-hero-post bg-overlay">
            <!-- Post Image -->
            <div class="slide-img bg-img" style="background-image: url(./assets/user/img/bg-img/1.png);"></div>
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <!-- Post Content -->
                        <div class="hero-slides-content text-center">
                            <h2>Sistem Pakar Identifikasi Hama Tanaman Kedelai</h2>
                            <p>Konsultasikan Hama Tanaman Kedelai Anda disini.</p>
                            <div class="welcome-btn-group">
                                <a href="{{route('konsultasi')}}" class="btn alazea-btn mr-30">Konsultasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Hero Post -->
        <div class="single-hero-post bg-overlay">
            <!-- Post Image -->
            <div class="slide-img bg-img" style="background-image: url(./assets/user/img/bg-img/31.png);"></div>
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <!-- Post Content -->
                        <div class="hero-slides-content text-center">
                            <h2>Sistem Pakar Identifikasi Hama Tanaman Kedelai</h2>
                            <p>Informasi mengenai berbagai hama utama pada tanaman kedelai.</p>
                            <div class="welcome-btn-group">
                                <a href="{{route('info_hama')}}" class="btn alazea-btn mr-30">Lihat Hama</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ##### Hero Area End ##### -->

<!-- ##### Cool Facts Area Start ##### -->
<!-- <section class="cool-facts-area section-padding-100-0">
    <div class="container">
        <div class="row"> -->

            <!-- Single Cool Facts Area -->
            <!-- <div class="col-12 col-sm-6 col-md-3">
                <div class="single-cool-fact d-flex align-items-center justify-content-center mb-100">
                    <div class="cf-icon">
                        <img src="./assets/user/img/core-img/cf1.png" alt="">
                    </div>
                    <div class="cf-content">
                        <h2><span class="counter">20</span></h2>
                        <h6>AWARDS</h6>
                    </div>
                </div>
            </div> -->

            <!-- Single Cool Facts Area -->
            <!-- <div class="col-12 col-sm-6 col-md-3">
                <div class="single-cool-fact d-flex align-items-center justify-content-center mb-100">
                    <div class="cf-icon">
                        <img src="./assets/user/img/core-img/cf2.png" alt="">
                    </div>
                    <div class="cf-content">
                        <h2><span class="counter">70</span></h2>
                        <h6>PROJECTS</h6>
                    </div>
                </div>
            </div> -->

            <!-- Single Cool Facts Area -->
            <!-- <div class="col-12 col-sm-6 col-md-3">
                <div class="single-cool-fact d-flex align-items-center justify-content-center mb-100">
                    <div class="cf-icon">
                        <img src="./assets/user/img/core-img/cf3.png" alt="">
                    </div>
                    <div class="cf-content">
                        <h2><span class="counter">30</span>+</h2>
                        <h6>HAPPY CLIENTS</h6>
                    </div>
                </div>
            </div> -->

            <!-- Single Cool Facts Area -->
            <!-- <div class="col-12 col-sm-6 col-md-3">
                <div class="single-cool-fact d-flex align-items-center justify-content-center mb-100">
                    <div class="cf-icon">
                        <img src="./assets/user/img/core-img/cf4.png" alt="">
                    </div>
                    <div class="cf-content">
                        <h2><span class="counter">80</span>K+</h2>
                        <h6>REVENUE</h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section> -->
<!-- ##### Cool Facts Area End ##### -->

<!-- ##### Product Area Start ##### -->
<section class="new-arrivals-products-area bg-gray section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2>KONSULTASI TERAKHIR</h2>
                    <p>Riwayat Konsultasi Terakhir Hama Tanaman Kedelai</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($hasil as $hsl)
            @if(strlen($hsl->kd_hama) == 16)
            @php
            $a = substr($hsl->kd_hama, -14, 2);
            $b = App\Models\Hama::where('kd_hama',$a)->first();
            $prob1a = substr($hsl->probabilitas, -20, 4);
            @endphp
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-product-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <!-- Product Image -->
                    <div class="product-img">
                        <a class="product-img" href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <img src="{{ asset('storage/'.$b->foto) }}" alt="1">
                        </a>
                    </div>
                    <!-- Product Info -->
                    <div class="product-info mt-15 text-center">
                        <a href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <p>{{$b->nm_hama}}</p>
                        </a>
                        <h6>{{$prob1a*100}}%</h6>
                    </div>
                </div>
            </div>
            @elseif(strlen($hsl->kd_hama) == 11)
            @php
            $e = substr($hsl->kd_hama, -9, 2);
            $f = App\Models\Hama::where('kd_hama',$e)->first();
            $prob2a = substr($hsl->probabilitas, -13, 4);
            @endphp
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-product-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <!-- Product Image -->
                    <div class="product-img">
                        <a class="product-img" href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <img src="{{ asset('storage/'.$f->foto) }}" alt="1">
                        </a>
                    </div>
                    <!-- Product Info -->
                    <div class="product-info mt-15 text-center">
                        <a href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <p>{{$f->nm_hama}}</p>
                        </a>
                        <h6>{{$prob2a*100}}%</h6>
                    </div>
                </div>
            </div>
            @elseif(strlen($hsl->kd_hama) == 6)
            @php
            $i = substr($hsl->kd_hama, -4, 2);
            $j = App\Models\Hama::where('kd_hama',$i)->first();
            $prob3a = substr($hsl->probabilitas, -6, 4);
            @endphp
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-product-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <!-- Product Image -->
                    <div class="product-img">
                        <a class="product-img" href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <img src="{{ asset('storage/'.$j->foto) }}" alt="1">
                        </a>
                    </div>
                    <!-- Product Info -->
                    <div class="product-info mt-15 text-center">
                        <a href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <p>{{$j->nm_hama}}</p>
                        </a>
                        <h6>{{$prob3a*100}}%</h6>
                    </div>
                </div>
            </div>
            @else
            <!-- Single Product Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-product-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                    <!-- Product Image -->
                    <div class="product-img">
                        <a class="product-img" href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <img src="{{ asset('storage/'.$hsl->hama->foto) }}" alt="1">
                        </a>
                    </div>
                    <!-- Product Info -->
                    <div class="product-info mt-15 text-center">
                        <a href="{{route('detail_hasil',$hsl->id_hasil)}}">
                            <p>{{$hsl->hama->nm_hama}}</p>
                        </a>
                        <h6>{{$hsl->probabilitas*100}}%</h6>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            <div class="col-12 text-center">
                <a href="{{route('riwayat',Auth::user()->id)}}" class="btn alazea-btn">Lihat Semua</a>
            </div>

        </div>
    </div>
</section>
<!-- ##### Product Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<section class="alazea-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2>Informasi Hama</h2>
                    <p>Informasi mengenai berbagai hama utama pada tanaman kedelai</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            @foreach($data_hama as $hama)
            <!-- Single Blog Post Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-post mb-75">
                    <div class="post-thumbnail mb-30">
                        <a href="{{route('detail_hama',$hama->kd_hama)}}"><img src="{{ asset('storage/'.$hama->foto) }}" alt=""></a>
                    </div>
                    <div class="post-content">
                        <a href="{{route('detail_hama',$hama->kd_hama)}}" class="post-title">
                            <h5>{{$hama->nm_hama}}</h5>
                        </a>
                        <p class="post-excerpt">{{substr($hama->deskripsi,0,100)}}...</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12 text-center">
                <a href="{{route('info_hama')}}" class="btn alazea-btn mt-30">Lihat Semua</a>
            </div>
        </div>
    </div>
</section><br><br>
<!-- ##### Blog Area End ##### -->

@endsection