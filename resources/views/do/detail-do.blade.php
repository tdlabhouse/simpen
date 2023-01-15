@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Detail Penerimaan Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Penerimaan Barang</h5>
                    <form action="#" method="post" class="forms-sample">
                        @csrf

                        <div class="form-group">
                            <label for="nodo">No Delivery Order</label>
                            <input type="text" class="form-control p-input" id="nodo" name="nodo" placeholder="No DO" value="{{$data->no_do}}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgldo">Tanggal DO</label>
                            <input type="text" class="form-control p-input" id="tgldo" name="tgldo" placeholder="tgldo" value="{{$data->tgl_do}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="nopo">No PO</label>
                            <input type="text" class="form-control p-input" id="nopo" name="nopo" placeholder="nopo" value="{{$data->no_po}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="noref">No Referensi DO</label>
                            <input type="text" class="form-control p-input" id="noref" name="noref" placeholder="noref" value="{{$data->NoRefDo}}" required disabled>
                        </div>

                        <h3>Item Diterima</h3>
                        <table class="table table-bordered" id="dataitem">
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($detail as $db)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$db->nm_barang}}</td>
                                <td>{{$db->hrg_satuan}}</td>
                                <td>{{$db->jumlah}}</td>
                                <td>{{$db->jumlah * $db->hrg_satuan}}</td>
                                <td>{{$db->keterangan}}</td>

                            </tr>
                            @endforeach
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection