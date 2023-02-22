<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Output;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OutputController extends Controller
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
    public function index(Request $request)
    {
        $ta = $request->tahun_anggaran ?? Carbon::now()->format('Y');

        return view('halaman.output.index', [
            'title' => 'Realisasi Output',
            'output' => Output::has('pekerjaan')->get(),
            'pekerjaan' => Pekerjaan::with('kegiatan', 'realisasi_output')->whereHas('kegiatan', function ($q) use ($ta) {
                $q->where('tahun_anggaran', $ta);
            })->latest()->get(),
            'kegiatan' => Kegiatan::has('pekerjaan')->where('tahun_anggaran', $ta)->get(),

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
        $request->validate([
            'pekerjaan_id' => ['required'],
            'realisasi' => ['required'],
        ]);

        Output::updateOrCreate(
            [
                'pekerjaan_id' => $request->pekerjaan_id,
            ], [
                'realisasi' => $request->realisasi,
            ]);

        return redirect('/app/output/')->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function show(Output $output)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function edit(Output $output)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Output $output)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function destroy(Output $output)
    {
        $output->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}
