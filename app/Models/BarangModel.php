<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriModel as Kategori;

class BarangModel extends Model
{
    protected $table = 'm_barang';

    protected $primaryKey = 'barang_id';

    protected $fillable = [
        'kategori_id',
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
    ];

    // Relationship dengan tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}
