@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Barang</h3>
            <div class="card-tools">
                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Barang
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="barang-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Barang Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td>{{ $barang->barang_kode }}</td>
                            <td>{{ $barang->barang_nama }}</td>
                            <td>{{ $barang->harga_beli }}</td>
                            <td>{{ $barang->harga_jual }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $barang->barang_id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('barang.destroy', $barang->barang_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('#barang-table').DataTable();
        });
    </script>
@stop
