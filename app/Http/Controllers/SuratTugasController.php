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

        $d = [];

        foreach ($data as $key => $value) {
            // code...
            $d = $value->kepada;
        }

        // Block cloning
        // Block cloning
        $replacements = [];
        $i = 1;
        foreach ($d as $group_name => $group) {
            $replacements[] = [
                'nama' => '${nama_'.$i.'}',
                'nip' => '${nip_'.$i.'}',
                'jabatan' => '${jabatan_'.$i.'}',

            ];

            $i++;
        }
        $template->cloneBlock('block_group', count($replacements), true, false, $replacements);

        // Table row cloning

        $i = 1;
        foreach ($d as $group) {
            $values = [];
            $values[] = [
                "nama_{$i}" => $group['nama'],
                "nip_{$i}" => $group['nip'],
                "jabatan_{$i}" => $group['jabatan'],

            ];
            $template->cloneRowAndSetValues("nama_{$i}", $values);
            $template->cloneRowAndSetValues("nip_{$i}", $values);
            $template->cloneRowAndSetValues("jabatan_{$i}", $values);

            $i++;

            $template->cloneBlock('block_group', 0);
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
