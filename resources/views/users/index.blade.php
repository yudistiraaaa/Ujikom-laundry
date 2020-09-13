@extends("layouts.global")

@section("title") Users list @endsection
@section("content")
<div class="section-header">
    <h1>Management Users</h1>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('users.create')}}" class="btn btn-primary">Create user</a>
   </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('users.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text"
                    placeholder="Cari nama pengguna..." />
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary btn-sm">
                </div>
            </div>
        </form>
    </div>
</div>

   <br>   

<div class="panel panel-default">
    <div class="panel-body">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><b>#</b></th>
                            <th><b>Nama</b></th>
                            <th><b>Outlet</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->outlets->nama}}</td>
                            
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Edit</a>
                
                                <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                                
                                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                    action="{{route('users.destroy', [$user->id ])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=10>
                                {{$users->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
