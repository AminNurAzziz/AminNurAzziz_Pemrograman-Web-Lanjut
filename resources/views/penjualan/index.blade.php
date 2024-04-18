@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Penjualan')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Penjualan')

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

@foreach ($penjualan as $p)
<div class="card">
    <div class="card-header cursor-pointer" data-toggle="collapse" href="#collapse{{ $p->penjualan_id }}">
        <h3 class="card-title">{{ $loop->iteration }} | Detail Penjualan - Kode: {{ $p->penjualan_kode }}</h3>
        <div class="card-tools">
            <a href="{{ route('penjualan.edit', $p->penjualan_id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        </div>
    </div>
    
    <div id="collapse{{ $p->penjualan_id }}" class="card-body collapse">
        <p><strong>Pembeli:</strong> {{ $p->pembeli }}</p>
        <p><strong>Tanggal Penjualan:</strong> {{ $p->penjualan_tanggal }}</p>

        <h3>Detail Barang:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($p->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->barang->barang_nama }}</td>
                        <td>{{ $detail->harga }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->harga * $detail->jumlah }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('penjualan_detail.edit', $detail->detail_id) }}" class="btn btn-warning btn-sm mx-2"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('penjualan_detail.destroy', $detail->detail_id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach
<style>
    .cursor-pointer:hover {
        cursor: pointer;
    }
</style>
@stop
