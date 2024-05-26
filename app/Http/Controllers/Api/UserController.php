<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = UserModel::with('level')->get();
        return response()->json($users, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return response()->json($user, 201);
    }

    public function show(string $id): JsonResponse
    {
        $user = UserModel::with('level')->findOrFail($id);
        return response()->json($user, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'level_id' => $request->level_id
        ]);

        return response()->json($user, 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $user = UserModel::findOrFail($id);

        try {
            $user->delete();
            return response()->json(['message' => 'Data user berhasil dihapus!'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'], 409);
        }
    }
}
