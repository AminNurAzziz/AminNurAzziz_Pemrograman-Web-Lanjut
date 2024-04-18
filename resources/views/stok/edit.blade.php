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
            <form action="{{ route('stok.update', $stok->stok_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="barang_id">Barang:</label>
                    <select class="form-control" id="barang_id" name="barang_id">
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->barang_id }}" {{ $stok->barang_id == $barang->barang_id ? 'selected' : '' }}>{{ $barang->barang_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">User:</label>
                    <select class="form-control" id="user_id" name="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ $stok->user_id == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="stok_tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="stok_tanggal" name="stok_tanggal" value="{{ \Carbon\Carbon::parse($stok->stok_tanggal)->format('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label for="stok_jumlah">Jumlah:</label>
                    <input type="number" class="form-control" id="stok_jumlah" name="stok_jumlah" value="{{ $stok->stok_jumlah }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@stop
