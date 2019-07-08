<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Imports\CandidateImports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class CandidateController extends Controller
{
    public function create($programme_id)
    {
        return view('candidate.create' , compact('programme_id'));
    }

    public function store(Request $request , $programme_id)
    {

        $validator = Validator::make($request->all(), [
            'candidate_name.*' => 'required|string',
            'candidate_ic.*' => 'required|regex:/^\d{6}\d{2}\d{4}$/',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('row', sizeof($request->get('candidate_name')));
        }

        $count = count($request->candidate_name);
        for($i = 0; $i < $count; $i++){
            $candidate = new Candidate();
            $candidate->name = $request->candidate_name[$i];
            $candidate->identity_card = $request->candidate_ic[$i];
            $candidate->programme_id = $programme_id;
            $candidate->type = 1;
            $candidate->save();

        }
        return redirect()->route('programme.show', ['id' => $programme_id])->withStatus(__('Candidates successfully added.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request, $programme_id)
    {
        $request->validate([
            'import_file' => 'required'
        ]);


        $candidates = Excel::import(new CandidateImports($programme_id), request()->file('import_file'));

       dd($candidates);


        return back()->with('success', 'Insert Record successfully.');
    }
}
