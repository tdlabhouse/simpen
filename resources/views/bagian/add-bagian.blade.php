@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4">Master Bagian</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tambah Data Bagian</h5>
                    <form action="{{route('simpan-bagian')}}" method="post" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="namaBagian">Nama Bagian</label>
                            <input type="text" class="form-control p-input" id="namaBagian" name="namabagian" aria-describedby="namaBagian" placeholder="Nama Bagian" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telpon Bagian</label>
                            <input type="text" class="form-control p-input" id="telepon" name="telepon" placeholder="Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat email</label>
                            <input type="email" class="form-control p-input" id="email" name="email" placeholder="Alamat email" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{route('bagian')}}" type="button" class="btn btn-success">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection