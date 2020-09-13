@extends("layouts.global")

@section("title") Create Inovice @endsection

@section("content")

<div class="col-md-8">

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('transactions.store')}}" method="POST">

        @csrf

        <label for="nama">Kode Invoice</label>

            <input value="{{old('kode_invoice')}}" class="form-control {{$errors->first('kode_invoice') ? "is-invalid": ""}}" placeholder="Masukan kode invoice" type="text" name="kode_invoice" id="kode_invoice"/>

             <div class="invalid-feedback">
                {{$errors->first('kode_invoice')}}
             </div>

    <br>

    <label for="outlets">Outlet</label><br>
    <select name="outlet_id" multiple id="outlets" class="form-control">
    </select>
    <br> <br>

    <label for="member">Member</label><br>
    <select name="member_id" multiple id="members" class="form-control">
    </select>
    <br> <br>

    <label for="packet">Packet</label><br>
    <select name="packet_id" multiple id="packets" class="form-control">
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
            url: '/ajax/transactions/search',
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

<script>
    $('#members').select2({
        maximumSelectionLength: 1,
        ajax: {
            url: '/ajax/transactions/search_member',
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

<script>
    $('#packets').select2({
        maximumSelectionLength: 1,
        ajax: {
            url: '/ajax/transactions/search_paket',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nama_paket,
                        }
                    })
                }
            }
        }
    });
</script>

@endsection