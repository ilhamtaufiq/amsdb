<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Pekerjaan;
use App\Models\Uploadtmp;
use Illuminate\Http\Request;
use Storage;

class FileUploadController extends Controller
{
    public $pekerjaan;

    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|pekerjroleaan-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);

        $this->pekerjaan = Pekerjaan::select('id', 'nama_pekerjaan')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaman.file.create', [
            'title' => 'Upload File',
            'pekerjaan' => $this->pekerjaan,
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
        $tmp_file = Uploadtmp::where('folder', $request->file)->first();
        $request->validate([
            'file' => 'required',
            'pekerjaan_id' => 'required',
            'jenis' => 'required',
        ]);
        $path = 'files/'.$request->pekerjaan_id.'/'.$tmp_file->file;
        if ($tmp_file) {
            // code...
            Storage::copy('files/tmp/'.$tmp_file->folder.'/'.$tmp_file->file, $path);
            FileUpload::create([
                'pekerjaan_id' => $request->pekerjaan_id,
                'nama' => $tmp_file->file,
                'path' => $path,
                'jenis' => $request->jenis,
            ]);
            Storage::deleteDirectory('files/tmp/'.$tmp_file->folder);
            $tmp_file->delete();
        }

        return redirect(route('pekerjaan.index'))->with('status', 'Data telah disimpan');
        // $request->validate([
        //     'file' => 'required|mimes:csv,txt,xlx,xls,pdf,jpg|max:2048',
        //     'pekerjaan_id' => 'required',
        //     'jenis' => 'required'
        // ]);
        // $fileUpload = new FileUpload();
        // if ($request->file()) {
        //     $fileName = time() . '_' . $request->file->getClientOriginalName();
        //     $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
        //     $fileUpload->nama = time() . '_' . $request->file->getClientOriginalName();
        //     $fileUpload->path = '/storage/' . $filePath;
        //     $fileUpload->save();
        //     return back()
        //         ->with('status', 'File has been uploaded.')
        //         ->with('file', $fileName);
        // }
    }

    public function tmpUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            // code...
            $file = $request->file('file');
            $file_name = uniqid().'_'.$file->getClientOriginalName();
            $folder = uniqid('files_', true);
            $file->storeAs('files/tmp/'.$folder, $file_name);
            Uploadtmp::create([
                'file' => $file_name,
                'folder' => $folder,
            ]);
        }

        // return $folder;
    }

    public function tmpDelete()
    {
        Uploadtmp::truncate();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileUpload $fileUpload)
    {
        //
    }
}
