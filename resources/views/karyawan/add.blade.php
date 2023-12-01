@extends('clothes.layout')
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
        <h5 class="card-title fw-bolder mb-3">Tambah Pakaian</h5>
        <form method="post" action="{{route('clothes.store')}}">
            @csrf
            <div class="mb-3">
                <label for="clothes_id" class="form-label">ID Pakaian</label>
                <input type="text" class="form-control" id="clothes_id" name="clothes_id">
            </div>
            <div class="mb-3">
                <label for="FK_vendor_id" class="form-label">Vendor ID</label>
                <input type="text" class="form-control" id="FK_vendor_id" name="FK_vendor_id">
            </div>
            <div class="mb-3">
                <label for="clothes_type" class="form-label">Tipe Pakaian</label>
                <input type="text" class="form-control" id="clothes_type" name="clothes_type">
            </div>
            <div class="mb-3">
                <label for="clothes_price" class="form-label">Harga Pakaian</label>
                <input type="text" class="form-control" id="clothes_price" name="clothes_price">
            </div>
            
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop