@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Tambah PO</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Purchase Order</h5>
                    <form action="{{route('simpan-po')}}" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="npfpb">No FPB</label>
                            <input type="text" class="form-control p-input" id="npfpb" name="npfpb" placeholder="No FPB" value="{{$data->no_fpb}}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="bagian">Bagian</label>
                            <input type="text" class="form-control p-input" id="bagian" name="bagian" placeholder="bagian" value="{{$data->nm_bagian}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="pemohon">Pemohon</label>
                            <input type="text" class="form-control p-input" id="pemohon" name="pemohon" placeholder="pemohon" value="{{$data->pemohon}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control p-input" id="tujuan" name="tujuan" placeholder="Tujuan" value="{{$data->tujuan}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tanggal Diperlukan</label>
                            <input type="text" class="form-control p-input" id="tujuan" name="tujuan" placeholder="Tujuan" value="{{$data->tgl_diperlukan}}" required disabled>
                        </div>
                        <div class="form-group">
                            <input type="hidden">
                        </div>
                        <div class="form-group">
                            <label for="supplier">Pilih Supplier</label>
                            <select class="form-control  p-input" id="supplier" name="supplier" placeholder="pilih supplier">
                                <option value="">Pilih Supplier </option>
                                @foreach ($supl as $key => $value)
                                <option value="{{ $key }}"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kepada">Kepada</label>
                            <input type="text" class="form-control p-input" id="kepada" name="kepada" placeholder="kepada" required>
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <input type="text" class="form-control p-input" id="note" name="note" placeholder="note" required>
                        </div>
                        <div class="form-group">
                            <label for="ppn">PPN</label>
                            <input type="text" class="form-control p-input" id="ppn" name="ppn" placeholder="ppn" required>
                        </div>

                        @if($data->status !=1)
                        <h3>Item Diminta</h3>
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
                        <h3>Item Divalidasi</h3>
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

                        @else
                        <h3>Item Diminta</h3>
                        <table class="table table-bordered" id="dataitem">
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Keterangan</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                            @foreach ($detail as $db)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$db->nm_barang}}</td>
                                <td>{{$db->keterangan}}</td>
                                <td>{{$db->hrg_satuan}}</td>
                                <td>{{$db->jumlah}}</td>
                                <td>{{$db->jumlah * $db->hrg_satuan}}</td>

                            </tr>
                            @endforeach
                        </table>

                        <h3>Item Divalidasi</h3>
                        <table class="table table-bordered" id="dataitem">
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                            @foreach ($detail_po as $db)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$db->nm_barang}}</td>
                                <td>{{$db->keterangan}}</td>
                                <td>{{$db->jumlah}}</td>
                                <td>{{$db->hrg_satuan}}</td>
                                <td>{{$db->hrg_satuan * $db->jumlah}}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" style="text-align: center; vertical-align: middle;">
                                    <h4>TOTAL</h4>
                                </td>
                                <td>
                                    <h4>{{$total}}</h4>
                                </td>
                            </tr>
                        </table>
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