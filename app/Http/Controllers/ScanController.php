<?php

namespace App\Http\Controllers;

use App\Programme;

class ScanController extends Controller
{
    public function index($qr){

        $programme = Programme::where(['slug' => $qr])->first();

        $candidates = $programme->participants()->paginate(15, ['*'], 'candidates');
        $committees = $programme->committees()->paginate(15, ['*'], 'committees');

        return view('scan.index', compact('programme', 'candidates', 'committees'));
    }
}
