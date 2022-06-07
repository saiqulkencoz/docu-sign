@extends('master_adm.master')

@section('content')
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Dashboard</h2>
                    </div>
                    @if (session('Sukses'))
                        <div class="alert alert-success col-lg-12" role="alert">
                            {{ session('Sukses') }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- main -->
            <div class="row column2 graph margin_bottom_30">
                <div class="col-md-l2 col-lg-12">
                    <div class="white_shd full">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Daftar Dokumen Terverifikasi</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <form action="{{ route('adm-download') }}" method="GET">
                                                <div class="input-group mb-3 mt-3">
                                                    <input class="form-control" name="nama" type="text"
                                                        placeholder="Cari Nama Dokumen ..." autocomplete="off" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success"
                                                            type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form action="{{ route('adm-download') }}" method="GET">
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
                                            <div class="button_block">
                                            </div>
                                            <table class="table table-striped table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Dokumen</th>
                                                        <th>Dokumen Asli</th>
                                                        <th>Instansi</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data_pdf as $datapdf)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $datapdf->nama }}</td>
                                                            <td>
                                                                <a href="{{ asset('pdf/' . $datapdf->pdf) }}"
                                                                    target="_blank" class="btn btn-secondary btn-sm">
                                                                    Lihat Dokumen</a>
                                                            </td>
                                                            <td>{{ $datapdf->instansi->nama }}</td>
                                                            <td>{{ $datapdf->tanggal}}</td>
                                                            <td><a href="" class="btn btn-info btn-sm" disabled>
                                                                    {{ $datapdf->status }}</a></td>
                                                            <td>
                                                                <div style="text-align:center">
                                                                    <a href="download/{{ $datapdf->id }}"
                                                                        class="btn btn-success btn-sm" disabled>DOWNLOAD</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
