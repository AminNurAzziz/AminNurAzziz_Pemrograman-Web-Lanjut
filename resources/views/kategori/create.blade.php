@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Level')

{{-- Content --}}

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Terdapat kesalahan input. <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
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

                        @error('kategori_kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori_kode">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" placeholder="Masukkan Kode Kategori">

                        @error('kategori_nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

