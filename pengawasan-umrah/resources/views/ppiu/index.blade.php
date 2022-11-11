@extends('layout.main')

@section('container')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">PPIU</h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar PPIU</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="ppiu/create" type="button" class="btn btn-outline-info btn-sm mb-3">
                    <i class="fas fa-fw fa fa-plus"></i>
                    <span>Tambah PPIU</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:20px">No.</th>
                                <th>Nama PPIU</th>
                                <th>Status</th>
                                <th>Alamat</th>
                                <th style="width: 14%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppius as $ppiu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ppiu->nama }}</td>
                                <td>{{ $ppiu->status }}</td>
                                <td>{{ $ppiu->alamat }}</td>
                                <td>
                                    <a id="detail" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-detail" data-nama_ppiu="{{ $ppiu->nama }}" data-username="{{ $ppiu->user->username }}" data-nama_kab_kota="{{ $ppiu->kab_kota->nama }}" data-status="{{ $ppiu->status }}" data-nomor_sk="{{ $ppiu->nomor_sk }}" data-tanggal_sk="{{ $ppiu->tanggal_sk }}" data-alamat="{{ $ppiu->alamat }}" data-nama_pimpinan="{{ $ppiu->nama_pimpinan }}" data-logo="{{ $ppiu->logo }}">
                                        <i class="fas fa-fw fa fa-eye"></i>
                                    </a>
                                    <a href="edit_ppiu.php?id_ppiu={{ $ppiu->id }}" type="button" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-fw fa fa-edit"></i>
                                    </a>
                                    <a id="hapus-ppiu" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-hapus" data-username="{{ $ppiu->id_user }}">
                                        <i class="fas fa-fw fa fa-trash-alt"></i>
                                    </a>
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
<!-- /.container-fluid -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content card shadow mb-4">
            <div class="modal-header card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="modal-title m-0 font-weight-bold text-primary">Detail PPIU</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive card-body">
                <center>
                    <img class="mb-5" id="gambar" style="width: 300px;">
                </center>
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th>Nama PPIU</th>
                            <td><span id="nama_ppiu"></span></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><span id="username"></span></td>
                        </tr>
                        <tr>
                            <th>Kab/Kota</th>
                            <td><span id="nama_kab_kota"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Pimpinan</th>
                            <td><span id="nama_pimpinan"></span></td>
                        </tr>
                        <tr>
                            <th>Nomor SK</th>
                            <td><span id="nomor_sk"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal SK</th>
                            <td><span id="tanggal_sk"></span></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><span id="alamat"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#detail', function() {
            var nama_ppiu = $(this).data('nama_ppiu');
            var username = $(this).data('username');
            var nama_kab_kota = $(this).data('nama_kab_kota');
            var status = $(this).data('status');
            var nomor_sk = $(this).data('nomor_sk');
            var tanggal_sk = $(this).data('tanggal_sk');
            var alamat = $(this).data('alamat');
            var nama_pimpinan = $(this).data('nama_pimpinan');
            var logo = $(this).data('logo');
            $('#nama_ppiu').text(nama_ppiu);
            $('#username').text(username);
            $('#nama_kab_kota').text(nama_kab_kota);
            $('#status').text(status);
            $('#nomor_sk').text(nomor_sk);
            $('#tanggal_sk').text(tanggal_sk);
            $('#alamat').text(alamat);
            $('#nama_pimpinan').text(nama_pimpinan);
            $('#logo').text(logo);
            $('#gambar').attr('src', 'images/profile/' + logo);

        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection