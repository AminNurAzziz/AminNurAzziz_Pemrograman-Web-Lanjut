@extends('layout.app')

@section('subtitle', 'Penjualan')
@section('content_header_title', 'Penjualan')
@section('content_header_subtitle', 'Create')

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
        <form id="penjualanForm" action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="pembeli">Pembeli:</label>
                <input type="text" class="form-control" id="pembeli" name="pembeli" required>
            </div>
            <div class="form-group">
                <label for="penjualan_tanggal">Tanggal Penjualan:</label>
                <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" required>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="barang_id">Pilih Barang:</label>
                        <select class="form-control" id="barang_id" onchange="updateHarga()">
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->barang_id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->barang_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="text" class="form-control" id="harga" value="" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" class="form-control" id="jumlah">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-primary form-control" onclick="addToList()">Tambah</button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="daftar_produk_body">
                        <!-- Daftar produk yang sudah ditambahkan akan muncul di sini -->
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="barang" name="barang_id">
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

<script>
    var daftarProduk = [];

    function addToList() {
        var selectedBarang = document.getElementById('barang_id');
        var jumlah = document.getElementById('jumlah').value;

        if (selectedBarang.value === '' || jumlah === '') {
            alert('Pilih barang dan masukkan jumlah terlebih dahulu');
            return;
        }

        var barangId = selectedBarang.value;
        var barangNama = selectedBarang.options[selectedBarang.selectedIndex].text;
        var harga = selectedBarang.options[selectedBarang.selectedIndex].getAttribute('data-harga');
        var total = parseFloat(harga) * parseFloat(jumlah);

        var produk = {
            id: barangId,
            nama: barangNama,
            harga: harga,
            jumlah: jumlah,
            total: total
        };

        daftarProduk.push(produk);
        updateDaftarProdukTable();

        // Reset input fields
        selectedBarang.value = '';
        document.getElementById('jumlah').value = '';
    }

    function updateDaftarProdukTable() {
        var daftarProdukBody = document.getElementById('daftar_produk_body');
        daftarProdukBody.innerHTML = '';

        for (var i = 0; i < daftarProduk.length; i++) {
            var produk = daftarProduk[i];
            var row = `<tr>
                            <td>${produk.nama}</td>
                            <td>Rp ${formatNumber(produk.harga)}</td>
                            <td>${produk.jumlah}</td>
                            <td>Rp ${formatNumber(produk.total)}</td>
                            <td><button type="button" class="btn btn-danger" onclick="hapusProduk(${i})">Hapus</button></td>
                        </tr>`;
            daftarProdukBody.innerHTML += row;
        }

        // Update hidden input with JSON data
        document.getElementById('barang').value = JSON.stringify(daftarProduk);
    }

    function hapusProduk(index) {
        daftarProduk.splice(index, 1);
        updateDaftarProdukTable();
    }

    function updateHarga() {
        var selectedBarang = document.getElementById('barang_id');
        var harga = selectedBarang.options[selectedBarang.selectedIndex].getAttribute('data-harga');

        document.getElementById('harga').value = harga;
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>

@stop
