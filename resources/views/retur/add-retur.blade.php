@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Retur Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Retur Barang</h5>
                    <form action="{{route('simpan-retur')}}" method="post" class="forms-sample">
                        @csrf

                        <div class="form-group">
                            <label for="nodo">No Delivery Order</label>
                            <input type="text" class="form-control p-input" id="nodo" name="nodo" placeholder="No DO" value="{{$data->no_do}}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgldo">Tanggal DO</label>
                            <input type="text" class="form-control p-input" id="tgldo" name="tgldo" placeholder="tgldo" value="{{$data->tgl_do}}" required disabled>
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
                                <td>Rp. @money($db->hrg_satuan)</td>
                                <td>{{$db->jumlah}}</td>
                                <td>Rp. @money($db->jumlah * $db->hrg_satuan)</td>
                                <td>{{$db->keterangan}}</td>

                            </tr>
                            @endforeach
                        </table>

                        @if(isset($retur))
                        <h3>Item Diretur</h3>
                        <table class="table table-bordered" id="dataitem">
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                            </tr>
                            @foreach ($detret as $db)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$db['nm_barang']}}</td>
                                <td>Rp. @money($db['hrg_satuan'])</td>
                                <td>{{$db['jml_ret']}}</td>
                                <td>Rp. @money($db['jml_ret'] * $db['hrg_satuan'])</td>
                                <td>{{$db['ket_ret']}}</td>
                                <td>{{$db['tgl']}}</td>

                            </tr>
                            @endforeach
                        </table>
                        @endif
                        @if($jml !=0)
                        <h3>Tambah Retur</h3>
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Pilih Barang</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control  p-input" name="addMoreInputFields[0][barang]" placeholder="pilih barang" required>
                                        <option value="">Pilih Barang </option>
                                        @foreach ($brg as $key => $value)
                                        <option value="{{ $key }}"> {{ $value }} </option>
                                        @endforeach
                                    </select>

                                </td>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][jumlah]" placeholder="jumlah" class="form-control" required />
                                </td>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][keterangan]" placeholder="keterangan" class="form-control" required />
                                </td>
                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Item</button></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{route('fpb')}}" type="button" class="btn btn-success">Kembali</a>
                        </div>
                        @endif
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