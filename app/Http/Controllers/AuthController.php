<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255|unique:m_user,username',
            'nama' => 'required|max:255',
            'password' => 'required|min:6',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle File Upload
        if ($request->hasFile('picture')) {
            // Store the file and save the path in the $validatedData array under the appropriate key
            // Ensure the key 'profile_picture' matches the column name in your database
            $validatedData['profile_picture'] = $request->file('picture')->store('profiles', 'public');
        } else {
            $validatedData['profile_picture'] = null; // Default or placeholder image path
        }

        UserModel::create($validatedData);

        return redirect('/login')->with('success', 'Your account has been successfully created. Please log in.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
