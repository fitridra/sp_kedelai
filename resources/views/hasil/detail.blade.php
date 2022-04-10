@extends('layout_admin.master')

@section('content')
<style>
    .table td img,
    .jsgrid .jsgrid-table td img {
        width: 100%;
        height: 70%;
        border-radius: 0%;
    }

    .table th,
    .jsgrid .jsgrid-table th,
    .table td,
    .jsgrid .jsgrid-table td {
        vertical-align: middle;
        line-height: 1;
        white-space: normal;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Detail Hasil</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat melihat detail hasil konsultasi yang ada di web anda!</h6><br>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
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
                            <table class="table table-borderless report-table">
                                <tr>
                                    <td class="text-muted" style="white-space: nowrap;">{{$b->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$prob1a*100}}%" aria-valuenow="{{$prob1a*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$prob1a*100}}%</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{$y->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$prob1b*100}}%" aria-valuenow="{{$prob1b*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$prob1b*100}}%</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{$d->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$prob1c*100}}%" aria-valuenow="{{$prob1c*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$prob1c*100}}%</h5>
                                    </td>
                                </tr>
                            </table>

                            @elseif(strlen($hasil->kd_hama) == 11)
                            @php
                            $e = substr($hasil->kd_hama, -9, 2);
                            $f = App\Models\Hama::where('kd_hama',$e)->first();
                            $g = substr($hasil->kd_hama, -4, 2);
                            $h = App\Models\Hama::where('kd_hama',$g)->first();
                            $prob2a = substr($hasil->probabilitas, -13, 4);
                            $prob2b = substr($hasil->probabilitas, -6, 4);
                            @endphp
                            <table class="table table-borderless report-table">
                                <tr>
                                    <td class="text-muted" style="white-space: nowrap;">{{$f->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$prob2a*100}}%" aria-valuenow="{{$prob2a*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$prob2a*100}}%</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{$h->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$prob2b*100}}%" aria-valuenow="{{$prob2b*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$prob2b*100}}%</h5>
                                    </td>
                                </tr>
                            </table>

                            @elseif(strlen($hasil->kd_hama) == 6)
                            @php
                            $i = substr($hasil->kd_hama, -4, 2);
                            $j = App\Models\Hama::where('kd_hama',$i)->first();
                            $prob3a = substr($hasil->probabilitas, -6, 4);
                            @endphp
                            <table class="table table-borderless report-table">
                                <tr>
                                    <td class="text-muted" style="white-space: nowrap;">{{$j->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$prob3a*100}}%" aria-valuenow="{{$prob3a*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$prob3a*100}}%</h5>
                                    </td>
                                </tr>
                            </table>

                            @else
                            <table class="table table-borderless report-table">
                                <tr>
                                    <td class="text-muted" style="white-space: nowrap;">{{$hasil->hama->nm_hama}}</td>
                                    <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$hasil->probabilitas*100}}%" aria-valuenow="{{$hasil->probabilitas*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold mb-0">{{$hasil->probabilitas*100}}%</h5>
                                    </td>
                                </tr>
                            </table>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-md-12 grid-margin">

                    <div class="row">
                        @if(strlen($hasil->kd_hama) == 16)
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$b->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$b->foto) }}" style="width: 100%; height:100%"><br><br>
                                                        {{$b->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$prob1a*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$b->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$y->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$y->foto) }}" style="width: 100%; height:100%"><br><br>
                                                        {{$y->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$prob1b*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$y->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$d->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$d->foto) }}" style="width: 100%; height:100%"><br><br>
                                                        {{$d->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$prob1c*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$d->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @elseif(strlen($hasil->kd_hama) == 11)
                        <div class="col-md-6 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$f->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$f->foto) }}" style="width: 100%; height:100%"><br><br>
                                                        {{$f->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$prob2a*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$f->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$h->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$h->foto) }}" style="width: 100%; height:100%"><br><br>
                                                        {{$h->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$prob2b*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$h->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @elseif(strlen($hasil->kd_hama) == 6)
                        <div class="col-md stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$j->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$j->foto) }}" style="width: 50%; height:50%"><br><br>
                                                        {{$j->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$prob3a*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$j->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @else
                        <div class="col-md stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">{{$hasil->hama->nm_hama}}</p>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="pl-0">Nama Hama</td>
                                                    <td class="text-muted"><img src="{{ asset('storage/'.$hasil->hama->foto) }}" style="width: 50%; height:50%"><br><br>
                                                        {{$hasil->hama->nm_hama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Probabilitas</td>
                                                    <td class="text-muted">{{$hasil->probabilitas*100}}%/100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0">Solusi Pengendalian Hama</td>
                                                    <td class="text-muted">{{$hasil->hama->solusi}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>

            </div>
        </div>

        @endsection