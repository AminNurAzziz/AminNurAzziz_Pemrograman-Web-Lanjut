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

<div class="card">
    <div class="card-body">
        <form action="{{ route('penjualan.update', $penjualan->penjualan_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="pembeli">Pembeli:</label>
                <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ $penjualan->pembeli }}" required>
            </div>
            <div class="form-group">
                <label for="penjualan_kode">Kode Penjualan:</label>
                <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ $penjualan->penjualan_kode }}" required>
            </div>
            <div class="form-group">
                <label for="penjualan_tanggal">Tanggal Penjualan:</label>
                <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" value="{{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@stop
