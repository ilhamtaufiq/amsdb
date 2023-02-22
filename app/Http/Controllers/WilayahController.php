<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kec;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('permission:role-list|role-create|pekerjroleaan-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);

        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        $this->kec = Kec::with('pekerjaan', 'desa')->whereHas('pekerjaan.kegiatan', function ($q) use ($ta) {
            $q->where('tahun_anggaran', $ta);
        })->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.wilayah.kecamatan', [
            'title' => 'Data Kecamatan',
            'kecamatan' => $this->kec,
        ]);
    }

    public function desa()
    {
        return view('halaman.wilayah.desa', [
            'title' => 'Data Desa',
            'desa' => Desa::get(),
        ]);
    }
}
