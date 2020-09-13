@extends('layouts.global')
@section('title') Edit Member @endsection

@section('content')
<div class="col-md-8">
    
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('members.update', [$member->id])}}"
        method="POST">
        @csrf

        <input type="hidden" value="PUT" name="_method">

        
        <label for="nama">Nama</label>
        <input value="{{old('nama') ? old('nama') : $member->nama}}"
            class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" placeholder="Masukan nama member" type="text"
            name="nama" id="nama" />
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        <br>


        <label for="alamat">Alamat</label>
        <input value="{{old('alamat') ? old('alamat') : $member->alamat}}"
            class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}" placeholder="Masukan alamat" type="text"
            name="alamat" id="alamat" />
        <div class="invalid-feedback">
            {{$errors->first('alamat')}}
        </div>
        <br>

        <label for="no_telp">Nomor Telepon</label>
        <input value="{{$member->no_telp}}" class="form-control" placeholder="No Hp" type="number"
            name="no_telp" id="no_telp" />
        <br>

        <label for="">Jenis Kelamin</label>
        <br>
        <input type="checkbox" {{$member->jenis_kelamin == 'L' ? 'checked' : ''}} class="{{$errors->first('jenis_kelamin') ? "is-invalid" : "" }}" name="jenis_kelamin[]"id="L" value="L">
        <label for="L">Laki-Laki</label>

        <input type="checkbox" {{$member->jenis_kelamin == 'P' ? 'checked' : ''}} class="{{$errors->first('jenis_kelamin') ? "is-invalid" : "" }}" name="jenis_kelamin[]"id="P" value="P">
        <label for="P">Perempuan</label>

        <div class="invalid-feedback">
            {{$errors->first('jenis_kelamin')}}
        </div>

        <br>
        <br>


        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection