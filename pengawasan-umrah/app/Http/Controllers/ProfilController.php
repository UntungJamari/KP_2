<?php

namespace App\Http\Controllers;

use App\Models\Kemenag_kab_kota;
use App\Models\Ppiu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{

    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        if (auth()->user()->level == 'kanwil') {
            $nama = 'Kantor Wilayah Kementerian Agama Sumatera Barat';
        } elseif (auth()->user()->level == 'kab/kota') {
            $nama = $user->kemenag_kab_kota->nama;
        } elseif (auth()->user()->level == 'ppiu') {
            $nama = $user->ppiu->nama;
        }

        return view('profil.index', [
            'title' => 'Profil',
            'subtitle' => 'fffffff',
            'user' => $user,
            'nama' => $nama
        ]);
    }

    public function edit()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('profil.edit', [
            'title' => 'Profil',
            'subtitle' => 'fffffff',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {

        if (auth()->user()->level == 'ppiu') {

            $ppiu = Ppiu::where('id_user', auth()->user()->id)->first();

            if ($ppiu->status == 'Pusat') {
                $valid = $request->validate([
                    'nama' => 'required|min:7|max:255',
                    'nama_pimpinan' => '',
                    'nomor_sk' => 'required',
                    'tanggal_sk' => 'required|date',
                    'alamat' => 'required',
                    'logo' => 'image|file|max:1024',
                ]);
            } elseif ($ppiu->status == 'Cabang') {
                $valid = $request->validate([
                    'nama_pimpinan' => '',
                    'nomor_sk' => 'required',
                    'tanggal_sk' => 'required|date',
                    'alamat' => 'required',
                ]);
            }

            if ($request->username != $ppiu->user->username) {
                $valid1 = $request->validate([
                    'username' => 'required|min:7|max:255|unique:users',
                ]);
                User::where('id', $ppiu->user->id)
                    ->update($valid1);
            }

            if ($ppiu->status == 'Pusat') {
                if ($request->file('logo')) {
                    if ($ppiu->logo !== 'image-profile/btuP6rIVQw1r89VG4C5pSPwZyONSORAclojTQU9N.png') {
                        Storage::delete($ppiu->logo);
                    }
                    $valid['logo'] = $request->file('logo')->store('image-profile');

                    Ppiu::where('nama', $ppiu->nama)
                        ->update(['logo' => $valid['logo']]);
                }

                if ($request->nama != $ppiu->nama) {
                    Ppiu::where('nama', $ppiu->nama)
                        ->update(['nama' => $valid['nama']]);
                }
            }

            Ppiu::where('id_user', auth()->user()->id)
                ->update($valid);
        }

        return redirect('/profil')->with('berhasil', 'Berhasil Mengubah Profil!');
    }

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

        // dd($valid['password_baru']);

        User::where('id', auth()->user()->id)
            ->update(['password' => bcrypt($valid['password_baru'])]);

        return redirect('/profil/gantipassword')->with('berhasil', 'Berhasil Mengubah Password!');
    }
}
