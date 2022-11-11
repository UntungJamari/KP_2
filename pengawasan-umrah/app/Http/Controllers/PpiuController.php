<?php

namespace App\Http\Controllers;

use App\Models\Kab_kota;
use App\Models\Kemenag_kab_kota;
use App\Models\Ppiu;
use App\Models\User;
use Illuminate\Http\Request;

class PpiuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ppiu.index', [
            'title' => 'PPIU',
            'ppius' => Ppiu::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ppiu.create', [
            'title' => 'PPIU',
            'subtitle' => 'Tambah PPIU',
            'kab_kotas' => Kab_kota::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->level === 'kab/kota') {
            $kemenag_kab_kotas = Kemenag_kab_kota::all();
            $kemenag_kab_kota = $kemenag_kab_kotas->where('id_user', auth()->user()->id)->first();
            $request->merge([
                'id_kab_kota' => $kemenag_kab_kota->id_kab_kota,
            ]);
        }

        $request->merge([
            'id_user' => '1',
            'password' => bcrypt('11111111'),
            'level' => 'ppiu'
        ]);

        $valid1 = $request->validate([
            'username' => 'required|min:7|max:255|unique:users',
            'password' => 'required',
            'level' => 'required',
        ]);

        User::create($valid1);

        $users = User::all();
        $user = $users->where('username', $valid1['username'])->first();
        $request->merge([
            'id_user' => $user->id,
        ]);

        $valid2 = $request->validate([
            'nama' => 'required|min:7|max:255',
            'id_user' => 'required',
            'id_kab_kota' => 'required',
            'status' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required',
            'nama_pimpinan' => '',
            'alamat' => 'required',
            // 'logo' => 'default.png',
            'logo' => 'image|file|max:1024',
        ]);

        if ($request->file('logo')) {
            $valid2['logo'] = $request->file('logo')->store('image-profile');
        }

        Ppiu::create($valid2);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function show(Ppiu $ppiu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function edit(Ppiu $ppiu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ppiu $ppiu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ppiu $ppiu)
    {
        //
    }
}
