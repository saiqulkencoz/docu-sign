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
                                <h2>Daftar Pengajuan</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <div class="button_block">
                                                <button type="button" class="btn cur-p btn-primary mb-3 float-right"
                                                    data-toggle="modal" data-target="#tambahdata">Tambah Data</button>
                                            </div>
                                            <form action="{{ route('adm-pengajuan') }}" method="GET">
                                                <div class="input-group mb-3 mt-3">
                                                    <input class="form-control" name="nama" type="text"
                                                        placeholder="Cari Nama Dokumen ..." autocomplete="off" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success"
                                                            type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form action="{{ route('adm-pengajuan') }}" method="GET">
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
                                            <table class="table table-striped table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Dokumen</th>
                                                        <th>Dokumen</th>
                                                        <th>Instansi</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Note</th>
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
                                                                    target="_blank" class="btn btn-secondary btn-sm">Lihat
                                                                    Dokumen</a>
                                                            </td>
                                                            <td>{{ $datapdf->instansi->nama }}</td>
                                                            <td>{{ $datapdf->tanggal }}</td>
                                                            <td><a style="pointer-events: none; cursor: default;" href=""
                                                                    class="btn btn-info btn-sm" disabled>
                                                                    {{ $datapdf->status }}</a></td>
                                                            <td>
                                                                <div style="text-align:center">
                                                                    <button type="button" class="btn cur-p btn-success"
                                                                        data-toggle="modal"
                                                                        data-target="#note_{{ $datapdf->id }}">Lihat
                                                                        Catatan</button>
                                                                </div>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="note_{{ $datapdf->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLongTitle"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">Catatan
                                                                                    Dokumen
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($datapdf->note == '')
                                                                                    <p>Tidak ada catatan . . . .</p>
                                                                                @else
                                                                                    <p>{{ $datapdf->note }}</p>
                                                                                @endif
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center">
                                                                    <a href="/admin/updatepdf/{{ $datapdf->id }}/view"
                                                                        class="btn btn-warning btn-sm">UPDATE</a>
                                                                    <a href="/admin/deletepdf/{{ $datapdf->id }}"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Anda Yakin ?')">DELETE</a>
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

    <!-- Modal -->
    <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uploadpdf') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama Dokumen</label>
                            <input type="text" name="nama" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Dokumen</label>
                            <input type="text" name="tanggal" class="form-control" required autocomplete="off"
                                id="datepicker2">
                            <script>
                                $('#datepicker2').datepicker({
                                    format: 'dd MM yyyy',
                                    todayHighlight: true
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label>Upload Dokumen</label><br />
                            <input type="file" name="pdf" accept="application/pdf" required autocomplete="off">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
