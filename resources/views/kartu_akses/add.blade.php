@extends('kartu_akses.layout')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Data Kartu Akses</h5>
        <form method="post" action="{{route('kartu_akses.store')}}">
            @csrf
            <div class="mb-3">
                <label for="no_kartu" class="form-label">No Kartu</label>
                <input type="text" class="form-control" id="no_kartu" name="no_kartu">
            </div>
            <div class="mb-3">
                <label for="id_karyawan" class="form-label">ID Karyawan</label>
                <input type="text" class="form-control" id="id_karyawan" name="id_karyawan">
            </div>
            <div class="mb-3">
                <label for="hak_akses" class="form-label">Hak Akses</label>
                <input type="text" class="form-control" id="hak_akses" name="hak_akses">
            </div>
            <div class="mb-3">
                <label for="id_ruangan" class="form-label">ID Ruangan</label>
                <input type="text" class="form-control" id="id_ruangan" name="id_ruangan">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop