@extends('karyawan.layout')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TA SBD KELOMPOK 32</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karyawan.index') }}">Data Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ruangan.index') }}">Tabel Ruangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kartu_akses.index') }}">Tabel Kartu Akses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recyclebin.index') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<h4 class="mt-5">Data Karyawan</h4>

<div class="mt-3">
    <form action="{{ route('karyawan.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search...">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
</div>

<a href="{{ route('karyawan.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
<a href="{{ route('ruangan.index') }}" type="button" class="btn btn-success rounded-3">Tampilkan Tabel Ruangan</a>
<a href="{{ route('kartu_akses.index') }}" type="button" class="btn btn-success rounded-3">Tampilkan Tabel Kartu Akses</a>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Karyawan</th>
            <th>Nama</th>
            <th>Alamat</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_karyawan }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->alamat }}</td>
            <td>
                <a href="{{ route('karyawan.edit', $data->id_karyawan) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#hapusModal{{ $data->id_karyawan}}">
                Hapus
            </button>

            <!-- Modal -->
            <div class="modal fade" id="hapusModal{{ $data->id_karyawan }}" tabindex="-1"
                aria-labelledby="hapusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('karyawan.softDelete', $data->id_karyawan) }}">
                            @csrf
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Ya</button>
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
@stop
