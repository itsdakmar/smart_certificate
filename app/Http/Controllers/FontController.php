<?php

namespace App\Http\Controllers;

use App\CertificateContent;
use App\Font;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FontController extends Controller
{
    public function index(Font $model)
    {
        return view('font.index', ['fonts' => $model->paginate(15)]);
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        $originalName = uniqid() . '-' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('fonts/'), $originalName);

        Font::create($request->merge([
            'path' => $originalName,
            'created_by' => Auth()->user()->id
        ])->all());

        return redirect()->route('font.index')->withStatus(__('Font was successfully uploaded.'));
    }

    public function show($path)
    {
        try {
            return Storage::disk('local')->get($path);
        } catch (FileNotFoundException $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        if(CertificateContent::where(['font_style' => $id])->exists()){
            return redirect()->route('font')->with('failed', 'Failed to delete, this font is being used.');
        }

        Font::destroy($id);
        return redirect()->route('font')->withStatus(__('Font was successfully uploaded.'));
    }

}
