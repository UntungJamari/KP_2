@extends('layout.main')

@section('container')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengawasan Umrah</h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengisian Blanko Pengawasan Umrah</h6>
                <a href="export.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export ke Excel</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="pengawasan/create" type="button" class="btn btn-outline-info btn-sm mb-3">
                    <i class="fas fa-fw fa fa-plus"></i>
                    <span>Blanko Pengawasan Umrah</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:20px;">No.</th>
                                @if(auth()->user()->level !== 'ppiu')
                                <th>Nama PPIU</th>
                                <th>Kab/Kota</th>
                                @endif
                                <th style="width: 80px;">Tanggal</th>
                                <th>Jam</th>
                                <th>Jumlah Jemaah</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Tanggal Kepulangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengawasans as $pengawasan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if(auth()->user()->level !== 'ppiu')
                                <td>{{ $pengawasan->ppiu->nama }}</td>
                                <td>{{ $pengawasan->ppiu->kab_kota->nama }}</td>
                                @endif
                                <td>{{ date('d-m-Y', strtotime($pengawasan->tanggal)) }}</td>
                                <td>{{ $pengawasan->jam}}</td>
                                <td>{{ $pengawasan->jumlah_jemaah_laki_laki + $pengawasan->jumlah_jemaah_wanita}}</td>
                                <td>{{ date('d-m-Y', strtotime($pengawasan->tanggal_keberangkatan)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($pengawasan->tanggal_kepulangan)) }}</td>
                                <td>
                                    <a id="detail" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-detail" data-nama_ppiu="{{ $pengawasan->ppiu->nama }}" data-nama_kab_kota="{{ $pengawasan->ppiu->kab_kota->nama }}" data-hari="{{ $pengawasan->hari }}" data-tanggal="{{ date('d-m-Y', strtotime($pengawasan->tanggal)) }}" data-jam="{{ $pengawasan->jam }}" data-izin="{{ $pengawasan->izin }}" data-jumlah_jemaah_laki_laki="{{ $pengawasan->jumlah_jemaah_laki_laki }}" data-jumlah_jemaah_wanita="{{ $pengawasan->jumlah_jemaah_wanita }}" data-tanggal_keberangkatan="{{ date('d-m-Y', strtotime($pengawasan->tanggal_keberangkatan)) }}" data-tanggal_kepulangan="{{ date('d-m-Y', strtotime($pengawasan->tanggal_kepulangan)) }}" data-temuan_lapangan="{{ $pengawasan->temuan_lapangan }}" data-petugas_1="{{ $pengawasan->petugas_1 }}" data-petugas_2="{{ $pengawasan->petugas_2 }}">
                                        <i class="fas fa-fw fa fa-eye"></i>
                                    </a>
                                    <a href="/pengawasan/edit/{{ $pengawasan->id }}" type="button" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-fw fa fa-edit"></i>
                                    </a>
                                    <form action="/pengawasan/delete/{{ $pengawasan->id }}" method="POST" class="d-inline" onsubmit="return submitForm(this);">
                                        @csrf
                                        <button id="hapus-ppiu" type="submit" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-hapus" data-username="{{ $pengawasan->id_user }}">
                                            <i class="fas fa-fw fa fa-trash-alt"></i>
                                        </button>
                                    </form>
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
                <h4 class="modal-title m-0 font-weight-bold text-primary">Detail</h4>
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
                            <th>PPIU</th>
                            <td><span id="nama_ppiu"></span></td>
                        </tr>
                        <tr>
                            <th>Kab/Kota</th>
                            <td><span id="nama_kab_kota"></span></td>
                        </tr>
                        <tr>
                            <th>Hari</th>
                            <td><span id="hari"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><span id="tanggal"></span></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><span id="jam"></span></td>
                        </tr>
                        <tr>
                            <th>Izin</th>
                            <td><span id="izin"></span></td>
                        </tr>
                        <tr>
                            <th>
                                Jumlah Jemaah<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Laki-Laki<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;Wanita</th>
                            <td><br><span id="jumlah_jemaah_laki_laki"></span><br><span id="jumlah_jemaah_wanita"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Keberangkatan</th>
                            <td><span id="tanggal_keberangkatan"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kepulangan</th>
                            <td><span id="tanggal_kepulangan"></span></td>
                        </tr>
                        <tr>
                            <th>Temuan Lapangan</th>
                            <td><span id="temuan_lapangan"></span></td>
                        </tr>
                        <tr>
                            <th rowspan="2">Petugas</th>
                            <td>
                                <ol style="padding-left: 20px;">
                                    <li id="petugas_1"></li>
                                    <li id="petugas_2"></li>
                                </ol>
                            </td>
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
            var nama_kab_kota = $(this).data('nama_kab_kota');
            var hari = $(this).data('hari');
            var tanggal = $(this).data('tanggal');
            var jam = $(this).data('jam');
            var izin = $(this).data('izin');
            var jumlah_jemaah_laki_laki = $(this).data('jumlah_jemaah_laki_laki');
            var jumlah_jemaah_wanita = $(this).data('jumlah_jemaah_wanita');
            var tanggal_keberangkatan = $(this).data('tanggal_keberangkatan');
            var tanggal_kepulangan = $(this).data('tanggal_kepulangan');
            var temuan_lapangan = $(this).data('temuan_lapangan');
            var petugas_1 = $(this).data('petugas_1');
            var petugas_2 = $(this).data('petugas_2');
            $('#nama_ppiu').text(nama_ppiu);
            $('#nama_kab_kota').text(nama_kab_kota);
            $('#hari').text(hari);
            $('#tanggal').text(tanggal);
            $('#jam').text(jam);
            $('#izin').text(izin);
            $('#jumlah_jemaah_laki_laki').text(jumlah_jemaah_laki_laki);
            $('#jumlah_jemaah_wanita').text(jumlah_jemaah_wanita);
            $('#tanggal_keberangkatan').text(tanggal_keberangkatan);
            $('#tanggal_kepulangan').text(tanggal_kepulangan);
            $('#temuan_lapangan').text(temuan_lapangan);
            $('#petugas_1').text(petugas_1);
            $('#petugas_2').text(petugas_2);
        })
    })
</script>
<script>
    function submitForm(form) {
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Menghapus Data Pengawasan Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#26c0fc',
            cancelButtonColor: '#f51d50',
            cancelButtonText: 'Tidak!',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }
</script>
@if(session()->has('berhasil'))
<script>
    swal.fire({
        icon: 'success',
        showConfirmButton: false,
        timer: '2000',
        title: '{{ session("berhasil") }}'
    })
</script>
@endif
@endsection