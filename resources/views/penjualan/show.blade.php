@extends('adminlte::page')

@section('title', 'Detail Penjualan')

@section('content_header')
    <h1>Detail Penjualan</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <p><strong>Kode Penjualan:</strong> {{ $penjualan->penjualan_kode }}</p>
        <p><strong>Pembeli:</strong> {{ $penjualan->pembeli }}</p>
        <p><strong>Tanggal Penjualan:</strong> {{ $penjualan->penjualan_tanggal }}</p>
        <!-- Tambahan informasi sesuai kebutuhan -->
    </div>
</div>

@stop
