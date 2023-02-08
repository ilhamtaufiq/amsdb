<?php

namespace App\Http\Controllers;

use App\Models\Output;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaan = Pekerjaan::with('realisasi_output')->get();

        return view('halaman.output.index', [
            'title' => 'Realisasi Output',
            'output' => Output::has('pekerjaan')->get(),
            'pekerjaan' => $pekerjaan,
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
        ],[
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