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
                                    <th>#</th>
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
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->kd_barang}}</td>
                                    <td>{{$db->nm_barang}}</td>
                                    <td>{{$db->hrg_satuan}}</td>
                                    <td>{{$db->satuan}}</td>
                                    <td>{{$db->jenis_barang}}</td>
                                    <td><a href="{{url('edit-barang', $db->kd_barang)}}" class="btn btn-primary btn-sm">Edit</a></td>
                                    <td><a href="{{url('delete-barang', $db->kd_barang)}}" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $dtBarang->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection