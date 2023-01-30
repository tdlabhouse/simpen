@extends('layouts.app')

@section('content')
<!-- Include file boootstrap.min.js -->
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Data Retur Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Retur Barang</h5>
                    <form action="{{route('laporan-retur-barang')}}" method="get" class="forms-sample">
                        @csrf
                        <div class="col-lg-12">
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <label>Periode Tanggal</label>

                                <div class="input-group">
                                    <input type="text" class="form-control startdate" name="startdate" required />
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control enddate" name="enddate" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Cetak</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
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
@endsection