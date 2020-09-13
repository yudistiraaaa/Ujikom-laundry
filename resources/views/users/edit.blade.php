@extends('layouts.global')
@section('title') Edit User @endsection

@section('content')
<div class="col-md-8">
    
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', [$user->id])}}"
        method="POST">
        @csrf

        <input type="hidden" value="PUT" name="_method">

        <label for="name">Nama</label>
        <input value="{{old('name') ? old('name') : $user->name}}"
            class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" placeholder="Full name" type="text"
            name="name" id="name" />
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
        <br>

        <label for="email">Email</label>
        <input value="{{old('email') ? old('email') : $user->email}}"
            class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" placeholder="user@email.com" type="text"
            name="email" id="email" />
        <div class="invalid-feedback">
            {{$errors->first('email')}}
        </div>
        <br>


        <label for="username">Username</label>
        <input value="{{old('username') ? old('username') : $user->username}}"
            class="form-control {{$errors->first('username') ? "is-invalid" : ""}}" placeholder="Full username" type="text"
            name="username" id="username" />
        <div class="invalid-feedback">
            {{$errors->first('username')}}
        </div>
        <br>

        <label for="">Roles</label>
        <br>
        <input type="checkbox" {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" class=" {{$errors->first('roles') ? "is-invalid" : ""}}" id="ADMIN" value="ADMIN">
        <label for="ADMIN">Admin</label>
        <input type="checkbox" {{in_array("OWNER", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" class=" {{$errors->first('roles') ? "is-invalid" : ""}}" id="OWNER" value="OWNER">
        <label for="OWNER">Owner</label>
        <input type="checkbox" {{in_array("KASIR", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" class=" {{$errors->first('roles') ? "is-invalid" : ""}}" id="KASIR" value="KASIR">
        <label for="KASIR">Kasir</label>
        <br>
        <br>
        <label for="nama">Outlet</label>
        <br>
        <select multiple selected="selected" class="form-control" name="outlet_id" id="outlets">
            @foreach ($outlets  as $id => $nama)
                @if (old('outlet_id', $user->outlet_id) == $id)
                    <option value="{{$id}}" selected>{{$nama}}</option>
                @else
                <option value="{{$id}}">{{$nama}}</option>
                @endif
            @endforeach
        </select>

        <br> <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('#outlets').select2({
        maximumSelectionLength: 1,
        ajax: {
            url: '/ajax/users/search',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nama,
                        }
                    })
                }
            }
        }
    });
</script>
@endsection
