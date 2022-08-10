@extends('layout_admin.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Halaman Data Hasil</h3>
                    <h6 class="font-weight-normal mb-0">Pada halaman ini anda dapat melihat berbagai data hasil konsultasi yang ada di web anda!</h6><br>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if(session('sukses'))
                            <div class="alert alert-success" role="alert">
                                {{session('sukses')}}
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Grafik
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group-6" style="display: flex;justify-content: end;">
                                        <form method="GET" action="{{ url()->current() }}">
                                            <select class="form-control" name="cari" onchange="this.form.submit();">
                                                <option value="#">Filter</option>
                                                @foreach($data_user as $user)
                                                <option value="{{$user->id}}">{{$user->nama}}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="collapseExample">
                                <div class="card card-body" id="container">
                                </div>
                            </div>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Nama Hama</th>
                                            <th class="text-center">Probabilitas</th>
                                            <th class="text-center">Tanggal Konsultasi</th>
                                            <th class="text-center" colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach($data_hasil as $hasil)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td>{{$hasil->user->nama}}</td>

                                            @if(strlen($hasil->kd_hama) == 16)
                                            @php
                                            $a = substr($hasil->kd_hama, -14, 2);
                                            $b = App\Models\Hama::where('kd_hama',$a)->first();
                                            $prob1a = substr($hasil->probabilitas, -20, 4);
                                            @endphp
                                            <td>{{$b->nm_hama}}</td>
                                            <td>{{$prob1a*100}}%</td>
                                            @elseif(strlen($hasil->kd_hama) == 11)
                                            @php
                                            $e = substr($hasil->kd_hama, -9, 2);
                                            $f = App\Models\Hama::where('kd_hama',$e)->first();
                                            $prob2a = substr($hasil->probabilitas, -13, 4);
                                            @endphp
                                            <td>{{$f->nm_hama}}</td>
                                            <td>{{$prob2a*100}}%</td>
                                            @elseif(strlen($hasil->kd_hama) == 6)
                                            @php
                                            $i = substr($hasil->kd_hama, -4, 2);
                                            $j = App\Models\Hama::where('kd_hama',$i)->first();
                                            $prob3a = substr($hasil->probabilitas, -6, 4);
                                            @endphp
                                            <td>{{$j->nm_hama}}</td>
                                            <td>{{$prob3a*100}}%</td>
                                            @elseif(strlen($hasil->kd_hama) == 7)
                                            @php
                                            $k = substr($hasil->kd_hama, -5, 3);
                                            $l = App\Models\Hama::where('kd_hama',$k)->first();
                                            $prob4a = substr($hasil->probabilitas, -6, 4);
                                            @endphp
                                            <td>{{$l->nm_hama}}</td>
                                            <td>{{$prob4a*100}}%</td>
                                            @else
                                            <td>{{$hasil->hama->nm_hama}}</td>
                                            <td>{{$hasil->probabilitas*100}}%</td>
                                            @endif

                                            <td>{{$hasil->waktu}}</td>
                                            <td><a href="{{route('riwayat_hasil',$hasil->id_hasil)}}" class="btn btn-secondary btn-sm"><i class="ti-search"></i></a></td>
                                            <!--direct-->
                                            @method('delete')
                                            @csrf
                                            <td><a href="{{route('delete_hasil',$hasil->id_hasil)}}" class="btn btn-danger btn-sm delete" onclick="return confirm('Apakah Ingin Menghapus Data ini ?')"><i class="ti-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>
                                <div class="pagging text-center">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            {{ $data_hasil->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection

        @section('chart')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            // Radialize the colors
            Highcharts.setOptions({
                colors: Highcharts.map(Highcharts.getOptions().colors, function(color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });

            // Build the chart
            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Grafik Konsultasi Sistem Pakar Kedelai'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Jumlah',
                    data: [{
                            name: 'Tungau Merah',
                            y: {
                                {
                                    $grafik1
                                }
                            }
                        },

                        {
                            name: 'Ulat Grayak',
                            y: {
                                {
                                    $grafik2
                                }
                            }
                        },
                        {
                            name: 'Ulat Jengkal',
                            y: {
                                {
                                    $grafik3
                                }
                            }
                        },
                        {
                            name: 'Ulat Penggulung Daun',
                            y: {
                                {
                                    $grafik4
                                }
                            }
                        },
                        {
                            name: 'Kepik Coklat',
                            y: {
                                {
                                    $grafik5
                                }
                            }
                        },
                        {
                            name: 'Kepik Piezodorus',
                            y: {
                                {
                                    $grafik6
                                }
                            }
                        },
                        {
                            name: 'Penggerek Polong Kedelai',
                            y: {
                                {
                                    $grafik7
                                }
                            }
                        },
                        {
                            name: 'Wereng Hijau Kedelai',
                            y: {
                                {
                                    $grafik8
                                }
                            }
                        },
                        {
                            name: 'Kutu Kebul',
                            y: {
                                {
                                    $grafik9
                                }
                            }
                        },
                        {
                            name: 'Belalang',
                            y: {
                                {
                                    $grafik10
                                }
                            }
                        }
                    ]
                }]
            });
        </script>
        @stop