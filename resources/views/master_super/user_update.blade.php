@extends('master_super.master')

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
                                <h2>Edit Data User</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="table_section padding_infor_info">
                                        <div class="table-responsive-sm">
                                            <form action="/super/user/update/{{ $user->id }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" placeholder="Masukkan Nama"
                                                        class="form-control" value="{{$user->nama}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>NIP</label>
                                                    <input type="text" name="nip" placeholder="Masukkan NIP"
                                                        class="form-control" value="{{$user->nip}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select class="form-control" name="role">
                                                        @if ($user->role='admin')
                                                            <option value="admin" selected>Admin</option>
                                                        @else
                                                            <option value="kepala dinas" selected>Kepala Dinas</option>   
                                                        @endif
                                                        <option value="" disabled>===============================</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="kepala dinas">Kepala Dinas</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Instansi</label>
                                                    <select class="form-control" name="instansi_id">
                                                        <option value="{{ $user->instansi->id }}" selected>
                                                            {{ $user->instansi->nama }}</option>
                                                        <option value="" disabled>===============================</option>
                                                        @foreach ($instansi as $opt_instansi)
                                                            <option value="{{ $opt_instansi->id }}">
                                                                {{ $opt_instansi->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-lg"
                                                    style="width: 15%">Update</button>
                                            </form>
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
