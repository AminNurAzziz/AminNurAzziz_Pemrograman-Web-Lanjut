<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class LevelModel extends Model
{
    protected $table = 'm_level';
    protected $primaryKey = 'level_id';
    protected $fillable = [
        'level_kode',
        'level_nama',
    ];


    public function delete()
    {
        $user = UserModel::where('level_id', $this->level_id)->first();
        if ($user) {
            return response()->json([
                'success' => false,
                'message' => 'Data level masih digunakan di user'
            ], 409);
        }
        Log::info('Data level berhasil dihapus');
        return parent::delete();
    }
}
