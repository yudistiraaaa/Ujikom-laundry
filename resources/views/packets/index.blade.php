@extends("layouts.global")

@section("title") Packets list @endsection
@section("content")
<div class="section-header">

    <h1>Management Packets</h1>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('packets.create')}}" class="btn btn-primary">Create pakect</a>
   </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('packets.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text"
                    placeholder="Cari nama paket..." />
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
                            <th><b>Nama Paket</b></th>
                            <th><b>Harga</b></th>
                            <th><b>Jenis Paket</b></th>
                            <th><b>Outlet</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($packets as $p)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$p->nama_paket}}</td>
                            <td>{{$p->harga}}</td>
                            <td>{{$p->jenis_paket}}</td>
                            <td>{{$p->outlets->nama}}</td>
                            
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('packets.edit', [$p->id])}}">Edit</a>
                
                                <a href="{{route('packets.show', [$p->id])}}" class="btn btn-primary btn-sm">Detail</a>
                                
                                <form onsubmit="return confirm('Delete this packet permanently?')" class="d-inline"
                                    action="{{route('packets.destroy', [$p->id ])}}" method="POST">
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
                                {{$packets->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
               </div>
           </div>
       </div>
   </div>
@endsection
