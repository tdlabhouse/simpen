@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Master Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Data Barang</h5>
                    <a href="{{route('add-barang')}}" type="button" class="btn btn-primary mr-2 mb-2 float-right">+ Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table center-aligned-table">
                            <thead>
                                <tr class="text-primary">
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Jenis Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtBarang as $db)
                                <tr class="">
                                    <td>{{$db->kd_barang}}</td>
                                    <td>{{$db->nm_barang}}</td>
                                    <td>{{$db->hrg_satuan}}</td>
                                    <td>{{$db->satuan}}</td>
                                    <td>{{$db->jenis_barang}}</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                                    <td><a href="#" class="btn btn-danger btn-sm">Remove</a></td>
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
@include('sweetalert::alert')
@endsection