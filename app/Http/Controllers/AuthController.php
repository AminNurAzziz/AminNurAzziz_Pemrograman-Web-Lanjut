<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->level_id == 1) {
                return redirect('/admin');
            } else if ($user->level_id == 2) {
                return redirect('/manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->level_id == 1) {
                return redirect('/admin');
            } else if ($user->level_id == 2) {
                return redirect('/manager');
            }
            return redirect()->intended('/login');
        }

        return redirect('/login')->withInput()->withErrors([
            'login_gagal' => 'Username atau password salah.',
        ]);
    }

    public function register()
    {
        $level_id = LevelModel::all();
        return view('register', ['level_id' => $level_id]);
    }

    public function proses_register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level_id' => 'required',
        ]);

        $user = new UserModel();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;
        $user->save();

        return redirect('/login');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
