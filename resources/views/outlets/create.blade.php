@extends("layouts.global")

@section("title") Create Outlet @endsection

@section("content")

<div class="col-md-8">

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('outlets.store')}}" method="POST">

        @csrf

        <label for="nama">Nama</label>

            <input value="{{old('nama')}}" class="form-control {{$errors->first('nama') ? "is-invalid": ""}}" placeholder="Masukan nama outlet" type="text" name="nama" id="nama"/>

             <div class="invalid-feedback">
                {{$errors->first('nama')}}
             </div>

        <br>

        <label for="alamat">Alamat</label>

            <input value="{{old('alamat')}}" class="form-control {{$errors->first('alamat') ? "is-invalid": ""}}" placeholder="Masukan alamat" type="text" name="alamat" id="alamat">

            <div class="invalid-feedback">
                {{$errors->first('alamat')}}
            </div>
        <br>

        <label for="no_telp">Nomor Telepon</label>

        <input value="{{old('no_telp')}}" class="form-control {{$errors->first('no_telp') ? "is-invalid": ""}}" placeholder="Masukan nomor telepon" type="number" name="no_telp" id="no_telp">

        <div class="invalid-feedback">
            {{$errors->first('no_telp')}}
        </div>
    <br>

        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
