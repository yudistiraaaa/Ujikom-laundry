@extends("layouts.global")

@section("title") Create Member @endsection

@section("content")

<div class="col-md-8">

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('members.store')}}" method="POST">

        @csrf

        <label for="nama">Nama</label>

            <input value="{{old('nama')}}" class="form-control {{$errors->first('nama') ? "is-invalid": ""}}" placeholder="Masukan nama member" type="text" name="nama" id="nama"/>

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

    <label for="">Jenis Kelamin</label>
        <br>

            <input class="{{$errors->first('jenis_kelamin') ? "is-invalid" : "" }}"  type="checkbox" name="jenis_kelamin[]" id="L" value="L">
        <label for="L">Laki-Laki</label>
        

            <input class="{{$errors->first('jenis_kelamin') ? "is-invalid" : "" }}" type="checkbox" name="jenis_kelamin[]" id="P" value="P">
        <label for="P">Perempuan</label>


        <div class="invalid-feedback">
            {{$errors->first('jenis_kelamin')}}
        </div>

        <br>
    <br>

        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
