@extends('layouts.template')

{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Level')

{{-- Content --}}

@section('content')
<div class="row mb-5"> 
<div class="col-lg-12 mt-5 margin-tb"> 
<div class="float-left"> 
<h2> Show User</h2> 
</div> 
<div class="float-right"> 
<a class="btn btn-secondary" href="{{ route('user.index') }}"> 
Kembali</a> 
</div> 
</div> 
</div> 
<div class="row"> 
<div class="col-xs-12 col-sm-12 col-md-12"> 
<div class="form-group"> 
<strong>User_id:</strong> 
{{ $useri->user_id }} 
</div> 
</div> 
<div class="col-xs-12 col-sm-12 col-md-12"> 
<div class="form-group"> 
<strong>Level_id:</strong> 
{{ $useri->level_id }} 
</div> 
</div> 

<div class="col-xs-12 col-sm-12 col-md-12"> 
<div class="form-group"> 
<strong>Username:</strong> 
{{ $useri->username }} 
</div> 
</div> 
 
<div class="col-xs-12 col-sm-12 col-md-12"> 
    <div class="form-group"> 
    <strong>Nama:</strong> 
    {{ $useri->nama }} 
    </div> 
    </div> 
 
<div class="col-xs-12 col-sm-12 col-md-12"> 
<div class="form-group"> 
<strong>Password:</strong> 
{{ $useri->password }} 
</div> 
</div> 
 
</div> 
@endsection 