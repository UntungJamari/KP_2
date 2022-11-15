<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function gantipassword()
    {
        return view('profil.gantipassword', [
            'title' => 'Ganti Password',
            'subtitle' => 'fffffff',
        ]);
    }

    public function savegantipassword(Request $request)
    {
        $valid = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|string|min:8',
            'konfirmasi_password_baru' => 'required|same:password_baru',
        ]);

        if (!Hash::check($request->password_lama, auth()->user()->password)) {
            return back()->with('gagal', 'Password Lama Salah!');
        }
        dd('password lama benar');
    }
}
