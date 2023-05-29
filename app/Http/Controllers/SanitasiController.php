<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SanitasiController extends Controller
{
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        return view('halaman.sanitasi.index', [
            'pekerjaan' => Pekerjaan::with('kegiatan', 'spek')->whereHas('kegiatan', function ($q) use ($ta) {
                $q->where('tahun_anggaran', $ta)->where('bidang', 'Sanitasi');
            })->get(),
            'kegiatan' => Kegiatan::has('pekerjaan')->where('tahun_anggaran', $ta)->where('bidang', 'Sanitasi')->get(),
            'title' => 'Dashboard Sanitasi',
        ]);
    }
}
