@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->barang_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kategori_id">Kategori ID:</label>
                    <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="{{ $barang->kategori_id }}">
                </div>
                <div class="form-group">
                    <label for="barang_kode">Barang Kode:</label>
                    <input type="text" class="form-control" id="barang_kode" name="barang_kode" value="{{ $barang->barang_kode }}">
                </div>
                <div class="form-group">
                    <label for="barang_nama">Nama Barang:</label>
                    <input type="text" class="form-control" id="barang_nama" name="barang_nama" value="{{ $barang->barang_nama }}">
                </div>
                <div class="form-group">
                    <label for="harga_beli">Harga Beli:</label>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}">
                </div>
                <div class="form-group">
                    <label for="harga_jual">Harga Jual:</label>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
        </div>
    </div>
@stop
