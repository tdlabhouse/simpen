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
    <h1>LAPORAN RETUR BARANG</h1>

    <table id="customers">
        <tr>
            <th>NO RETUR</th>
            <th>TANGGAL RETUR</th>
            <th>NO PENGIRIMAN</th>
            <th>SUPPLIER</th>
            <th>NAMA BARANG</th>
            <th>JUMLAH RETUR</th>
        </tr>
        @foreach ($dtfpb as $db)
        <tr>
            <td> {{$db->no_ret}}</a></td>
            <td>{{$db->tgl_ret}}</td>
            <td>{{$db->no_do}}</td>
            <td>{{$db->nm_supplier}}</td>
            <td>{{$db->nm_barang}}</td>
            <td>{{$db->jml_ret}}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>