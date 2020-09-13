<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
      {{-- <td valign="top"><img src="{{asset('images/logo.png')}}" alt="" width="150"/></td> --}}
        <td align="right">
          <h3>Shinra Electric Power Company</h3>
          <pre>
              {{$transaction->outlets->nama}}
              Jl. Pahlawan No. 33, Kota Bogor.
              +62 87267372632
          </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
      <td><strong>From:</strong> {{$transaction->users->name}}</td>
      <td><strong>To:</strong> {{$transaction->members->nama}}</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Kode Invoice</th>
        <th>Tanggal Di Bayar</th>
        <th>Status Laundry</th>
        <th>Status Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>{{$transaction->kode_invoice}}</td>
        <td align="right">{{$transaction->tgl_bayar}}</td>
        <td align="right">{{$transaction->status_laundry}}</td>
        <td align="right">{{$transaction->status_pembayaran}}</td>
      </tr>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Harga</td>
            <td align="right" class="gray">{{$transaction->packets->harga}}</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>
