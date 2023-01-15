@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Form Pembayaran</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Pembayaran</h5>
                    <form action="{{route('simpan-bayar')}}" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="nopo">No Purchase Order</label>
                            <input type="text" class="form-control p-input" id="nopo" name="nopo" placeholder="No PO" value="{{$data->no_po}}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_po">Tanggal Purchase Order</label>
                            <input type="text" class="form-control p-input" id="tgl_po" name="tgl_po" placeholder="tgl_po" value="{{$data->tgl_po}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="kd_suplier">Kode Supplier</label>
                            <input type="text" class="form-control p-input" id="kd_suplier" name="kd_suplier" placeholder="kd_suplier" value="{{$data->kd_supplier}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="namasupl">Nama Supplier</label>
                            <input type="text" class="form-control p-input" id="namasupl" name="namasupl" placeholder="namasupl" value="{{$data->nm_supplier}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="noted">Catatan</label>
                            <input type="text" class="form-control p-input" id="noted" name="noted" placeholder="noted" value="{{$data->note}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="ppn">PPN</label>
                            <input type="text" class="form-control p-input" id="ppn" name="ppn" placeholder="ppn" value="{{$data->ppn}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="noref">NO Refenesi Invoice</label>
                            <input type="text" class="form-control p-input" id="noref" name="noref" placeholder="No Referensi Invoice" required>
                        </div>
                        <div class="form-group">
                            <label for="jmlinv">Jumlah Bayar</label>
                            <input type="text" class="form-control p-input" id="jmlinv" name="jmlinv" placeholder="Jumlah Bayar Invoice" required>
                        </div>
                        <div class="form-group">
                            <label for="ketinv">Keterangan Invoice</label>
                            <input type="text" class="form-control p-input" id="ketinv" name="ketinv" placeholder="Keterangan Invoice" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden">
                        </div>
                        <h3>Detail Item</h3>
                        <table class="table table-bordered" id="dataitem">
                            <tr>
                                <th>#</th>
                                <th>Pilih Barang</th>
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{route('po')}}" type="button" class="btn btn-success">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    let listBarang = [];
    $(document).ready(function(e) {
        $.ajax({
            url: "http://localhost/simpen-app/public/api/get-barang",
            method: "get",
            dataType: "json",
            success: function(data, msg) {
                // listBarang=data;
                var text = "";
                text += "<option value=''> — Select a country — </option>";
                $.each(data, function(key, val) {
                    listBarang.push(val)
                    // console.log(val.kode);
                    text += "<option value=" + val.kode + ">" + val.name + "</option>";
                });
                $("#all_country").html(text);
            },
            error: function(msg) {
                console.table(msg);
            }
        })

    });

    var i = 1;
    $("#dynamic-ar").click(function() {
        let newList = '';
        listBarang.forEach(listBarang => {
            newList += "<option value=" + listBarang.kode + ">" + listBarang.name + "</option>";
        });

        $("#dynamicAddRemove").append('<tr><td><select class = "form-control  p-input" name="addMoreInputFields[' + i + '][barang]" placeholder="Enter subject" id="#all_country" required/>' + newList + '</select></td> <td><input type="text" name="addMoreInputFields[' + i + '][jumlah]" placeholder="jumlah" class="form-control" required/></td>  <td><input type="text" name="addMoreInputFields[' + i + '][keterangan]" placeholder="keterangan" class="form-control" required/> </td> <td><button type="button" class="btn btn-outline-danger remove-input-field"> Delete </button></td ></tr>');
        i++;
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

@endsection