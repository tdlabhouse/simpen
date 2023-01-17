@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Data Penerimaan Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Penerimaan Barang</h5>
                    <a href="{{route('add-ttb')}}" type="button" class="btn btn-primary mr-2 mb-2 float-right">+ Penerimaan Barang</a>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Penerimaan</th>
                                    <th>Tanggal Penerimaan</th>
                                    <th>No Po</th>
                                    <th>No Referensi</th>
                                    <th>###</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtdo as $db)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->no_do}}</td>
                                    <td>{{$db->tgl_do}}</td>
                                    <td>{{$db->no_po}}</td>
                                    <td>{{$db->NoRefDo}}</td>
                                    <td><a href="{{url('detail-ttb', $db->no_do)}}" class="btn btn-primary btn-sm">Detail</a>
                                        || <a href="{{url('add-retur', $db->no_do)}}" class="btn btn-success btn-sm">Retur</a>
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