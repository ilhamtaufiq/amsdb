<?php

namespace App\Http\Controllers;

use App\Models\TandaTerima;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TandaTerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.tanda_terima.index', [
            'title' => 'Surat Tanda Terima',
            'data' => TandaTerima::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.tanda_terima.create', [
            'title' => 'Buat Surat Tanda Terima',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $tandaterima = TandaTerima::updateOrCreate(
            [
                'id' => $id,
            ],

            $request->all()

        );

        return redirect()->route('tandaterima.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $data = TandaTerima::where('id', $request->id)->first();
        $pdf = Pdf::loadView('halaman.tanda_terima.pdf', ['data' => $data]);
        $pdf->setPaper('A4', 'portrait');
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);

        return $pdf->stream();

        // return view('halaman.tanda_terima.show',[
        //     'data' => TandaTerima::where('id', $request->id)->first()
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function edit(TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TandaTerima  $tandaTerima
     * @return \Illuminate\Http\Response
     */
    public function destroy(TandaTerima $tandaterima)
    {
        $tandaterima->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}
