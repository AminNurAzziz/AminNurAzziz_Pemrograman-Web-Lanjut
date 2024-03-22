@extends('layout.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Kategori</h3>
            </div>

            <form action="../kategori" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="kategori_nama">Kode Kategori</label>
                        <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" placeholder="Masukkan Nama Kategori">
                    </div>

                    <div class="form-group">
                        <label for="kategori_kode">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" placeholder="Masukkan Kode Kategori">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

