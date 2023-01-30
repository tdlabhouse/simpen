<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        img {
            height: 80px;
        }
    </style>
</head>

<body>
    <img src="{{asset('star/img/logo.jpeg')}}" alt="">
    <h1>LAPORAN PENERIMAAN BARANG</h1>

    <table id="customers">
        <tr>
            <th>NO PENGIRIMAN</th>
            <th>TANGGAL PENGIRIMAN</th>
            <th>NO PURCHASE ORDER</th>
            <th>SUPPLIER</th>
            <th>NAMA BARANG</th>
            <th>QTY</th>
            <th>HARGA SATUAN</th>
            <th>TOTAL</th>
        </tr>
        @foreach ($dtfpb as $db)
        <tr>
            <td> {{$db->no_do}}</a></td>
            <td>{{$db->tgl_do}}</td>
            <td>{{$db->no_po}}</td>
            <td>{{$db->nm_supplier}}</td>
            <td>{{$db->nm_barang}}</td>
            <td>{{$db->jumlah}}</td>
            <td>{{$db->hrg_satuan}}</td>
            <td>{{$db->hrg_satuan * $db->jumlah}} </td>
        </tr>
        @endforeach
    </table>

</body>

</html>