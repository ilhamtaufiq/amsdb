<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\SuratTugas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('surat_tugas.docx'));

        $data = SuratTugas::where('id', $request->id)->get();

        $d = []; // memerintahkan kepada
        $e = []; // tujuan surat
        $f = null;
        $ttd = null;
        $tgl = null;


        foreach ($data as $key => $value) {
            // code...
            $d = $value->kepada;
            $e = $value->tujuan;
            $f = $value->dasar;
            $ttd = $value->ttd;
            $tgl = $value->tgl;
        }
        $template->setValue('dasar', $f);
        $template->setValue('tgl', strtoupper(\Carbon\Carbon::parse($tgl)->isoFormat('D MMMM Y')));

        if ($ttd == "kabid") {
            # code...
            $template->setValue('ttd', "Kepala Bidang Air Minum dan Sanitasi");
            $template->setValue('ttd_nama', "ASEP HENDRIANA, ST, M.Si");
            $template->setValue('ttd_nip', "19810127 200604 1 015");

        } else {
            # code...
            $template->setValue('ttd', "KEPALA DINAS");
            $template->setValue('ttd_nama', "CEPI RAHMAT FADIANA, ST, MT ");
            $template->setValue('ttd_nip', "19700218 1998031 006");


        }


        // Block cloning: Memerintahkan Kepada
        $kepada = [];
        $i = 1;
        foreach ($d as $group_name => $group) {
            $kepada[] = [
                'no' => '${no_'.$i.'}',
                'nama' => '${nama_'.$i.'}',
                'nip' => '${nip_'.$i.'}',
                'pangkat' => '${pangkat_'.$i.'}',
                'jabatan' => '${jabatan_'.$i.'}',

            ];

            $i++;
        }
        $template->cloneBlock('block_group', count($kepada), true, false, $kepada);

        // Table row cloning: Memerintahkan kepada
        $i = 1;
        foreach ($d as $kepada) {
            $values = [];
            $values[] = [
                "no_{$i}" => "{$i}",
                "nama_{$i}" => $kepada['nama'],
                "nip_{$i}" => $kepada['nip'],
                "pangkat_{$i}" => $kepada['pangkat'],
                "jabatan_{$i}" => $kepada['jabatan'],

            ];
            $template->cloneRowAndSetValues("nama_{$i}", $values);
            $template->cloneRowAndSetValues("nip_{$i}", $values);
            $template->cloneRowAndSetValues("pangkat_{$i}", $values);
            $template->cloneRowAndSetValues("jabatan_{$i}", $values);
            // $template->cloneRowAndSetValues("no_{$i}", $values);


            $i++;
        }

        // Block cloning: Tujuan Surat
        $untuk = [];
        $j = 1;
        foreach ($e as $gn => $g) {
            $untuk[] = [
                'untuk' => '${untuk#'.$j.'}',
            ];

            $j++;
        }
        $template->cloneBlock('bg', count($untuk), true, false, $untuk);

        // Table row cloning: Tujuan Surat Tugas/Keperluan
        $j = 1;
        foreach ($e as $u) {
            $template->setValue('untuk#'.$j++, $u['untuk']);
        }

        $filename = 'Surat Tugas.docx';

        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$filename");
        $template->saveAs('php://output');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai = Pegawai::get();

        return view('halaman.surat_tugas.create', [
            'title' => 'Buat Surat Tugas',
            'pegawai' => $pegawai,
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
        $tandaterima = SuratTugas::updateOrCreate(
            [
                'id' => $id,
            ],

            $request->all()

        );

        return redirect()->route('tugas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratTugas  $suratTugas
     * @return \Illuminate\Http\Response
     */
    public function show(SuratTugas $suratTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratTugas  $suratTugas
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratTugas $suratTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratTugas  $suratTugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratTugas $suratTugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratTugas  $suratTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratTugas $suratTugas)
    {
        //
    }
}