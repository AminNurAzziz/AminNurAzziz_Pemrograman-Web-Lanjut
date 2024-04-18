@extends('adminlte::page')

@section('title', 'Edit Detail Penjualan')

@section('content_header')
    <h1>Edit Detail Penjualan</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Detail Penjualan') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('penjualan_detail.update', $penjualanDetail->detail_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="barang_id" class="col-md-4 col-form-label text-md-right">{{ __('Produk') }}</label>

                            <div class="col-md-6">
                                <select id="barang_id" class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" required autofocus>
                                    <option value="">Pilih Produk</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{ $barang->barang_id }}" data-harga="{{ $barang->harga_jual }}" {{ $barang->barang_id == $penjualanDetail->barang_id ? 'selected' : '' }}>{{ $barang->barang_nama }}</option>
                                    @endforeach
                                </select>

                                @error('barang_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label text-md-right">{{ __('Harga') }}</label>

                            <div class="col-md-6">
                                <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $penjualanDetail->harga }}" required readonly>

                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah" type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ $penjualanDetail->jumlah }}" required autocomplete="jumlah" autofocus>

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Mengambil elemen select barang
    var selectBarang = document.getElementById('barang_id');

    // Menambahkan event listener untuk perubahan pada select barang
    selectBarang.addEventListener('change', function() {
        // Mengambil harga dari atribut data-harga yang disimpan di setiap option
        var selectedOption = this.options[this.selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');

        // Menyimpan harga ke input harga
        document.getElementById('harga').value = harga;
    });
</script>
@endsection
