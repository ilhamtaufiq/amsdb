<?php

namespace App\Http\Controllers;

use App\Models\Nphd;
use Illuminate\Http\Request;

class NphdController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nphd  $nphd
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

        $filename = 'nphd - '.$nama_pekerjaan.'.docx';

        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$filename");
        $template->saveAs('php://output');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nphd  $nphd
     * @return \Illuminate\Http\Response
     */
    public function edit(Nphd $nphd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nphd  $nphd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nphd $nphd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nphd  $nphd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nphd $nphd)
    {
        //
    }
}
