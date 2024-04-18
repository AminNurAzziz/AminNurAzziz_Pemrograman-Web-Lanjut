@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Stok')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Stok')

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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Stok</h3>
            <div class="card-tools">
                <a href="{{ route('stok.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Stok
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stoks as $stok)
                    <tr>
                        <td>{{ $stok->stok_id }}</td>
                        <td>{{ $stok->barang->barang_nama }}</td>
                        <td>{{ $stok->user->nama }}</td>
                        <td>{{ $stok->stok_tanggal }}</td>
                        <td>{{ $stok->stok_jumlah }}</td>
                        <td>
                            <a href="{{ route('stok.edit', $stok->stok_id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('stok.destroy', $stok->stok_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus stok ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
