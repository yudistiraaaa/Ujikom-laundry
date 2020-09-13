@extends("layouts.global")

@section("title") Create Paket @endsection

@section("content")

<div class="col-md-8">


    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('packets.store')}}"
        method="POST">

        @csrf
        <label for="nama_paket">Nama Paket</label><br>

        <input value="{{old('nama_paket')}}" class="form-control {{$errors->first('nama_paket') ? "is-invalid": ""}}"
            placeholder="Masukan nama paket" type="text" name="nama_paket" id="nama_paket" />

        <div class="invalid-feedback">
            {{$errors->first('nama_paket')}}
        </div>

        <br>

        <label for="harga">Harga</label><br>

        <input value="{{old('harga')}}" class="form-control {{$errors->first('harga') ? "is-invalid": ""}}"
            placeholder="Masukan harga" type="number" name="harga" id="harga" />

        <div class="invalid-feedback">
            {{$errors->first('harga')}}
        </div>

        <br>

        <label for="">Jenis Paket</label>
        
            <select class="form-control" id="jenis_paket" name="jenis_paket">
                <option>-- Silahkan pilih satu --</option>

                <option class="{$errors->first('jenis_paket') ? 'is-invalid' : '' }}" type="checkbox" name="jenis_paket"
                    id="kiloan" value="kiloan">Kiloan</option>

                <option class="{$errors->first('jenis_paket') ? 'is-invalid' : '' }}" type="checkbox" name="jenis_paket"
                    id="selimut" value="selimut">Selimut</option>

                <option class="{$errors->first('jenis_paket') ? 'is-invalid' : '' }}" type="checkbox" name="jenis_paket"
                    id="bed_cover" value="bed_cover">Bed Cover</option>

                <option class="{$errors->first('jenis_paket') ? 'is-invalid' : '' }}" type="checkbox" name="jenis_paket"
                        id="kaos" value="kaos">Kaos</option>
            </select>

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
