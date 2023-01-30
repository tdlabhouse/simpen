@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Daftar Retur Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Daftar Retur Barang</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Retur</th>
                                    <th>Tanggal Retur</th>
                                    <th>No Pengiriman</th>
                                    <th>No Purchase Order</th>
                                    <th>Nama Supplier</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Retur</th>
                                    <th>Keterangan</th>
                                    <th>###</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtfpb as $db)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->no_ret}}</td>
                                    <td>{{$db->tgl_ret}}</td>
                                    <td>{{$db->no_do}}</td>
                                    <td>{{$db->no_po}}</td>
                                    <td>{{$db->nm_supplier}}</td>
                                    <td>{{$db->nm_barang}}</td>
                                    <td>{{$db->jml_ret}}</td>
                                    <td>{{$db->ket_ret}}</td>
                                    <td><a href="{{url('cetak-retur', $db->no_ret)}}" class="btn btn-primary btn-sm">Cetak Surat Retur</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection