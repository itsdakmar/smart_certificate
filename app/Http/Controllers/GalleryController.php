<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class GalleryController extends Controller
{
    public function store(Request $request, $programme_id)
    {
        $count = sizeof($request->file('photos'));
        for ($i = 0; $i < $count; $i++) {
            $file = $request->file('photos.' . $i)->store('photos');

            Gallery::create([
                'path' => $file,
                'programme_id' => $programme_id,
                'uploaded_by' => Auth()->user()->id
            ]);
        }
        return redirect()->route('programme.gallery', $programme_id)->withStatus(__('Photos was successfully uploaded.'));
    }

    public function getPhoto($filename)
    {
        try {
            return Storage::disk('local')->response('photos/' . $filename);
        } catch (FileNotFoundException $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function destroy(Request $request, $programme_id)
    {
        Gallery::destroy($request->checked);
        return redirect()->route('programme.gallery', $programme_id)->withStatus(__('Photos was successfully deleted.'));

    }
}
