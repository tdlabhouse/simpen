@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Permintaan Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form Permintaan Barang</h5>
                    <form action="{{route('simpan-fpb')}}" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="bagian">Pilih Bagian</label>
                            <select class="form-control  p-input" id="bagian" name="bagian" placeholder="pilih bagian">
                                <option value="">Pilih Bagian </option>
                                @foreach ($data as $key => $value)
                                <option value="{{ $key }}"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="barang">Pilih Barang</label>
                            <select class="form-control  p-input" id="barang" name="barang" placeholder="pilih barang">
                                <option value="">Pilih Barang </option>
                                @foreach ($databrg as $key => $value)
                                <option value="{{ $key }}"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control p-input" id="keterangan" name="keterangan" placeholder="keterangan barang" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control p-input" id="jumlah" name="jumlah" placeholder="jumlah barang" required>
                        </div>
                        <div class="form-group">
                            <label for="pemohon">Pemohon</label>
                            <input type="text" class="form-control p-input" id="pemohon" name="pemohon" placeholder="pemohon" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Diperlukan</label>
                            <div class='input-group date' id='datepicker'>
                                <input type='text' class="form-control" id="tanggal" name="tanggal" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control p-input" id="tujuan" name="tujuan" placeholder="Tujuan" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden">
                        </div>

                        <table class="table table-bordered" id="dynamicTable">
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="addmore[0][name]" placeholder="Enter your Name" class="form-control" /></td>
                                <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td>
                                <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{route('fpb')}}" type="button" class="btn btn-success">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    var i = 0;

    $("#add").click(function() {
        ++i;

        $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>