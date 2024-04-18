@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Penjualan')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Penjualan')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Level</th>
                <th>Nama Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->level_id }}</td>
                    <td>{{ $d->level_kode }}</td>
                    <td>{{ $d->level_nama }}</td>
                    <td>
                        <a href="{{ route('level.edit', $d->level_id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('level.destroy', $d->level_id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('level.create') }}" class="btn btn-success">Tambah Level</a>
@endsection
