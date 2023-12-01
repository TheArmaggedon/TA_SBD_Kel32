@extends('karyawan.layout')

@section('content')

<h4 class="mt-5">Data Karyawan</h4>

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
