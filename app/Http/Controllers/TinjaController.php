<?php

namespace App\Http\Controllers;

use App\Models\Tinja;
use Illuminate\Http\Request;

class TinjaController extends Controller
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
    public function index()
    {
        return view('halaman.tinja.index', [
            'title' => 'Kwitansi Tinja',
            'tinja' => Tinja::get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman.tinja.create', [
            'title' => 'Tambah Kwitansi',
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
        $request->validate([
            'nomor' => ['required'],
            'nama' => ['required'],
            'nominal' => ['required'],
            'jumlah' => ['required'],
            'pembayaran' => ['required'],
        ]);

        Tinja::create([
            'nomor' => $request->nomor,
            'nama' => $request->nama,
            'nominal' => $request->nominal,
            'jumlah' => $request->jumlah,
            'pembayaran' => $request->pembayaran,
        ]);

        return redirect(route('tinja.index'))->with('status', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tinja  $tinja
     * @return \Illuminate\Http\Response
     */
    public function show(Tinja $tinja)
    {
        function penyebut($nilai)
        {
            $nilai = abs($nilai);
            $huruf = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
            $temp = '';
            if ($nilai < 12) {
                $temp = ' '.$huruf[$nilai];
            } elseif ($nilai < 20) {
                $temp = penyebut($nilai - 10).' belas';
            } elseif ($nilai < 100) {
                $temp = penyebut($nilai / 10).' puluh'.penyebut($nilai % 10);
            } elseif ($nilai < 200) {
                $temp = ' seratus'.penyebut($nilai - 100);
            } elseif ($nilai < 1000) {
                $temp = penyebut($nilai / 100).' ratus'.penyebut($nilai % 100);
            } elseif ($nilai < 2000) {
                $temp = ' seribu'.penyebut($nilai - 1000);
            } elseif ($nilai < 1000000) {
                $temp = penyebut($nilai / 1000).' ribu'.penyebut($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                $temp = penyebut($nilai / 1000000).' juta'.penyebut($nilai % 1000000);
            } elseif ($nilai < 1000000000000) {
                $temp = penyebut($nilai / 1000000000).' milyar'.penyebut(fmod($nilai, 1000000000));
            } elseif ($nilai < 1000000000000000) {
                $temp = penyebut($nilai / 1000000000000).' trilyun'.penyebut(fmod($nilai, 1000000000000));
            }

            return $temp;
        }

        function terbilang($nilai)
        {
            if ($nilai < 0) {
                $hasil = 'minus '.trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }

            return $hasil;
        }

        $nomor = $tinja->nomor;
        $nama = $tinja->nama;
        $nominal = $tinja->nominal;
        $jumlah = $tinja->jumlah;
        $pembayaran = $tinja->pembayaran;
        $total = $nominal * $jumlah;
        $terbilang = terbilang($total);

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('kwitansi.docx'));

        $template->setValue('nomor', strtoupper($nomor));
        $template->setValue('nama', strtoupper($nama));
        $template->setValue('total', number_format($total, 0, ',', '.'));
        $template->setValue('nominal', number_format($nominal, 0, ',', '.'));
        $template->setValue('jumlah', $jumlah);
        $template->setValue('pembayaran', $pembayaran);
        $template->setValue('terbilang', strtoupper($terbilang));

        $filename = 'kwitansi - '.$nama.'.docx';

        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$filename");
        $template->saveAs('php://output');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tinja  $tinja
     * @return \Illuminate\Http\Response
     */
    public function edit(Tinja $tinja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tinja  $tinja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tinja $tinja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tinja  $tinja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tinja $tinja)
    {
        $tinja->delete();

        return back()->with('status', 'Data berhasil dihapus');
    }
}