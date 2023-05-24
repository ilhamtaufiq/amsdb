<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        $this->pekerjaan = Pekerjaan::with('kegiatan')->whereHas('kegiatan', function ($q) use ($ta) {
            $q->where('tahun_anggaran', $ta);
        })->get();

        $this->kegiatan = Kegiatan::has('pekerjaan')->where('tahun_anggaran', $ta)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'pekerjaan' => $this->pekerjaan,
            'kegiatan' => $this->kegiatan,
        ]);
    }

    public function tfl()
    {
        return view('halaman.tfl.dashboard', [
            'title' => 'Dashboard TFL Sanitasi 2023',
            'pekerjaan' => Pekerjaan::with('kegiatan', 'desa', 'kec')->whereHas('kegiatan', function ($q) {
                $q->where('id', 6)->where('tahun_anggaran', 2023);
            })->latest()->get(),

        ]);
    }
}
