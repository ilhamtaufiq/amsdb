<?php

namespace App\Http\Controllers;

use App\Models\Relokasi;
use Illuminate\Http\Request;

class RelokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.relokasi.index', [
            'title' => 'Relokasi Rumah',
            'relokasi' => Relokasi::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.relokasi.create', [
            'title' => 'Tambah Data Relokasi Rumah',
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
        $request->validate([
            'nama' => ['required'],
            'nik' => ['required'],
            'alamat' => ['required'],
            'desa' => ['required'],
            'kecamatan' => ['required'],
            'desa' => ['required'],

        ]);

        Relokasi::create(
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'keterangan' => $request->keterangan,
            ]);

        return redirect('/app/relokasi/')->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relokasi  $relokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Relokasi $relokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relokasi  $relokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Relokasi $relokasi)
    {
        return view('halaman.relokasi.edit', [
            'title' => 'Edit Relokasi',
            'relokasi' => $relokasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relokasi  $relokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relokasi $relokasi)
    {
        $attributes = $request->validate([
            'nama' => ['required'],
            'nik' => ['required'],
            'alamat' => ['required'],
            'desa' => ['required'],
            'kecamatan' => ['required'],
            'desa' => ['required'],

        ]);

        $relokasi->update($attributes);

        return redirect('/app/relokasi/')->with('status', 'Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relokasi  $relokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relokasi $relokasi)
    {
        $relokasi->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}
