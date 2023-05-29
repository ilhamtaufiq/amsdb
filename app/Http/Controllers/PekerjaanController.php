<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kec;
use App\Models\Kegiatan;
use App\Models\Pekerjaan;
use App\Models\Spek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public $kegiatan;

    public function __construct(Request $request)
    {
        $this->middleware('permission:role-list|role-create|pekerjroleaan-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        $this->kegiatan = Kegiatan::select('id', 'sub_kegiatan')->where('tahun_anggaran', $ta)->get();
        $this->kec = Kec::select('id', 'n_kec')->get();
        $this->desa = Desa::select('id', 'n_desa')->get();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        return view('halaman.pekerjaan.index', [
            'title' => 'Data Pekerjaan',
            'pekerjaan' => Pekerjaan::with('kegiatan', 'desa', 'kec')->whereHas('kegiatan', function ($q) use ($ta) {
                $q->where('tahun_anggaran', $ta);
            })->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.pekerjaan.create', [
            'title' => 'Tambah Paket Pekerjaan',
            'kegiatan' => $this->kegiatan,
            'kecamatan' => $this->kec,
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
            'keg_id' => ['required'],
            'kec_id' => ['required'],
            'desa_id' => ['required'],
            'nama_pekerjaan' => ['required'],
            'pagu' => ['required'],
            'pokir' => ['required'],
            'output' => ['required'],
            'satuan_output' => ['required'],

        ]);

        Pekerjaan::create([
            'keg_id' => $request->keg_id,
            'kec_id' => $request->kec_id,
            'desa_id' => $request->desa_id,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'pagu' => $request->pagu,
            'pokir' => $request->pokir,
            'output' => $request->output,
            'satuan_output' => $request->satuan_output,

        ]);

        return redirect(route('pekerjaan.index'))->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        abort_if(! $pekerjaan, 404);

        return view('halaman.pekerjaan.show', [
            'title' => 'Detail Pekerjaan',
            'pekerjaan' => $pekerjaan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        return view('halaman.pekerjaan.edit', [
            'title' => 'Edit Detail Pekerjaan',
            'pekerjaan' => $pekerjaan,
            'kegiatan' => $this->kegiatan,
            'kecamatan' => $this->kec,
            'desa' => $this->desa,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $attributes = $request->validate([
            'keg_id' => ['required'],
            'kec_id' => ['required'],
            'desa_id' => ['required'],
            'nama_pekerjaan' => ['required'],
            'pagu' => ['required'],
            'pokir' => ['required'],
            'output' => ['required'],
            'satuan_output' => ['required'],

        ]);
        $pekerjaan->update($attributes);
        $pekerjaan_id = $request->pekerjaan_id;
        $spesifikasi = $request->spek;

        $data = [];
        foreach ($spesifikasi as $s) {
            Spek::updateOrCreate(
                [
                    'pekerjaan_id' => $pekerjaan->id,
                ],
                [
                    'spek' => $spesifikasi,
                ]
            );

        }
        // return $spek;
        return redirect('/app/pekerjaan/')->with('status', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        $pekerjaan->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}
