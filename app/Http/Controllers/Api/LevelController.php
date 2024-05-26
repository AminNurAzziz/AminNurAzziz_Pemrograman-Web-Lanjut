<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    public function index()
    {
        $data = LevelModel::all();
        $data = [
            'success' => true,
            'message' => 'Data level berhasil diambil',
            'data' => $data
        ];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $level = LevelModel::create($request->all());
        return response()->json($level, 201);
    }

    public function show(LevelModel $level)
    {
        return response()->json($level, 200);
    }

    public function update(Request $request, $level_id)
    {
        $level = LevelModel::find($level_id);
        if ($level) {
            $level->update($request->all());
            return response()->json($level, 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data level tidak ditemukan'
        ], 404);
    }

    public function destroy($level_id)
    {
        $level = LevelModel::find($level_id);
        if ($level) {
            $user = UserModel::where('level_id', $level_id)->first();
            if ($user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data level masih digunakan di user'
                ], 409);
            }
            Log::info('Data level berhasil dihapus');
            $level->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data level berhasil dihapus'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data level tidak ditemukan'
        ], 404);
    }
}
