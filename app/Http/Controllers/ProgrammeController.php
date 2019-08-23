<?php
/**
 * Programme Controller
 *
 * Date Created : June 2019
 * Create By : Amar Razaman
 */

namespace App\Http\Controllers;

use App\CertificateConfig;
use App\Document;
use App\Gallery;
use App\Programme;
use App\SystemConfigs;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;


class ProgrammeController extends Controller
{

    /**
     * Render list of Programme page
     *
     * @param  Request $request
     * @param  Programme $programme
     *
     * @return \Illuminate\View\View;
     */
    public function index(Request $request, Programme $programme)
    {
        if (Auth::user()->getRoleNames() == "Director") {
            $programme = $programme->whereIn('status', [2, 3]);
        }

        if($request){
            session()->flashInput($request->input());
        }

        return view('programme.index', ['programmes' => $programme->filter($request)->paginate(15)]);
    }

    /**
     * Render create programme page
     *
     * @return \Illuminate\View\View;
     */
    public function create()
    {
        $participants = CertificateConfig::where(['certificate_type' => 1])->get()->sortByDesc('id');
        $committees = CertificateConfig::where(['certificate_type' => 2])->get()->sortByDesc('id');

        return view('programme.create', compact('participants', 'committees'));
    }

    /**
     * Storing programme
     *
     * @param  Request $request
     * @param  Programme $programme
     *
     * @return \Illuminate\View\View;
     */
    public function store(Request $request, Programme $programme)
    {
        $programme->create($request->merge([
            'status' => 1, // Permohonan
            'created_by' => auth()->user()->id,
            'slug' => Str::slug($request->programme_name),
        ])->all());

        return redirect()->route('programme')->withStatus(__('Programme successfully created.'));
    }

    /**
     * Render edit programme's page
     *
     * @param  integer $programme_id
     *
     * @return \Illuminate\View\View;
     */
    public function edit($programme_id)
    {
        $Programme = Programme::findOrFail($programme_id);
        return view('programme.edit', compact('Programme'));
    }

    /**
     * Updating programme
     *
     * @param  Request $request
     * @param  integer $programme_id
     *
     * @return \Illuminate\View\View;
     */
    public function update(Request $request, $programme_id)
    {
        $programme = Programme::find($programme_id);
        $programme->update($request->all());

        return redirect()->route('programme')->withStatus(__('Programme successfully updated.'));
    }

    /**
     * Updating programme Status To Submitted // status - 2 - Submitted
     *
     * @param  integer $programme_id
     *
     * @return \Illuminate\View\View;
     */
    public function submit($programme_id)
    {
        $programme = Programme::find($programme_id);
        $programme->update(['status' => 2]);

        return redirect()->route('programme')->withStatus(__('Programme successfully submitted, waiting for approval.'));
    }

    /**
     * Updating programme Status To Approved // status - 3 - Approved
     *
     * @param  integer $programme_id
     *
     * @return \Illuminate\View\View;
     */
    public function approve($programme_id)
    {
        $programme = Programme::find($programme_id);
        $programme->update(['status' => 3]);

        return redirect()->route('programme')->withStatus(__('Programme was successfully approved.'));
    }

    public function gallery($programme_id)
    {
        $galleries = Gallery::where(['programme_id' => $programme_id]);

        return view('programme.gallery.edit', ['galleries' => $galleries->paginate(9), 'programme' => $programme_id]);
    }

    public function document(Request $request, $programme_id)
    {

        $file = $request->file('document')->store('documents');

        Document::create([
            'name' => $request->document_name,
            'file_url' => $file,
            'programme_id' => $programme_id
        ]);

        return redirect()->route('programme.show', $programme_id)->withStatus(__('Document was successfully uploaded.'));
    }

    /**
     * Render programme's details page
     *
     * @param  integer $programme_id
     *
     * @return \Illuminate\View\View;
     */
    public function show($programme_id)
    {
        $programme = Programme::findOrFail($programme_id);

        $candidates = $programme->candidates()->paginate(15, ['*'], 'candidates');
        $committees = $programme->committees()->paginate(15, ['*'], 'committees');

        return view('programme.show', compact('programme', 'candidates', 'committees'));
    }

    public function scan($qr)
    {
        dd($qr);
    }

    public function preview($id, $type)
    {
        $programme = Programme::findOrFail($id);

        $cert = ($type == 1) ? $programme->certParticipants()->first() : $programme->certCommittees()->first();

        if ($cert->show_director == 1) {
            $director = SystemConfigs::first();

            $director_details = '<span>' . $director->director_name . '</span><br/>
                                 <span>PENGARAH</span><br/>
                                 <span>KOLEJ KOMUNITI KEMAMAN</span><br/>
                                 <span>JABATAN KEMENTERIAN PENDIDIKAN MALAYSIA</span>';
        }

        PDF::SetTitle('Certificate for ' . $programme->programme_name);

        PDF::setHeaderCallback(function ($pdf) use ($cert) {
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->Image(public_path('uploaded/template/converted/' . $cert->converted), 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            $pdf->setPageMark();
        });

        PDF::setCellPaddings(16, 0, 6);
        PDF::AddPage('P', 'A4');

        $findme = [
            '{nama_peserta}' => '<b> MUHAMMAD AMMAR BIN MOHD RAZAMAN </b>',
            '{ic_peserta}' => '<b> 960208-14-5611 </b>',
            '{nama_program}' => '<b>' . $programme->programme_name . '</b>',
            '{lokasi_program}' => '<b>' . $programme->programme_location . '</b>',
            '{tarikh_program}' => '<b>' . $programme->programme_date_for_cert . '</b>',
        ];

        foreach ($cert->certificateContents as $content) {
            $parse_content = strtr($content->content, $findme);
            PDF::SetFontSize($content->font_size);
            PDF::writeHTMLCell(0, 0, $content->x, $content->y, $parse_content, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment, $autopadding = true);
        }

        if ($cert->show_director == 1) {
            PDF::SetFontSize(11);
            PDF::writeHTMLCell(0, 0, 1, 265, $director_details, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment, $autopadding = true);
        }

        PDF::write2DBarcode(route('programme.scan', $programme->slug), 'QRCODE,L', 165, 250, 35, 35, NULL, 'N');


        return PDF::Output('certificate.pdf');
    }

    public function print($programme_id, $type)
    {
        $programme = Programme::findOrFail($programme_id);
        $cert = ($type == 1) ? $programme->certParticipants()->first() : $programme->certCommittees()->first();

        if ($cert->show_director == 1) {
            $director = SystemConfigs::first();

            $director_details = '<span>' . $director->director_name . '</span><br/>
                                 <span>PENGARAH</span><br/>
                                 <span>KOLEJ KOMUNITI KEMAMAN</span><br/>
                                 <span>JABATAN KEMENTERIAN PENDIDIKAN MALAYSIA</span>';
        }

        PDF::SetTitle('Hello World');

        PDF::setHeaderCallback(function ($pdf) use ($cert) {
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->Image(public_path('uploaded/template/converted/' . $cert->converted), 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            $pdf->setPageMark();
        });

        foreach ($programme->candidates()->get() as $candidate) {
            PDF::AddPage('P', 'A4');


            $findme = [
                '{nama_peserta}' => '<b>' . $candidate->name . '</b>',
                '{ic_peserta}' => '<b>' . $candidate->identity_card . '</b>',
                '{nama_program}' => '<b>' . $programme->programme_name . '</b>',
                '{lokasi_program}' => '<b>' . $programme->programme_location . '</b>',
                '{tarikh_program}' => '<b>' . $programme->programme_date_for_cert . '</b>',
            ];

            foreach ($cert->certificateContents as $content) {
                $parse_content = strtr($content->content, $findme);

                PDF::SetFontSize($content->font_size);
                PDF::writeHTMLCell(0, 0, $content->x, $content->y, $parse_content, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment, $autopadding = true);
            }


            if ($cert->show_director == 1) {
                PDF::SetFontSize(11);
                PDF::writeHTMLCell(0, 0, 1, 265, $director_details, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment, $autopadding = true);
            }

            PDF::write2DBarcode(route('programme.scan', $programme->slug), 'QRCODE,L', 165, 250, 35, 35, NULL, 'N');

        }

        return PDF::Output('hello_world.pdf');
    }

    public function getDocuments($filename)
    {
        try {
            return Storage::disk('local')->response('documents/' . $filename);
        } catch (FileNotFoundException $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function destroyDocuments($programme_id , $filename){

        $document = Document::findOrFail($filename);
        Storage::delete('documents/'.$document->file_url);
        Document::destroy($filename);

        return redirect()->route('programme.show', $programme_id)->withStatus(__('Documents was successfully deleted.'));
    }

}
