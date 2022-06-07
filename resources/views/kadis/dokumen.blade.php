@extends('kadis.master')

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
                                <h2>Daftar Dokumen {{ Auth()->user()->instansi->nama }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <form action="{{ route('kadis-dokumen') }}" method="GET">
                                                <div class="input-group mb-3 mt-3">
                                                    <input class="form-control" name="nama" type="text"
                                                        placeholder="Cari Nama Dokumen ..." autocomplete="off" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success"
                                                            type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form action="{{ route('kadis-dokumen') }}" method="GET">
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
                                                                    <a href="/kadis/dokumen/terima/{{ $datapdf->id }}"
                                                                        class="btn btn-success btn-sm">Terima</a>
                                                                    <button type="button" class="btn cur-p btn-danger"
                                                                        data-toggle="modal"
                                                                        data-target="#tolak_{{ $datapdf->id }}">Tolak</button>
                                                                </div>
                                                                <!-- Modal Tolak-->
                                                                <div class="modal fade" id="tolak_{{ $datapdf->id }}"
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
                                                                                <form
                                                                                    action="/kadis/dokumen/tolak/{{ $datapdf->id }}"
                                                                                    method="post">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="form-group">
                                                                                        <label>Note</label>
                                                                                        <textarea class="form-control" rows="4" required name="note"
                                                                                            placeholder="Masukkan Catatan">{{ $datapdf->note }}</textarea>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Simpan</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
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
