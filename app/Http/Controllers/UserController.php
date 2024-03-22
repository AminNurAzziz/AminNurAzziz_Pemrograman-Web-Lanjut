<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //tambah data user dengan Eloquent Model
        /* $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345'),
        ];
        UserModel::create($data); */ //tambahkan data ke tabel <m_user></m_user>


        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];

        //akses model UserModel
        // $user = UserModel::find(1);
        // $user = UserModel::where('level_id', 1)->first();
        // $user = UserModel::firstWhere('level_id', 1);
        // $user = UserModel::findOr(1, ['username', 'nama'], function(){
        //     abort(404);
        // });
        // $user = UserModel::findOr(20, ['username', 'nama'], function(){
        //     abort(404);
        // });

        // $user = UserModel::findOrFail(1);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager'
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();
        // return view('user', ['data' => $user]);

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user->username = 'manager56';

        // $user->isDirty(); //cek apakah ada perubahan data
        // $user->isDirty('username'); //cek apakah ada perubahan data pada kolom username (true)
        // $user->isDirty('nama'); //cek apakah ada perubahan data pada kolom nama (false)
        // $user->isDirty(['nama', 'username']); //cek apakah ada perubahan data pada kolom nama dan username (true)

        // $user->isClean(); //cek apakah tidak ada perubahan data (false)
        // $user->isClean('username'); //cek apakah tidak ada perubahan data pada kolom username (false)
        // $user->isClean('nama'); //cek apakah tidak ada perubahan data pada kolom nama (true)
        // $user->isClean(['nama', 'username']); //cek apakah tidak ada perubahan data pada kolom nama dan username (false)

        // $user->isDirty(); //cek apakah ada perubahan data (false)
        // $user->isClean(); //cek apakah tidak ada perubahan data (true)
        // dd($user->isDirty());

        /*
        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager 11',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ]);

        $user->username = 'manager12';

        $user->save();

        $user->wasChanged(); //cek apakah ada perubahan data (true) 
        $user->wasChanged('username'); //cek apakah ada perubahan data pada kolom username (true)
        $user->wasChanged('nama'); //cek apakah ada perubahan data pada kolom nama (false)
        dd($user->wasChanged(['nama', 'username'])); //true */

        $user = UserModel::all();
        return view('user', ['data' => $user]);

        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);
        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
}
