@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Level')

{{-- Content --}}

@section('content')
    <h1>Edit Level</h1>
    <form action="{{ route('level.update', $level->level_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="level_kode">Kode Level:</label>
            <input type="text" class="form-control" id="level_kode" name="level_kode" value="{{ $level->level_kode }}">
        </div>
        <div class="form-group">
            <label for="level_nama">Nama Level:</label>
            <input type="text" class="form-control" id="level_nama" name="level_nama" value="{{ $level->level_nama }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
