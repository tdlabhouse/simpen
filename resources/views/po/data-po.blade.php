@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Data Purchase Order</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Purchase Order</h5>
                    <!-- <a href="{{route('add-fpb')}}" type="button" class="btn btn-primary mr-2 mb-2 float-right">+ Purchase Order</a> -->
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No PO</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Nama Supplier</th>
                                    <th>No FPB</th>
                                    <th>kepada</th>
                                    <th>note</th>
                                    <th>Status</th>
                                    <th>###</th>
                                    <th>###</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtpo as $db)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$db->no_po}}</td>
                                    <td>{{$db->tgl_po}}</td>
                                    <td>{{$db->nm_supplier}}</td>
                                    <td>{{$db->no_fpb}}</td>
                                    <td>{{$db->kepada}}</td>
                                    <td>{{$db->note}}</td>
                                    <td {{ ($db->status== 'Dibayar' ) ? 'bgcolor=#00FF00'  : 'bgcolor=red' }}> {{$db->status}}</td>
                                    <td>
                                        @if($db->status== 'Dibayar')
                                        <a href="{{url('bayar-po', $db->no_po)}}" class="btn btn-warning btn-sm">Invoice</a>
                                        @else
                                        <a href="{{url('bayar-po', $db->no_po)}}" class="btn btn-success btn-sm">Pembayaran</a>
                                        @endif
                                    </td>
                                    <td><a href="{{url('cetak-po', $db->no_po)}}" target="_blank" class="btn btn-primary btn-sm">Cetak PO</a></td>

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