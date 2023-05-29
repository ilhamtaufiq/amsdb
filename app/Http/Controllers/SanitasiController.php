<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pekerjaan;
use App\Models\Spek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SanitasiController extends Controller
{
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');
        $pekerjaan = Pekerjaan::with('kegiatan', 'spek')->whereHas('kegiatan', function ($q) use ($ta) {
            $q->where('tahun_anggaran', $ta)->where('bidang', 'Sanitasi');
        })->get();

        $mck = Spek::where('komponen', 'MCK')->sum('volume');
        $ipal = Spek::where('komponen', 'IPAL')->sum('volume');
        $ts_i = Spek::where('komponen', 'Tangki Septik Individual')->sum('volume');
        $ts_k = Spek::where('komponen', 'Tangki Septik Komunal')->sum('volume');
        $sr = Spek::where('komponen', 'Sambungan Rumah')->sum('volume');

        return view('halaman.sanitasi.index', [
            'pekerjaan' => $pekerjaan,
            'totalMCK' => $mck,
            'totalIpal' => $ipal,
            'totalTSindividual' => $ts_i,
            'totalTSkomunal' => $ts_k,
            'totalSR' => $sr,

            'kegiatan' => Kegiatan::has('pekerjaan')->where('tahun_anggaran', $ta)->where('bidang', 'Sanitasi')->get(),
            'title' => 'Dashboard Sanitasi',
        ]);
    }
}