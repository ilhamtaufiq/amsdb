<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\Pekerjaan;
use App\Models\Pelaksana;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    public $pekerjaan;

    public $pelaksana;

    public function __construct()
    {
        $this->pekerjaan = Pekerjaan::doesntHave('kontrak')->select('id', 'nama_pekerjaan')->get();
        $this->pelaksana = Pelaksana::select('id', 'nama')->get();
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
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        return view('halaman.kontrak.index', [
            'title' => 'Data Kontrak',
            'kontrak' => Kontrak::with('pekerjaan.kegiatan', 'pelaksana')
                ->whereHas('pekerjaan.kegiatan', function ($q) use ($ta) {
                    $q->where('tahun_anggaran', $ta);
                })
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.kontrak.create', [
            'title' => 'Tambah Data Kontrak',
            'pekerjaan' => $this->pekerjaan,
            'pelaksana' => $this->pelaksana,
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
            'kode_rup' => ['required'],
            'kode_paket' => ['required'],
            'pekerjaan_id' => ['required'],
            'pelaksana_id' => ['required'],
            'nilai_kontrak' => ['required'],
            'tgl_mulai' => ['required'],
            'tgl_selesai' => ['required'],
            'no_spk' => ['required'],
            'tgl_spk' => ['required'],
            'no_sppbj' => ['required'],
            'tgl_sppbj' => ['required'],
            'no_spmk' => ['required'],
            'tgl_spmk' => ['required'],
        ]);

        Kontrak::create([
            'kode_rup' => $request->kode_rup,
            'kode_paket' => $request->kode_paket,
            'pekerjaan_id' => $request->pekerjaan_id,
            'pelaksana_id' => $request->pelaksana_id,
            'nilai_kontrak' => $request->nilai_kontrak,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'no_sppbj' => $request->no_sppbj,
            'tgl_sppbj' => $request->tgl_sppbj,
            'no_spk' => $request->no_spk,
            'tgl_spk' => $request->tgl_spk,
            'no_spmk' => $request->no_spmk,
            'tgl_spmk' => $request->tgl_spmk,
        ]);

        return redirect(route('kontrak.index'))->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrak $kontrak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrak $kontrak)
    {
        return view('halaman.kontrak.edit', [
            'title' => 'Ubah Data Kontrak',
            'kontrak' => $kontrak,
            'pekerjaan' => $this->pekerjaan,
            'pelaksana' => $this->pelaksana,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontrak $kontrak)
    {
        $attributes = $request->validate([
            'kode_rup' => ['required'],
            'kode_paket' => ['required'],
            'pekerjaan_id' => ['required'],
            'pelaksana_id' => ['required'],
            'nilai_kontrak' => ['required'],
            'tgl_mulai' => ['required'],
            'tgl_selesai' => ['required'],
            'no_spk' => ['required'],
            'tgl_spk' => ['required'],
            'no_sppbj' => ['required'],
            'tgl_sppbj' => ['required'],
            'no_spmk' => ['required'],
            'tgl_spmk' => ['required'],
        ]);

        $kontrak->update($attributes);

        return redirect(route('kontrak.index'))->with('status', 'Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrak $kontrak)
    {
        $kontrak->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}
