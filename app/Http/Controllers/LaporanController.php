<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Laporan;
use App\Models\Pekerjaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');
        $tw = $request->triwulan ?? 1;

        return view('halaman.laporan.index', [
            'title' => 'Laporan Kegiatan',
            'kegiatan' => Kegiatan::where('tahun_anggaran', $ta)->pluck('id', 'sub_kegiatan'),
            // 'triwulan' => $tw,
            // 'pekerjaan' => Pekerjaan::with('kegiatan', 'realisasi_output')
            // ->whereHas('kegiatan', function ($q) use ($ta) {
            //     $q->where('tahun_anggaran', $ta)->where('id', 6);
            // })->whereHas('realisasi_output', function ($t) use ($tw) {
            //     $t->where('triwulan', $tw);
            // })->latest()->get(),
        ]);
    }

    public function pdf(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');
        $tw = $request->triwulan ?? null;
        $font = $request->font ?? 12;
        $tanggal = $request->tanggal ?? Carbon::now();

        // $keg_id = $request->input('keg_id') ?? null;
        $keg_id = [
            $request->keg_id,
        ];

        $kegiatan = Kegiatan::where('id', $keg_id)->select('bidang', 'sumber_dana')->get();

        $data = Pekerjaan::with('kegiatan', 'realisasi_output')
        ->whereHas('kegiatan', function ($q) use ($ta, $keg_id) {
            foreach ($keg_id as $key => $value) {
                $q->where('tahun_anggaran', $ta)->whereIn('id', $value);
            }
        })->with('realisasi_output', function ($t) use ($tw) {
            $t->where('triwulan', $tw);
        })->get();
        $pdf = Pdf::loadView('halaman.laporan.pdf', [
            'pekerjaan' => $data,
            'triwulan' => $tw,
            'kegiatan' => $kegiatan,
            'font' => $font,
            'tanggal' => $tanggal,

        ]);
        $pdf->setPaper('A4', 'landscape');
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);

        return $pdf->stream();
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
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
