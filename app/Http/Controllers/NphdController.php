<?php

namespace App\Http\Controllers;

use App\Models\Nphd;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class NphdController extends Controller
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
        return view('halaman.nphd.index', [
            'title' => 'Daftar NPHD',
            'nphd' => Nphd::with('pekerjaan')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.nphd.create',
            [
                'title' => 'Tambah NPHD',
                'pekerjaan' => Pekerjaan::has('kontrak')->select('id', 'nama_pekerjaan')->get(),
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
            'pekerjaan_id' => ['required'],
            'no_nphd' => ['required'],
            'tgl_nphd' => ['required'],
            'no_ba' => ['required'],
            'tgl_ba' => ['required'],
            'pengelola' => ['required'],
            'ketua' => ['required'],
            'bangunan' => ['required'],
        ]);

        Nphd::create([
            'pekerjaan_id' => $request->pekerjaan_id,
            'no_nphd' => $request->no_nphd,
            'tgl_nphd' => $request->tgl_nphd,
            'no_ba' => $request->no_ba,
            'tgl_ba' => $request->tgl_ba,
            'pengelola' => $request->pengelola,
            'ketua' => $request->ketua,
            'bangunan' => $request->bangunan,
        ]);

        return redirect(route('nphd.index'))->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Nphd $nphd)
    {
        $nama_pekerjaan = $nphd->pekerjaan->nama_pekerjaan;
        $nama_ketua = $nphd->ketua;
        $nama_pengelola = $nphd->pengelola;
        $sub_kegiatan = $nphd->pekerjaan->kegiatan->sub_kegiatan;
        $desa = 'Desa '.$nphd->pekerjaan->desa->n_desa.' '.'Kecamatan '.$nphd->pekerjaan->kec->n_kec;
        $nama_bangunan = $nphd->bangunan;
        $nilai_kontrak = $nphd->pekerjaan->kontrak->nilai_kontrak;
        $spk = $nphd->pekerjaan->kontrak->no_spk;
        $tgl_spk = $nphd->pekerjaan->kontrak->tgl_spk;

        $pelaksana = $nphd->pekerjaan->kontrak->pelaksana->nama;

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('nphd.docx'));

        $template->setValue('nama_ketua', strtoupper($nama_ketua));
        $template->setValue('nama_pengelola', strtoupper($nama_pengelola));
        $template->setValue('sub_kegiatan', strtoupper($sub_kegiatan));
        $template->setValue('desa', $desa);
        $template->setValue('nama_bangunan', strtoupper($nama_bangunan));
        $template->setValue('nilai_kontrak', number_format($nilai_kontrak, 0, ',', '.'));
        $template->setValue('spk', $spk);
        $template->setValue('tgl_spk', $tgl_spk);
        $template->setValue('pelaksana', $pelaksana);

        $filename = 'nphd_'.$spk.'.docx';

        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$filename");
        $template->saveAs('php://output');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Nphd $nphd)
    {
        return view('halaman.nphd.edit', [
            'title' => 'Edit Detail NPHD',
            'pekerjaan' => Pekerjaan::has('kontrak')->select('id', 'nama_pekerjaan')->get(),
            'nphd' => $nphd,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nphd $nphd)
    {
        $attributes = $request->validate([
            'pekerjaan_id' => ['required'],
            'no_nphd' => ['required'],
            'tgl_nphd' => ['required'],
            'no_ba' => ['required'],
            'tgl_ba' => ['required'],
            'pengelola' => ['required'],
            'ketua' => ['required'],
            'bangunan' => ['required'],
        ]);

        $nphd->update($attributes);

        return redirect(route('nphd.index'))->with('status', 'Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nphd $nphd)
    {
        $nphd->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}
