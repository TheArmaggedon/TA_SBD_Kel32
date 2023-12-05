@extends('ruangan.layout')
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
        <h5 class="card-title fw-bolder mb-3">Data Ruangan</h5>
        <form method="post" action="{{route('ruangan.store')}}">
            @csrf
            <div class="mb-3">
                <label for="id_ruangan" class="form-label">ID Ruangan</label>
                <input type="text" class="form-control" id="id_ruangan" name="id_ruangan">
            </div>
            <div class="mb-3">
                <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan">
            </div>
            <div class="mb-3">
                <label for="level_akses" class="form-label">Akses Level</label>
                <input type="text" class="form-control" id="level_akses" name="level_akses">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop