@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Level')

{{-- Content --}}

@section('content')
<div class="row ">
    <div class="col-lg-12 mt-5 margin-tb">
        <div class="float-left">
            <h2>Edit User</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('user.index') }}">Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ops!</strong> Error <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('user.update', $user->user_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User_id:</strong>
                <input type="text" name="userid" value="{{ $user->user_id }}" class="form-control" placeholder="Masukkan user id">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Level</strong>
            <select class="form-control" id="level_id" name="level_id" required>
                <option value="">- Pilih Level -</option>
                @foreach ($level as $item)
                    <option value="{{ $item->level_id }}" @if ($item->level_id == $user->level_id) selected @endif>
                        {{ $item->level_nama }}</option>
                @endforeach
            </select>
            @error('level_id')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" value="{{ $user->username }}" class="form-control" name="username" placeholder="Masukkan Nomor username">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nama:</strong>
                <input type="text" value="{{ $user->nama }}" name="nama" class="form-control" placeholder="Masukkan nama">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" value="{{ $user->password }}" name="password" class="form-control" placeholder="Masukkan password">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@endsection
