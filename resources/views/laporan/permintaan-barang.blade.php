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
    </style>
</head>

<body>

    <h1>LAPORAN PERMINTAAN BARANG</h1>

    <table id="customers">
        <tr>
            <th>NO FPB</th>
            <th>TANGGAL PERMINTAAN</th>
            <th>NAMA BAGIAN</th>
            <th>TANGGAL DIPERLUKAN</th>
            <th>PEMOHON</th>
            <th>STATUS</th>
        </tr>
        @foreach ($dtfpb as $db)
        <tr>
            <td> {{$db->no_fpb}}</a></td>
            <td>{{$db->tgl_fpb}}</td>
            <td>{{$db->nm_bagian}}</td>
            <td>{{$db->tgl_diperlukan}}</td>
            <td>{{$db->pemohon}}</td>
            <td>{{$db->status}}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>