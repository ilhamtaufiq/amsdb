<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        return view('halaman.kegiatan.index', [
            'title' => 'Data Kegiatan',
            'kegiatan' => Kegiatan::where('tahun_anggaran', $ta)->paginate(3),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.kegiatan.create', [
            'title' => 'Tambah Data Kegiatan',
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
            'program' => ['required'],
            'kegiatan' => ['required'],
            'sub_kegiatan' => ['required'],
            'tahun_anggaran' => ['required'],
            'sumber_dana' => ['required'],
        ]);

        Kegiatan::create([
            'program' => $request->program,
            'kegiatan' => $request->kegiatan,
            'sub_kegiatan' => $request->sub_kegiatan,
            'tahun_anggaran' => $request->tahun_anggaran,
            'sumber_dana' => $request->sumber_dana,
        ]);

        return redirect('/app/kegiatan/')->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        abort_if(! $kegiatan, 404);

        return view('halaman.kegiatan.show', [
            'title' => 'Detail Kegiatan',
            'kegiatan' => $kegiatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('halaman.kegiatan.edit', [
            'title' => 'Edit Detail Kegiatan',
            'kegiatan' => $kegiatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $attributes = $request->validate([
            'program' => ['required'],
            'kegiatan' => ['required'],
            'sub_kegiatan' => ['required'],
            'tahun_anggaran' => ['required'],
            'sumber_dana' => ['required'],
        ]);
        $kegiatan->update($attributes);

        return redirect('/app/kegiatan/')->with('status', 'Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }

    public function data()
    {
        $data = Kegiatan::get();

        return response()->json($data, 200);
    }
}
