@extends('layout.main')

@section('container')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $subtitle }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="/ppiu" type="button" class="btn btn-outline-warning btn-sm mb-3">
                    <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                    <span>Kembali</span>
                </a>
                <form class="row g-2 mt-3" action="" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 form-group">
                        <center>
                            <h4 class="mb-3">Data PPIU</h4>
                        </center>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Nama PPIU</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('nama') is-invalid @enderror" id="input1" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if(auth()->user()->level === 'kanwil')
                    <div class="col-md-6 form-group">
                        <label for="input2" class="form-label">Kabupten/Kota</label><label style="color: red;">*</label>
                        <select class="form-control @error('id_kab_kota') is-invalid @enderror" name="id_kab_kota" id="input2" required>
                            <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                            @foreach ($kab_kotas as $kab_kota)
                            <option value="{{ $kab_kota->id }}" {{ (old('id_kab_kota') == $kab_kota->id) ? 'selected' : '' }}>{{ $kab_kota->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_kab_kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class=" col-md-6 form-group">
                        <label for="input1" class="form-label">Nama Pimpinan</label>
                        <input autofocus type="text" class="form-control" id="input1" name="nama_pimpinan" value="{{ old('nama_pimpinan') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input2" class="form-label">Status</label><label style="color: red;">*</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="input2" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Pusat" {{ (old('status') === "Pusat") ? 'selected' : '' }}>Pusat</option>
                            <option value="Cabang" {{ (old('status') === "Cabang") ? 'selected' : '' }}>Cabang</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Nomor SK</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('nomor_sk') is-invalid @enderror" id="input1" name="nomor_sk" value="{{ old('nomor_sk') }}" required>
                        @error('nomor_sk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Tanggal SK</label><label style="color: red;">*</label>
                        <input autofocus type="date" class="form-control @error('tanggal_sk') is-invalid @enderror" id="input1" name="tanggal_sk" value="{{ old('tanggal_sk') }}" required>
                        @error('tanggal_sk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="validationCustom04" class="form-label">Alamat</label><label style="color: red;">*</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="validationCustom04" cols="30" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Logo</label><br>
                        <img id="upload-img" class="img-preview img-fluid col-6">
                    </div>
                    <div class="col-md-3 form-group">
                        <br>
                        <p style="font-size: 12px; @error('logo') color: red; @enderror">*ukuran file maksimal 1 mb dan format file : .jpg, .jpeg, .png</p>
                        <input type="file" id="file" name="logo" style="display: none;" class="form-control @error('logo') is-invalid @enderror">
                        <label for="file" class="btn btn-primary btn-user btn-block">
                            <i class="fas fa-fw fa fa-images">
                            </i>
                            Pilih Gambar
                        </label>
                    </div>
                    <div class="col-md-12 form-group mt-5">
                        <center>
                            <h4 class="mb-3">Akun PPIU</h4>
                        </center>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Username</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('username') is-invalid @enderror" id="input1" name="username" value="{{ old('username') }}" required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Password</label>
                        <input autofocus type="text" class="form-control" id="input1" name="password" placeholder="Default : 12345678" disabled>
                    </div>
                    <div class="col-md-12 form-group">
                        <center>
                            <button type="submit" class="btn btn-outline-primary btn-sm mt-5 mb-3" name="simpan" id="simpan">
                                <i class="fas fa-fw fa fa-save"></i>
                                <span>Simpan</span>
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#file").change(function(event) {
            var x = URL.createObjectURL(event.target.files[0]);
            $("#upload-img").attr("src", x);
            console.log(event);
        });
    })
</script>
@endsection