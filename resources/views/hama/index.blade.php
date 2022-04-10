@extends('layout.master')

@section('content')
<style>
    .page-item.active .page-link {

        background-color: #70c745;
        border-color: #70c745;
        color: #fff;
    }
</style>
<!-- ##### Breadcrumb Area Start ##### -->
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(./assets/user/img/bg-img/31.png);">
        <h2>Informasi Hama</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi Hama</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<section class="alazea-blog-area mb-100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    @foreach($data_hama as $hama)
                    <!-- Single Blog Post Area -->
                    <div class="col-12 col-lg-6">
                        <div class="single-blog-post mb-50">
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
                </div>

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $data_hama->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="post-sidebar-area">

                    <!-- ##### Single Widget Area ##### -->
                    <!-- <div class="single-widget-area">
                        <form action="#" method="get" class="search-form">
                            <input type="search" name="search" id="widgetsearch" placeholder="Search...">
                            <button type="submit"><i class="icon_search"></i></button>
                        </form>
                    </div> -->

                    <!-- ##### Single Widget Area ##### -->
                    <div class="single-widget-area">
                        <!-- Title -->
                        <div class="widget-title">
                            <h4>Riwayat Konsultasi Hama</h4>
                        </div>
                        @foreach($dataHama as $Hama)
                        @if(strlen($Hama->kd_hama) == 16)
                        @php
                        $a = substr($Hama->kd_hama, -14, 2);
                        $b = App\Models\Hama::where('kd_hama',$a)->first();
                        @endphp
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            <div class="post-thumb">
                                <img src="{{ asset('storage/'.$b->foto) }}" alt="">
                            </div>
                            <div class="post-content">
                                <a href="{{route('detail_hama',$b->kd_hama)}}" class="post-title">
                                    <h6>{{$b->nm_hama}}</h6>
                                </a>
                                <a href="{{route('detail_hama',$b->kd_hama)}}" class="post-date">Lihat Hama</a> <!-- kode hama -->
                            </div>
                        </div>
                        @elseif(strlen($Hama->kd_hama) == 11)
                        @php
                        $e = substr($Hama->kd_hama, -9, 2);
                        $f = App\Models\Hama::where('kd_hama',$e)->first();
                        @endphp
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            <div class="post-thumb">
                                <img src="{{ asset('storage/'.$f->foto) }}" alt="">
                            </div>
                            <div class="post-content">
                                <a href="{{route('detail_hama',$f->kd_hama)}}" class="post-title">
                                    <h6>{{$f->nm_hama}}</h6>
                                </a>
                                <a href="{{route('detail_hama',$f->kd_hama)}}" class="post-date">Lihat Hama</a> <!-- kode hama -->
                            </div>
                        </div>
                        @elseif(strlen($Hama->kd_hama) == 6)
                        @php
                        $i = substr($Hama->kd_hama, -4, 2);
                        $j = App\Models\Hama::where('kd_hama',$i)->first();
                        @endphp
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            <div class="post-thumb">
                                <img src="{{ asset('storage/'.$j->foto) }}" alt="">
                            </div>
                            <div class="post-content">
                                <a href="{{route('detail_hama',$j->kd_hama)}}" class="post-title">
                                    <h6>{{$j->nm_hama}}</h6>
                                </a>
                                <a href="{{route('detail_hama',$j->kd_hama)}}" class="post-date">Lihat Hama</a> <!-- kode hama -->
                            </div>
                        </div>
                        @else
                        <!-- Single Latest Posts -->
                        <div class="single-latest-post d-flex align-items-center">
                            <div class="post-thumb">
                                <img src="{{ asset('storage/'.$Hama->hama->foto) }}" alt="">
                            </div>
                            <div class="post-content">
                                <a href="{{route('detail_hama',$Hama->hama->kd_hama)}}" class="post-title">
                                    <h6>{{$Hama->hama->nm_hama}}</h6>
                                </a>
                                <a href="{{route('detail_hama',$Hama->hama->kd_hama)}}" class="post-date">Lihat Hama</a> <!-- kode hama -->
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- ##### Blog Area End ##### -->
@endsection