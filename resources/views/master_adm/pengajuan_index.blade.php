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
                                            <table class="table table-striped table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Dokumen</th>
                                                        <th>Dokumen</th>
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
                                                                <a href="{{asset('pdf/'. $datapdf->pdf)}}" target="_blank">Lihat Dokumen</a>
                                                            </td>
                                                            <td>{{ $datapdf->status }}</td>
                                                            <td>Lihat Catatan</td>
                                                            <td>
                                                                <div style="text-align:center">
                                                                    <a href="user/deletepdf/{{ $datapdf->id }}"
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('uploadpdf')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="pdf" accept="application/pdf">
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
