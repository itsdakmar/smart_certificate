<?php

namespace App\Http\Controllers;

use App\CertificateConfig;
use App\CertificateContent;
use App\SystemConfigs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RobbieP\CloudConvertLaravel\Facades\CloudConvert;
use PDF;

class TemplateController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  CertificateConfig $model
     * @return \Illuminate\View\View
     */
    public function index(CertificateConfig $model)
    {
        return view('template.index', ['templates' => $model->orderBy('id', 'DESC')->paginate(15)]);
    }

    public function orientation()
    {
        return view('template.orientation');
    }

    public function create()
    {
        return view('template.create');
    }

    public function edit($layout_id)
    {
        $certificate_conf = CertificateConfig::findOrFail($layout_id);
        $contents = $certificate_conf->certificateContents();


        return view('template.layout-portrait', compact('certificate_conf', 'contents'));
    }

    public function update(Request $request, $layout_id)
    {
        $validator = Validator::make($request->all(), [
            'cert_content.*' => 'required|string',
            'alignment_director' => 'required_if:show_director,1',
            'alignment.*' => 'required',
            'font_size.*' => 'required|numeric',
            'x.*' => 'required|numeric|min:1|max:176',
            'y.*' => 'required|numeric|min:1|max:290',
            'margin_left.*' => 'numeric',
            'margin_right.*' => 'numeric',
            'qr_x' => 'required|numeric',
            'qr_y' => 'required|numeric',
            'qr_width' => 'required|numeric',
            'qr_height' => 'required|numeric',
        ]);


        if ($validator->fails()) return back()->withErrors($validator)->withInput()->with('row', sizeof($request->get('cert_content')));

        CertificateContent::where(['config_id' => $layout_id])->delete();
        $certs = CertificateConfig::find($layout_id);

        if($request->show_director){
            $certs->update([
                'show_director' => 1,
                'alignment_director' => $request->alignment_director,
                'qr_x' => $request->qr_x,
                'qr_y' => $request->qr_y,
                'qr_width' => $request->qr_width,
                'qr_height' => $request->qr_height,
            ]);
        }else{
            $certs->update([
                'show_director' => 0,
                'qr_x' => $request->qr_x,
                'qr_y' => $request->qr_y,
                'qr_width' => $request->qr_width,
                'qr_height' => $request->qr_height,
            ]);
        }

        $count = count($request->cert_content);
        for ($i = 0; $i < $count; $i++) {
            $certContent = new CertificateContent();
            $certContent->content = $request->cert_content[$i];
            $certContent->config_id = $layout_id;
            $certContent->x = $request->x[$i];
            $certContent->y = $request->y[$i];
            $certContent->margin_left = $request->margin_left[$i];
            $certContent->margin_right = $request->margin_right[$i];
            $certContent->font_size = $request->font_size[$i];
            $certContent->alignment = $request->alignment[$i];
            $certContent->save();
        }
        return back()->withStatus(__('status.success_update'));
    }

    public function destroy($id)
    {
        $template = CertificateConfig::findOrFail($id);
        $template->delete();

        return redirect()->route('template')->withStatus(__('Template was successfully deleted.'));

    }

    /**
     * Upload Template and covert it to jpg
     * Using https://Cloudconvert.com API
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function upload(Request $request)
    {
        $message = [
            'template' => ':attribute only doc,dotx,docx,ppt,pptx,pdf accepted'
        ];

        $request->validate([
            'layout_name' => 'required',
            'cert_type' => 'required',
            'template' => 'required|mimes:doc,dotx,docx,ppt,pptx,pdf'
        ], $message);

        $file = $request->file('template');
        $originalName = $file->getFilename() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploaded/template/original/'), $originalName);
        CloudConvert::file(public_path('/uploaded/template/original/') . $originalName)->queue('to', public_path('/uploaded/template/converted/') . $file->getFilename() . '.jpg');

        CertificateConfig::create([
            'orientation' => $request->orientation,
            'name' => $request->layout_name,
            'original' => $originalName,
            'converted' => $file->getFilename() . '.jpg',
            'certificate_type' => $request->cert_type,
            'convert_status' => 1,
        ]);

        return redirect()->route('template')->withStatus(__('status.success_wait_for_notify'));
    }

    public function preview($id)
    {
        $cert = CertificateConfig::where(['id' =>$id])->with('certificateContents')->first();

        if($cert->show_director == 1){
            $director = SystemConfigs::first();

            $director_details = '<span>'.$director->director_name.'</span><br/>
                                 <span>PENGARAH</span><br/>
                                 <span>KOLEJ KOMUNITI KEMAMAN</span><br/>
                                 <span>JABATAN KEMENTERIAN PENDIDIKAN MALAYSIA</span>';
        }

        PDF::SetTitle('Certificate {{ NAMA_PROGRAM }}');

        PDF::setHeaderCallback(function ($pdf) use ($cert) {
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->Image(public_path('uploaded/template/converted/'.$cert->converted), 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            $pdf->setPageMark();
        });

        PDF::setCellPaddings(16, 0, 6);
        PDF::AddPage('P', 'A4');

        $findme = [
            '{nama_peserta}' => '<b class="text-uppercase"> MUHAMMAD AMMAR BIN MOHD RAZAMAN </b>',
            '{penganjur_program}' => '<b class="text-uppercase">UNIT IT</b>',
            '{ic_peserta}' => '<b class="text-uppercase"> 000000-00-0000 </b>',
            '{nama_program}' => '<b class="text-uppercase">PROGRAM PENGATURCARAAN PHP</b>',
            '{lokasi_program}' => '<b class="text-uppercase">KOLEJ KOMUNITI KEMAMAN</b>',
            '{tarikh_program}' => '<b class="text-uppercase">16 July 2019</b>',
            '{tugas}' => '<b class="text-uppercase">PENCERAMAH</b>',
        ];



        foreach ($cert->certificateContents as $content) {
            $parse_content = strtr($content->content, $findme);
            PDF::SetFontSize($content->font_size);
            PDF::setCellPaddings($content->margin_left,0,$content->margin_right);
            PDF::writeHTMLCell(0, 0, $content->x, $content->y, $parse_content, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment , $autopadding = false);
        }

        if($cert->show_director == 1 ){
            PDF::SetFontSize(11);
            PDF::writeHTMLCell(0, 0, 1, 265, $director_details, $border = 0, $ln = 0, $fill = false, $reseth = true, $align = $content->alignment , $autopadding = true);
        }

        PDF::write2DBarcode('ican.my', 'QRCODE,L', $cert->qr_x, $cert->qr_y, $cert->qr_width, $cert->qr_height, NULL, 'N');

        return PDF::Output('certificate.pdf');
    }
}
