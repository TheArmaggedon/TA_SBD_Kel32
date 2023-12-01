@extends('kartu_akses.layout')

@section('content')

<h4 class="mt-5">Data Kartu Akses</h4>

<a href="{{ route('kartu_akses.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
<a href="{{ route('ruangan.index') }}" type="button" class="btn btn-success rounded-3">Tampilkan Tabel Ruangan</a>
<a href="{{ route('karyawan.index') }}" type="button" class="btn btn-success rounded-3">Tampilkan Tabel Karyawan</a>
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
@stop
