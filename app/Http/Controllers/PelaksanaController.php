<?php

namespace App\Http\Controllers;

use App\Models\Pelaksana;
use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.pelaksana.index', [
            'title' => 'Data Pelaksana',
            'pelaksana' => Pelaksana::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.pelaksana.create', [
            'title' => 'Tambah Data Pelaksana',
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
            'alamat' => ['required'],
            'npwp' => ['required'],
            'direktur' => ['required'],
        ]);

        Pelaksana::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'direktur' => $request->direktur,
            'kontak' => $request->kotak,
        ]);

        return redirect('/app/pelaksana/')->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelaksana  $pelaksana
     * @return \Illuminate\Http\Response
     */
    public function show(Pelaksana $pelaksana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelaksana  $pelaksana
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelaksana $pelaksana)
    {
        return view('halaman.pelaksana.edit', [
            'title' => 'Ubah Data Pelaksana',
            'pelaksana' => $pelaksana,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelaksana  $pelaksana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelaksana $pelaksana)
    {
        $attributes = $request->validate([
            'nama' => ['required'],
            'alamat' => ['required'],
            'npwp' => ['required'],
            'direktur' => ['required'],
        ]);
        $pelaksana->update($attributes);

        return redirect('/app/pelaksana/')->with('status', 'Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelaksana  $pelaksana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelaksana $pelaksana)
    {
        //
    }
}
