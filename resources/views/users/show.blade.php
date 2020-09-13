@extends('layouts.global')
@section('title') Detail user @endsection
@section('content')

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <b>Nama:</b> <br />
            {{$user->name}}

            <br><br>

            <b>Email:</b><br>
            {{$user->email}}

            <br>
            <br>

            <b>Username:</b> <br>
            {{$user->username}}


            <br>
            <br>

            <b>Outlet:</b> <br>
            {{$user->outlets->nama}}


            <br>
            <br>

            <b>Roles:</b> <br>
            @foreach (json_decode($user->roles) as $role)
            &middot; {{$role}} <br>
            @endforeach

            <br> <br>
            <a href="{{route('users.index')}}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>

@endsection