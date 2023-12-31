@extends('kartu_akses.layout')

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
                <li class="nav-item">
                    <a class ="nav-link" href="{{route('challenge.index')}}">General Search</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<h4 class="mt-5">Data Kartu Akses</h4>

<div class="mt-3">
    <form action="{{ route('kartu_akses.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search...">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
</div>

<a href="{{ route('kartu_akses.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No Kartu</th>
            <th>ID Karyawan</th>
            <th>Hak Akses</th>
            <th>ID Ruangan</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->no_kartu }}</td>
            <td>{{ $data->id_karyawan }}</td>
            <td>{{ $data->hak_akses }}</td>
            <td>{{ $data->id_ruangan }}</td>
            <td>
                <a href="{{ route('kartu_akses.edit', $data->no_kartu) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#hapusModal{{ $data->no_kartu}}">
                Hapus
            </button>

            <!-- Modal -->
            <div class="modal fade" id="hapusModal{{ $data->no_kartu }}" tabindex="-1"
                aria-labelledby="hapusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('kartu_akses.softDelete', $data->no_kartu) }}">
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

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No Kartu</th>
            <th>Nama Karyawan</th>
            <th>Hak Akses</th>
            <th>Nama Ruangan</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($datajoineds as $data1)
        <tr>
            <td>{{ $data1->no_kartu }}</td>
            <td>{{ $data1->nama }}</td>
            <td>{{ $data1->hak_akses }}</td>
            <td>{{ $data1->nama_ruangan }}</td>
            <td>
                <form action="{{ route('kartu_akses.softDelete', $data1->no_kartu) }}" method="POST">
                    @csrf
                    @method('POST') 
                    
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
