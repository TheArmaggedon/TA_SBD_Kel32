@extends('recyclebin.layout')

@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

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

<h4 class="mt-5">Recycle Bin Karyawan</h4>

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Karyawan</th>
            <th>Nama</th>
            <th>Alamat</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($dataKaryawan as $data)
        <tr>
            <td>{{ $data->id_karyawan }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->alamat }}</td>
            <td>
                <form action="{{ route('karyawan.hardDelete', $data->id_karyawan) }}" method="POST">
                    @csrf
                    @method('POST') 
                    
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>

                <form action="{{ route('karyawan.restore', $data->id_karyawan) }}" method="POST">
                    @csrf
                    @method('POST') 
                    
                    <button type="submit" class="btn btn-danger">
                        Restore
                    </button>
                </form>

            
            </div>

            

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Recycle Bin Kartu Akses</h4>

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
        @foreach ($dataKartuAkses as $data1)
        <tr>
            <td>{{ $data1->no_kartu }}</td>
            <td>{{ $data1->id_karyawan }}</td>
            <td>{{ $data1->hak_akses }}</td>
            <td>{{ $data1->id_ruangan }}</td>
            <td>
                <form action="{{ route('kartu_akses.hardDelete', $data1->no_kartu) }}" method="POST">
                    @csrf
                    @method('POST') {{-- Use 'POST' method for hard delete --}}
                    
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>
                <form action="{{ route('kartu_akses.restore', $data1->no_kartu) }}" method="POST">
                    @csrf
                    @method('POST') {{-- Use 'POST' method for restore --}}
                    
                    <button type="submit" class="btn btn-danger">
                        Restore
                    </button>
                </form>
            

            </td>
        </tr>
        @endforeach
    </tbody>
</table>




<h4 class="mt-5">Recycle Bin Ruangan</h4>

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Ruangan</th>
            <th>Nama Ruangan</th>
            <th>Akses Level</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($dataRuangan as $data2)
        <tr>
            <td>{{ $data2->id_ruangan }}</td>
            <td>{{ $data2->nama_ruangan }}</td>
            <td>{{ $data2->level_akses }}</td>
            <td>
                
                <form action="{{ route('ruangan.hardDelete', $data2->id_ruangan) }}" method="POST">
                    @csrf
                    @method('POST') 
                    
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>

                <form action="{{ route('ruangan.restore', $data2->id_ruangan) }}" method="POST">
                    @csrf
                    @method('POST') 
                    
                    <button type="submit" class="btn btn-danger">
                        Restore
                    </button>
                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop