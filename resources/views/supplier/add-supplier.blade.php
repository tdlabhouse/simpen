@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Master Supplier</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tambah Data Supplier</h5>
                    <form action="{{route('simpan-supplier')}}" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="namasupplier">Nama Supplier</label>
                            <input type="text" class="form-control p-input" id="namasupplier" name="namasupplier" aria-describedby="namasupplier" placeholder="Nama Supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon Supplier</label>
                            <input type="text" class="form-control p-input" id="telepon" name="telepon" placeholder="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Supplier</label>
                            <textarea class="form-control p-input" id="alamat" name="alamat" placeholder="alamat lengkap" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Supplier</label>
                            <input type="email" class="form-control p-input" id="email" name="email" placeholder="email" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{route('supplier')}}" type="button" class="btn btn-success">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection