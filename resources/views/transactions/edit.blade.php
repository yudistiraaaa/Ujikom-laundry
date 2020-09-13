@extends('layouts.global')
@section('title') Edit Invoice @endsection

@section('content')
<div class="col-md-8">
    
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('transactions.update', [$transaction->id])}}"
        method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <label for="status">Status Laundry</label><br>
            <select class="form-control" name="status_laundry" id="status_laundry">
                <option {{$transaction->status_laundry == "PROSES" ? "selected" : ""}} value="PROSES">PROSES</option>
                <option {{$transaction->status_laundry == "SELESAI" ? "selected" : ""}} value="SELESAI">SELESAI</option>
            </select>
            <br>

            <label for="status">Status Pembayaran</label><br>
            <select class="form-control" name="status_pembayaran" id="status_pembayaran">
                <option {{$transaction->status_pembayaran == "UNPAID" ? "selected" : ""}} value="UNPAID">UNPAID</option>
                <option {{$transaction->status_pembayaran == "PAID" ? "selected" : ""}} value="PAID">PAID</option>
            </select>
            <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection