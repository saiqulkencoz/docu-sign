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
                                <h2>Cek Keaslian Dokumen</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <div class="panel">
                                                @if (session('Sukses'))
                                                    {{-- <div class="row"> --}}
                                                    <div class="alert alert-success col=12" role="alert">
                                                        Hasil : {{ session('Sukses') }}
                                                    </div>
                                                    {{-- </div> --}}
                                                @endif
                                                <form action="{{ route('adm-cekpost') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label>Upload Dokumen</label><br />
                                                        <input type="file" name="pdf" accept="application/pdf" required
                                                            autocomplete="off">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Cek Keaslian</button>
                                                </form>
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
