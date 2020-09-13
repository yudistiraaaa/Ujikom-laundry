@extends("layouts.global")

@section("title") Members list @endsection
@section("content")
<div class="section-header">

    <h1>Management Members</h1>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('members.create')}}" class="btn btn-primary">Create member</a>
   </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('members.index')}}">
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
                            <th><b>Alamat</b></th>
                            <th><b>Nomor Hp</b></th>
                            <th><b>Jenis Kelamin</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($members as $member)
                        <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{$member->nama}}</td>
                            <td>{{$member->alamat}}</td>
                            <td>{{$member->no_telp}}</td>
                            <td>                
                                @if($member->jenis_kelamin == "L")
                                <p>
                                    Laki-Laki
                                </p>
                                @else
                                <p>
                                    Perempuan
                                </p>
                                @endif
                            </td>
                            
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('members.edit', [$member->id])}}">Edit</a>
                                
                                <form onsubmit="return confirm('Delete this member permanently?')" class="d-inline"
                                    action="{{route('members.destroy', [$member->id ])}}" method="POST">
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
                                {{$members->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
               </div>
           </div>
       </div>
   </div>
@endsection
