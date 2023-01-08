@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Master Supplier</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Data Supplier</h5>
                    <a href="{{route('add-supplier')}}" type="button" class="btn btn-primary mr-2 mb-2 float-right">+ Tambah Supplier</a>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat Supplier</th>
                                    <th>Telepon Supplier</th>
                                    <th>Email Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtSuplier as $db)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->kd_supplier}}</td>
                                    <td>{{$db->nm_supplier}}</td>
                                    <td>{{$db->almt_supplier}}</td>
                                    <td>{{$db->tlp_supplier}}</td>
                                    <td>{{$db->email_supplier}}</td>
                                    <td><a href="{{url('edit-supplier', $db->kd_supplier)}}" class="btn btn-primary btn-sm">Edit</a> || <a href="{{url('delete-supplier', $db->kd_supplier)}}" class="btn btn-danger btn-sm">Delete</a></td>

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