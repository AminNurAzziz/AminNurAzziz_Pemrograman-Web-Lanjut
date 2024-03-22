@extends('layout.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Edit Kategori')
@section('content_header_subtitle', 'Edit Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Kategori
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kategori.update', $kategori->kategori_id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kategori_kode">Kategori Kode</label>
                        <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" value="{{ $kategori->kategori_kode }}">
                    </div>

                    <div class="form-group">
                        <label for="kategori_nama">Kategori Nama</label>
                        <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" value="{{ $kategori->kategori_nama }}">
                    </div>

                    <!-- Add more fields as needed -->

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

