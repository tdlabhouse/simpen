@extends('layouts.app')

@section('content')
<!-- partial -->
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Dashboard</h3>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <h4 class="text-danger">
                                <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                            </h4>
                        </div>
                        <div class="float-right">
                            <p class="card-text text-dark">Barang</p>
                            <h4 class="bold-text">{{$databrg}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <h4 class="text-warning">
                                <i class="fa fa-shopping-cart highlight-icon" aria-hidden="true"></i>
                            </h4>
                        </div>
                        <div class="float-right">
                            <p class="card-text text-dark">Purchase Order</p>
                            <h4 class="bold-text">{{$po}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <h4 class="text-success">
                                <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                            </h4>
                        </div>
                        <div class="float-right">
                            <p class="card-text text-dark">Invoice</p>
                            <h4 class="bold-text">Rp. {{$inv}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <h4 class="text-primary">
                                <i class="fa fa-book highlight-icon" aria-hidden="true"></i>
                            </h4>
                        </div>
                        <div class="float-right">
                            <p class="card-text text-dark">Permintaan Barang</p>
                            <h4 class="bold-text">{{$permintaan}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection