<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pekerjaan;
use App\Models\Spek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AirMinumController extends Controller
{
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');
        $kegiatan = Kegiatan::where('tahun_anggaran', $ta)->where('bidang', 'Air Minum')->pluck('id');
        $keg = [$request->keg_id ?? $kegiatan[0]];

        $pekerjaan = Pekerjaan::with('kegiatan', 'spek')
        ->whereHas('kegiatan', function ($q) use ($ta) {
            $q->where('tahun_anggaran', $ta)->where('bidang', 'Air Minum');
        })->whereHas('kegiatan', function ($q) use ($keg) {
            $q->whereIn('id', $keg);
        })->get();

        $sr = Spek::with('pekerjaan.kegiatan')->whereHas('pekerjaan.kegiatan', function ($q) use ($ta) {
            $q->where('tahun_anggaran', $ta)->where('bidang', 'Air Minum');
        })->where('komponen', 'Sambungan Rumah')->sum('volume');

        return view('halaman.am.index', [
            'pekerjaan' => $pekerjaan,
            'totalSR' => $sr,
            'kegiatan' => Kegiatan::has('pekerjaan')->where('tahun_anggaran', $ta)->where('bidang', 'Air Minum')->get(),
            'title' => 'Dashboard Air Minum',
        ]);
    }
}
