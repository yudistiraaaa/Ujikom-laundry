@extends("layouts.global")

@section("title") Outlets list @endsection
@section("content")
<div class="section-header">
<h1>Management Outlets</h1>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('outlets.create')}}" class="btn btn-primary">Create outlet</a>
   </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('outlets.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text"
                    placeholder="Cari nama outlet..." />
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
                            <th><b>Nama Outlet</b></th>
                            <th><b>Alamat</b></th>
                            <th><b>Nomor Telepon</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($outlets as $outlet)
                        <tr>
                            <td class="text-center">{{$nomor++}}</td>
                            <td>{{$outlet->nama}}</td>
                            <td>{{$outlet->alamat}}</td>
                            <td>{{$outlet->no_telp}}</td>
                            
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('outlets.edit', [$outlet->id])}}">Edit</a>
                                
                                <form onsubmit="return confirm('Delete this outlet permanently?')" class="d-inline"
                                    action="{{route('outlets.destroy', [$outlet->id ])}}" method="POST">
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
                                {{$outlets->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
