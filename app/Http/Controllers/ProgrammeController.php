<?php
/**
 * Programme Controller
 *
 * Date Created : June 2019
 * Create By : Amar Razaman
 */

namespace App\Http\Controllers;

use App\CertificateConfig;
use App\Programme;
use Illuminate\Http\Request;
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

        return view('programme.create', compact('participants','committees'));
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
            'certificate_conf' => 1, //Default Template Layout
            'status' => 1, // Permohonan
            'created_by' => auth()->user()->id,
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
     * Render programme's details page
     *
     * @param  integer $programme_id
     *
     * @return \Illuminate\View\View;
     */
    public function show($programme_id)
    {
        $programme = Programme::findOrFail($programme_id);

        $candidates = $programme->candidates()->paginate(5, ['*'], 'candidates');
        $committees = $programme->committees()->paginate(5, ['*'], 'committees');

        return view('programme.show', compact('programme','candidates','committees'));
    }

    public function print($programme_id)
    {
        $programme = Programme::findOrFail($programme_id);
        $cert = $programme->certificateConfig()->first();


        PDF::SetTitle('Hello World');

        PDF::setHeaderCallback(function ($pdf) use ($cert) {
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->Image(public_path('uploaded/template/converted/'.$cert->converted), 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            $pdf->setPageMark();
        });

        foreach ($programme->candidates()->get() as $candidate){
            PDF::AddPage('P', 'A4');


            $findme   = [
                '{nama_peserta}' => '<b>'.$candidate->name.'</b>',
                '{ic_peserta}' => '<b>'.$candidate->identity_card.'</b>',
                '{nama_program}' => '<b>'.$programme->programme_name.'</b>',
                '{lokasi_program}' => '<b>'.$programme->programme_location.'</b>',
                '{tarikh_program}' => '<b>'.$programme->programme_date_for_cert.'</b>',
            ];

            foreach ($cert->certificateContents as $content) {
                $parse_content = strtr($content->content, $findme);

                PDF::SetFontSize($content->font_size);
                PDF::SetFont('courier');
                PDF::writeHTMLCell(0, 0, $content->x, $content->y, $parse_content, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment , $autopadding = true);
            }
        }

        return PDF::Output('hello_world.pdf');
    }

}
