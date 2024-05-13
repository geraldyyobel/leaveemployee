<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginModel;
use App\Models\User;

class LoginController extends Controller
{
    public function view_login()
    {
        return view('sesi.index');
    }
    
    public function postlogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',

            ],
            [
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',

            ]
        );
            if (Auth::attempt($request->only('username', 'password'))) {
                return redirect('/dashboard');
            }
            return redirect('/login')->with('toast_error', 'Username atau Password yang Anda masukkan salah');
        }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_karyawan' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Nama wajib diisi',
            'id_karyawan.required' => 'ID wajib diisi',
            'username.required' => 'username wajib diisi',
            'username.username' => 'Silakan masukkan username yang valid',
            'username.unique' => 'username sudah pernah digunakan, silakan pilih username yang lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimum password yang diizinkan adalah 6 karakter'
        ]);

        $data = [
            'name' => $request->name,
            'id_karyawan' => $request->id_karyawan,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ];
        User::create($data);

        $request = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($request)) {
            return redirect('/dashboard')->with('success', Auth::user()->name . ' Berhasil login');
        } else {
            return redirect('/login')->withErrors('Username dan password yang dimasukkan tidak valid');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function dashboard()
    {
        return view('layout.template');
    }
}
