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
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(../assets/user/img/bg-img/31.png);">
        <h2>Riwayat Konsultasi</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Konsultasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Cart Area Start ##### -->
<div class="cart-area section-padding-0-100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Nama Hama</th>
                                <th>Probabilitas</th>
                                <th>Tanggal Konsultasi</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $hasil)
                            <tr>
                                @if(strlen($hasil->kd_hama) == 16)
                                @php
                                $a = substr($hasil->kd_hama, -14, 2);
                                $b = App\Models\Hama::where('kd_hama',$a)->first();
                                $prob1a = substr($hasil->probabilitas, -20, 4);
                                @endphp
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{ asset('storage/'.$b->foto) }}" alt="Hama"></a>
                                    <h5>{{$b->nm_hama}}</h5>
                                </td>
                                <td class="price"><span>{{$prob1a*100}}%</span></td>
                                @elseif(strlen($hasil->kd_hama) == 11)
                                @php
                                $e = substr($hasil->kd_hama, -9, 2);
                                $f = App\Models\Hama::where('kd_hama',$e)->first();
                                $prob2a = substr($hasil->probabilitas, -13, 4);
                                @endphp
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{ asset('storage/'.$f->foto) }}" alt="Hama"></a>
                                    <h5>{{$f->nm_hama}}</h5>
                                </td>
                                <td class="price"><span>{{$prob2a*100}}%</span></td>
                                @elseif(strlen($hasil->kd_hama) == 6)
                                @php
                                $i = substr($hasil->kd_hama, -4, 2);
                                $j = App\Models\Hama::where('kd_hama',$i)->first();
                                $prob3a = substr($hasil->probabilitas, -6, 4);
                                @endphp
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{ asset('storage/'.$j->foto) }}" alt="Hama"></a>
                                    <h5>{{$j->nm_hama}}</h5>
                                </td>
                                <td class="price"><span>{{$prob3a*100}}%</span></td>
                                @else
                                <<td class="cart_product_img">
                                    <a href="#"><img src="{{ asset('storage/'.$hasil->hama->foto) }}" alt="Hama"></a>
                                    <h5>{{$hasil->hama->nm_hama}}</h5>
                                    </td>
                                    <td class="price"><span>{{$hasil->probabilitas*100}}%</span></td>
                                    @endif

                                    <td class="price"><span>{{$hasil->waktu}}</span></td>
                                    <td></td>
                                    <td class="action"><a href="{{route('detail_hasil',$hasil->id_hasil)}}"><i class="fa fa-eye" style="color: green;"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    {{ $riwayat->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
<!-- ##### Cart Area End ##### -->
@endsection