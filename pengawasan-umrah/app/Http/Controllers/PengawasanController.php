<?php

namespace App\Http\Controllers;

use App\Models\Pengawasan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengawasan.index', [
            'title' => 'Pengawasan',
            'pengawasans' => Pengawasan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengawasan.create', [
            'title' => 'Pengawasan',
            'subtitle' => 'Blanko Pengawasan Umrah',
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
        $valid = $request->validate([
            'izin' => 'required',
            'jumlah_jemaah_laki_laki' => 'required|numeric|min:0',
            'jumlah_jemaah_wanita' => 'required|numeric|min:0',
            'tanggal_keberangkatan' => 'required|date|before:tanggal_kepulangan',
            'tanggal_kepulangan' => 'required|date|after:tanggal_keberangkatan',
            'temuan_lapangan' => 'required',
            'petugas_1' => 'required',
            'petugas_2' => 'required',
        ]);

        $currentTime = Carbon::now();
        $haris = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');
        $day = $currentTime->format('l');
        $hari = $haris[$day];
        $valid['hari'] = $hari;
        $tanggal = $currentTime->format('Y-m-d');
        $valid['tanggal'] = $tanggal;
        $jam = $currentTime->format('H:i:s');
        $valid['jam'] = $jam;

        $valid['id_ppiu'] = auth()->user()->ppiu->id;

        Pengawasan::create($valid);

        return redirect('/pengawasan/create')->with('berhasil', 'Berhasil Menambahkan Data Pengawasan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengawasan $pengawasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengawasan $pengawasan)
    {
        return view('pengawasan.edit', [
            'title' => 'Pengawasan',
            'subtitle' => 'Edit Isian Blanko Pengawasan',
            'pengawasan' => $pengawasan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengawasan $pengawasan)
    {
        $valid = $request->validate([
            'izin' => 'required',
            'jumlah_jemaah_laki_laki' => 'required|numeric|min:0',
            'jumlah_jemaah_wanita' => 'required|numeric|min:0',
            'tanggal_keberangkatan' => 'required|date|before:tanggal_kepulangan',
            'tanggal_kepulangan' => 'required|date|after:tanggal_keberangkatan',
            'temuan_lapangan' => 'required',
            'petugas_1' => 'required',
            'petugas_2' => 'required',
        ]);

        Pengawasan::where('id', $pengawasan->id)
            ->update($valid);

        return redirect('/pengawasan/edit/' . $pengawasan->id)->with('berhasil', 'Berhasil Mengubah Data Pengawasan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengawasan $pengawasan)
    {
        Pengawasan::destroy($pengawasan->id);
        return redirect('/pengawasan')->with('berhasil', 'Berhasil Menghapus Data Pengawasan!');
    }
}
