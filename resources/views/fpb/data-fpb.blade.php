@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Form Permintaan Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Permintaan Barang</h5>
                    <a href="{{route('add-fpb')}}" type="button" class="btn btn-primary mr-2 mb-2 float-right">+ Permintaan Barang</a>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No FPB</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Nama Bagian</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Diperlukan</th>
                                    <th>Pemohon</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtfpb as $db)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->no_fpb}}</td>
                                    <td>{{$db->tgl_fpb}}</td>
                                    <td>{{$db->nm_bagian}}</td>
                                    <td>{{$db->nm_barang}}</td>
                                    <td>{{$db->jumlah}}</td>
                                    <td>{{$db->tgl_diperlukan}}</td>
                                    <td>{{$db->pemohon}}</td>
                                    <td>{{$db->status}}</td>

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