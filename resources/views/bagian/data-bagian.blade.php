@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Master Bagian</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Data Bagian</h5>
                    <a href="{{route('add-bagian')}}" type="button" class="btn btn-primary mr-2 mb-2 float-right">+ Tambah Bagian</a>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Bagian</th>
                                    <th>Telpon Bagian</th>
                                    <th>Email Bagian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtBagian as $db)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->kd_bagian}}</td>
                                    <td>{{$db->nm_bagian}}</td>
                                    <td>{{$db->tlp_bagian}}</td>
                                    <td>{{$db->email}}</td>
                                    <td><a href="{{url('edit-bagian', $db->kd_bagian)}}" class="btn btn-primary btn-sm">Edit</a> || <a href="{{url('delete-bagian', $db->kd_bagian)}}" class="btn btn-danger btn-sm">Delete</a></td>

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