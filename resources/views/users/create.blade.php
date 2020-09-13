@extends("layouts.global")

@section("title") Create User @endsection

@section("content")

<div class="col-md-8">


    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST">

        @csrf

        <label for="name">Name</label>

            <input value="{{old('name')}}" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" placeholder="Full Name" type="text" name="name" id="name"/>

             <div class="invalid-feedback">
                {{$errors->first('name')}}
             </div>

        <br>

        <label for="username">Username</label>

            <input value="{{old('username')}}" class="form-control {{$errors->first('username') ? "is-invalid": ""}}" placeholder="Username" type="text" name="username" id="username">

            <div class="invalid-feedback">
                {{$errors->first('username')}}
            </div>
        <br>

        <label for="">Roles</label>
        <br>

            <input class="{{$errors->first('roles') ? "is-invalid" : "" }}"  type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
        <label for="ADMIN">Admin</label>

            <input class="{{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="KASIR" value="KASIR">
        <label for="KASIR">Kasir</label>

            <input class="{{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="OWNER" value="OWNER">
        <label for="OWNER">Owner</label>

        <div class="invalid-feedback">
            {{$errors->first('roles')}}
        </div>

        <br>

        <br>


        <label for="email">Email</label>
        <br>
            <input value="{{old('email')}}" class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" placeholder="user@mail.com" type="text" name="email" id="email">

            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
        <br>

        <label for="password">Password</label>
        <br>
            <input  class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="password" type="password" name="password" id="password">

            <div class="invalid-feedback">
                {{$errors->first('password')}}
            </div>

        <br>

        <label for="password_confirmation">Password Confirmation</label>
        <br>
            <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation">

            <div class="invalid-feedback">
                {{$errors->first('password_confirmation')}}
            </div>

        <br>

        <label for="outlets">Outlet</label><br>
        <select name="outlet_id" multiple id="outlets" class="form-control">
        </select>
        <br> <br>

            <input class="btn btn-primary" type="submit" value="Save">

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