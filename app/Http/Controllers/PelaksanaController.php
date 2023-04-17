<?php

namespace App\Http\Controllers;

use App\Models\Pelaksana;
use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|pekerjroleaan-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

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
            'kontak' => $request->kontak,
        ]);

        return redirect('/app/pelaksana/')->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pelaksana $pelaksana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelaksana $pelaksana)
    {
        //
    }
}
