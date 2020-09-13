@extends("layouts.global")

@section("title") Invoice list @endsection
@section("content")
<div class="section-header">
    <h1>Management Invoice</h1>

</div>

@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('transactions.create')}}" class="btn btn-primary">Create Invoice</a>
   </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('transactions.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text"
                    placeholder="Cari kode invoice..." />
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
            <th><b>Kode Invoice</b></th>
            <th><b>Harga</b></th>
            <th><b>Status Laundry</b></th>
            <th><b>Status Pembayaran</b></th>
            <th><b>Action</b></th>
        </tr>
    </thead>
    <tbody>

        @foreach($transactions as $transaction)
        <tr>
            <td class="text-center">{{$nomor++}}</td>
            <td>{{$transaction->kode_invoice}}</td>
            <td>Rp.{{$transaction->packets->harga}}</td>
            <td>
                @if($transaction->status_laundry == "PROSES")
                <span class="badge badge-danger">
                    {{$transaction->status_laundry}}
                </span>
                @else
                <span class="badge badge-info">
                    {{$transaction->status_laundry}}
                </span>
                @endif
            </td>

            <td>
                @if($transaction->status_pembayaran == "UNPAID")
                <span class="badge badge-danger">
                    {{$transaction->status_pembayaran}}
                </span>
                @else
                <span class="badge badge-success">
                    {{$transaction->status_pembayaran}}
                </span>
                @endif
            </td>
            
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('transactions.edit', [$transaction->id])}}">Edit</a>
                <a href="{{route('export.pdf', [$transaction->id])}}" class="btn btn-primary btn-sm">Detail</a>

                <form onsubmit="return confirm('Delete this transaction permanently?')" class="d-inline"
                    action="{{route('transactions.destroy', [$transaction->id ])}}" method="POST">
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
                {{$transactions->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
               </div>
           </div>
       </div>
   </div>
@endsection
