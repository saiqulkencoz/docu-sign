@extends('master_adm.master')

@section('content')
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
            <!-- main -->
            <div class="row column2 graph margin_bottom_30">
                <div class="col-md-l2 col-lg-12">
                    <div class="white_shd full">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Statistik Dokumen</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <form action="{{ route('adm-statistik') }}" method="GET">
                                                <div class="input-group mb-3 mt-3">
                                                    <input class="form-control" name="tanggal" type="text"
                                                        placeholder="Cari Tanggal ..." autocomplete="off" id="datepicker"
                                                        required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success"
                                                            type="submit">Search</button>
                                                    </div>
                                                </div>
                                                <script>
                                                    $("#datepicker").datepicker({
                                                        format: "MM yyyy",
                                                        viewMode: "years",
                                                        minViewMode: "months"
                                                    });
                                                </script>
                                            </form>
                                            <div class="panel">
                                                <div id="chartnilai"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end graph -->
        </div>
        <!-- footer -->
        <div class="container-fluid">
            <div class="footer">
                <p>Copyright © 2022 Designed by Diskominfo Kota Batu</a>
                </p>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chartnilai', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{ auth()->user()->instansi->nama }}'
            },
            subtitle: {
                text: '{{$now}}'
            },
            xAxis: {
                categories: {!! json_encode($status) !!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Dokumen'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Dokumen',
                data: [{{$menunggu}}, {{$revisi}}, {{$setuju}}]
            }]
        });
    </script>
@endsection