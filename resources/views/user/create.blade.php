@extends('layouts.template')
@section('content') 
<div class="row mb-3"> 
<div class="col-lg-12 mt-3 margin-tb"> 
<div class="float-left"> 
<h2>Membuat Daftar User</h2> 
</div> 
<div class="float-right"> 
<a class="btn btn-secondary" href="{{ route('user.index') }}">Kembali</a> 
</div> 
</div> 
</div> 
@if ($errors->any()) 
<div class="alert alert-danger"> 
<strong>Ops</strong> Input gagal<br><br> 
<ul> 
@foreach ($errors->all() as $error) 
<li>{{ $error }}</li> 
@endforeach 
</ul> 
</div> 
@endif 
<form action="{{ route('user.store') }}" method="POST"> 
@csrf 
<div class="col-xs-12 col-sm-12 col-md-12"> 
<div class="form-group"> 
<strong>Username:</strong> 
<input type="text" name="username" class="form-control" 
placeholder="Masukkan username"></input> 
</div> 
</div> 
<div class="col-xs-12 col-sm-12 col-md-12"> 
    <div class="form-group"> 
    <strong>nama:</strong> 
    <input type="text" name="nama" class="form-control" 
placeholder="Masukkan nama"></input> 
    </div> 
</div> 
 
     
<div class="col-xs-12 col-sm-12 col-md-12"> 
    <div class="form-group"> 
    <strong>Password:</strong> 
    <input type="password" name="password" class="form-control" 
placeholder="Masukkan password"></input> 
    </div> 
    </div> 

    <div class="col-xs-12 col-sm-12 col-md-12"> 
        <div class="form-group"> 
        <strong>Level :</strong>
        <select name="level_id" class="form-control">
        @foreach ($level_id as $data)   
        <option value="{{$data->level_id}}">{{$data->level_nama}}</option>
        @endforeach
        </select>
        </div> 
        </div> 
<div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
<button type="submit" class="btn btn-primary">Submit</button> 
</div> 
</form> 
@endsection 