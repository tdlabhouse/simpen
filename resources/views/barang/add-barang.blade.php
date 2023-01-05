@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Master Barang</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tambah Data Barang</h5>
                    <form action="{{route('simpan-barang')}}" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="namaBarang">Nama Barang</label>
                            <input type="text" class="form-control p-input" id="namaBarang" name="namabarang" aria-describedby="namaBarang" placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" class="form-control p-input" id="satuan" name="satuan" placeholder="Satuan" required>
                        </div>
                        <div class="form-group">
                            <label for="hargaSatuan">Harga Satuan</label>
                            <input type="text" class="form-control p-input" id="hargaSatuan" name="hargasatuan" placeholder="Harga Satuan" required>
                        </div>

                        <div class="form-group">
                            <label for="jenisBarang">Jenis Barang</label>
                            <input type="text" class="form-control p-input" id="jenisBarang" name="jenisbarang" placeholder="Jenis Barang" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{route('barang')}}" type="button" class="btn btn-success">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection