@extends('layouts.global')
@section('title') Edit Packet @endsection

@section('content')
<div class="col-md-8">
    
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('packets.update', [$packet->id])}}"
        method="POST">
        @csrf

        <input type="hidden" value="PUT" name="_method">

        
        <label for="nama_paket">Nama Paket</label>
        <input value="{{old('nama_paket') ? old('nama_paket') : $packet->nama_paket}}"
            class="form-control {{$errors->first('nama_paket') ? "is-invalid" : ""}}" placeholder="Masukan nama paket packet" type="text"
            name="nama_paket" id="nama_paket" />
        <div class="invalid-feedback">
            {{$errors->first('nama_paket')}}
        </div>
        <br>

        <label for="harga">Harga</label>
        <input value="{{old('harga') ? old('harga') : $packet->harga}}"
            class="form-control {{$errors->first('harga') ? "is-invalid" : ""}}" placeholder="Masukan harga " type="number"
            name="harga" id="harga" />
        <div class="invalid-feedback">
            {{$errors->first('harga')}}
        </div>
        <br>

        <label for="jenis_paket">Jenis Harga</label>

        <select class="form-control" id="jenis_paket" name="jenis_paket">
            <option >-- Silahkan pilih satu --</option>

            <option value="kiloan" @if($packet->jenis_paket == 'kiloan') selected @endif>Kiloan</option>
            <option value="selimut" @if($packet->jenis_paket == 'selimut') selected @endif>Selimut</option>
            <option value="bed_cover" @if($packet->jenis_paket == 'bed_cover') selected @endif>Bed Cover</option>
            <option value="kaos" @if($packet->jenis_paket == 'kaos') selected @endif>Kaos</option>
        </select>

        <br>

        <label for="nama">Outlet</label>
        <br>
        <select multiple selected="selected" class="form-control" name="outlet_id" id="outlets">
            @foreach ($outlets  as $id => $nama)
                @if (old('outlet_id', $packet->outlet_id) == $id)
                    <option value="{{$id}}" selected>{{$nama}}</option>
                @else
                <option value="{{$id}}">{{$nama}}</option>
                @endif
            @endforeach
        </select>

        <br>
        <br>



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
            url: '/ajax/packets/search',
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
