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
                            <label for="pemohon">Pemohon</label>
                            <input type="text" class="form-control p-input" id="pemohon" name="pemohon" placeholder="pemohon" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Diperlukan</label>
                            <input type="text" class="form-control datepicker" name="tanggal" />
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control p-input" id="tujuan" name="tujuan" placeholder="Tujuan" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden">
                        </div>

                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Pilih Barang</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control  p-input" name="addMoreInputFields[0][barang]" placeholder="pilih barang">
                                        <option value="">Pilih Barang </option>
                                        @foreach ($databrg as $key => $value)
                                        <option value="{{ $key }}"> {{ $value }} </option>
                                        @endforeach
                                    </select>

                                </td>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][jumlah]" placeholder="jumlah" class="form-control" />
                                </td>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][keterangan]" placeholder="keterangan" class="form-control" />
                                </td>
                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Item</button></td>
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
<!-- Include file jquery.min.js -->
<script src="{{ asset('js/jquery.min.js')  }}"></script>
<!-- <script src="js/jquery.min.js"></script> -->

<!-- Include file boootstrap.min.js -->
<script src="{{ asset('js/bootstrap.min.js')  }}"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->

<!-- Include library Bootstrap Datepicker -->
<script src="{{ asset('js/bootstrap.min.js')  }}"></script>
<!-- <script src="js/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> -->

<!-- Include file custom.js -->
<script src="{{ asset('js/custom.js')  }}"></script>
<!-- <script src="js/custom.js"></script> -->

<script>
    $(document).ready(function() {
        setDatePicker()
        setDateRangePicker(".startdate", ".enddate")
        setMonthPicker()
        setYearPicker()
        setYearRangePicker(".startyear", ".endyear")
    })
</script>

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

        $("#dynamicAddRemove").append('<tr><td><select class = "form-control  p-input" name="addMoreInputFields[' + i + '][barang]" placeholder="Enter subject" id="#all_country" />' + newList + '</select></td> <td><input type="text" name="addMoreInputFields[' + i + '][jumlah]" placeholder="jumlah" class="form-control" /></td>  <td><input type="text" name="addMoreInputFields[' + i + '][keterangan]" placeholder="keterangan" class="form-control" /> </td> <td><button type="button" class="btn btn-outline-danger remove-input-field"> Delete </button></td ></tr>');
        i++;
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

@endsection