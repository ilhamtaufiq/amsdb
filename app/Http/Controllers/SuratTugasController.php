<?php

namespace App\Http\Controllers;

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
        // $data = SuratTugas::where('id', $request->id)->first();

        // $pdf = PDF::loadView('halaman.surat_tugas.print', ['data' => $data]);
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->set_option('isRemoteEnabled', true);

        // // return $data;
        // return $pdf->stream();

        // $news7 = $this->phpword_model->get_employes();
        // $templateProcessor->cloneRow('id', count($news7));

        // $i=1;
        // foreach($news7 as $key=>$values) {
        //     $templateProcessor->setValue('id#'.$i++, $values['id']);
        // }

        //             $i2=1;
        // foreach($news7 as $key=>$values) {
        //     $templateProcessor->setValue('name#'.$i2++, $values['name']);
        // }

        //     $templateProcessor->saveAs($filename);

        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('surat_tugas.docx'));

        $data = SuratTugas::where('id', $request->id)->get();

        // code...
        // $d = [
        //     'Group 1' => [
        //         [
        //             'nama' => 'John Smith',
        //             'nip' => '123 Main Rd.',
        //         ],
        //         [
        //             'nama' => 'Jane Doe',
        //             'nip' => '456 Second St.',
        //         ],
        //     ],
        //     'Group 2' => [
        //         [
        //             'nama' => 'Noah Ford',
        //             'nip' => '987 Rich Blvd.',
        //         ],
        //         [
        //             'nama' => 'Oliver Brown',
        //             'nip' => '654 Third St.',
        //         ],
        //     ],
        // ];

        $d = []; // memerintahkan kepada
        $e = []; // tujuan surat
        $f = null;

        foreach ($data as $key => $value) {
            // code...
            $d = $value->kepada;
            $e = $value->tujuan;
            $f = $value->dasar;
        }
        $template->setValue('dasar', $f);

        // Block cloning: Memerintahkan Kepada
        $kepada = [];
        $i = 1;
        foreach ($d as $group_name => $group) {
            $kepada[] = [
                'nama' => '${nama_'.$i.'}',
                'nip' => '${nip_'.$i.'}',
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
                "nama_{$i}" => $kepada['nama'],
                "nip_{$i}" => $kepada['nip'],
                "jabatan_{$i}" => $kepada['jabatan'],

            ];
            $template->cloneRowAndSetValues("nama_{$i}", $values);
            $template->cloneRowAndSetValues("nip_{$i}", $values);
            $template->cloneRowAndSetValues("jabatan_{$i}", $values);

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
        return view('halaman.surat_tugas.create', [
            'title' => 'Buat Surat Tugas',
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
