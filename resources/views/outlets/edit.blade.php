@extends('layouts.global')
@section('title') Edit Outlet @endsection

@section('content')
<div class="col-md-8">
    
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('outlets.update', [$outlet->id])}}"
        method="POST">
        @csrf

        <input type="hidden" value="PUT" name="_method">

        
        <label for="nama">Nama</label>
        <input value="{{old('nama') ? old('nama') : $outlet->nama}}"
            class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" placeholder="Masukan nama outlet" type="text"
            name="nama" id="nama" />
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        <br>


        <label for="alamat">Alamat</label>
        <input value="{{old('alamat') ? old('alamat') : $outlet->alamat}}"
            class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}" placeholder="Masukan alamat" type="text"
            name="alamat" id="alamat" />
        <div class="invalid-feedback">
            {{$errors->first('alamat')}}
        </div>
        <br>

        <label for="no_telp">Nomor Telepon</label>
        <input value="{{$outlet->no_telp}}" class="form-control" placeholder="No Hp" type="number"
            name="no_telp" id="no_telp" />
        <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection