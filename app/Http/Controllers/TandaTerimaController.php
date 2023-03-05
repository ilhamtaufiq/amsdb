<?php

namespace App\Http\Controllers;

use App\Models\TandaTerima;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF as TCPDF;
use File;
use Illuminate\Http\Request;
use LSNepomuceno\LaravelA1PdfSign\Sign\ManageCert;
use LSNepomuceno\LaravelA1PdfSign\Sign\SealImage;
use LSNepomuceno\LaravelA1PdfSign\Sign\SignaturePdf;

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

    public function sign()
    {
        return view('halaman.tanda_terima.tandatangan');
    }

    public function signing()
    {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 052');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 052', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once dirname(__FILE__).'/lang/eng.php';
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        /*
        NOTES:
         - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
         - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
         - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
        */

        // set certificate file
        $certificate = 'file://data/cert/tcpdf.crt';

        // set additional information
        $info = [
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'Testing TCPDF',
            'ContactInfo' => 'http://www.tcpdf.org',
        ];

        // set document signature
        $pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);

        // set font
        $pdf->SetFont('helvetica', '', 12);

        // add a page
        $pdf->AddPage();

        // print a line of text
        $text = 'This is a <b color="#FF0000">digitally signed document</b> using the default (example) <b>tcpdf.crt</b> certificate.<br />To validate this signature you have to load the <b color="#006600">tcpdf.fdf</b> on the Arobat Reader to add the certificate to <i>List of Trusted Identities</i>.<br /><br />For more information check the source code of this example and the source code documentation for the <i>setSignature()</i> method.<br /><br /><a href="http://www.tcpdf.org">www.tcpdf.org</a>';
        $pdf->writeHTML($text, true, 0, true, 0);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // *** set signature appearance ***

        // create content for signature (image and/or text)
        $pdf->Image('images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');

        // define active area for signature appearance
        $pdf->setSignatureAppearance(180, 60, 15, 15);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        // *** set an empty signature appearance ***
        $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('example_052.pdf', 'D');
    }
    // public function signing(Request $request)
    // {
    //     $cert = new ManageCert;
    //     $cert->fromUpload($request->pfxUploadedFile, $request->password);

    //     // $file = $request->file('pdf');
    //     // $file_name = uniqid().'_'.$file->getClientOriginalName();
    //     // $folder = uniqid('pdf_', true);
    //     // $file->storeAs('files/tmp/'.$folder, $file_name);
    //     // $path = 'storage/files/tmp/'.$folder.'/'.$file_name;

    //     $image = SealImage::fromCert($cert);

    //     // IMAGE STORAGE LOCATION
    //     $imagePath = a1TempDir(true, '.png');
    //     File::put($imagePath, $image);
    //     $name = 'Ilham';
    //     $location = 'Cianjur';

    //     $pdf = new SignaturePdf($request->file('pdf'), $cert, SignaturePdf::MODE_DOWNLOAD);
    //     $resource = $pdf->setImage($imagePath, 15, 200, 50, 0) // Defines an image in place of the document's signature.
    //                     ->setFileName($request->file('pdf')->extension()) // Use the "setFileName" method if you want to modify the name of the file that will be returned.
    //                     ->setInfo( // Defines extra information for the digital signature.
    //                         $name,
    //                         $location,
    //                     )
    //                     ->setSealImgOnEveryPages(true)
    //                     ->setHasSignedSuffix(true) // By default the suffix "_signed" will be included at the end of the filename, if you don't want this behavior, just set the value "false" in the "setHasSignedSuffix" method.
    //                     ->signature();

    //     return $resource;
    // }

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
