<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Imports\CandidateImports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class CandidateController extends Controller
{
    public function create($programme_id, $type)
    {
        if ($type == 1) {
            return view('participants.create', compact('type', 'programme_id'));
        } else {
            return view('committees.create', compact('type', 'programme_id'));
        }
    }

    public function store(Request $request, $programme_id, $type)
    {

        $validator = Validator::make($request->all(), [
            'candidate_name.*' => 'required|string',
            'candidate_ic.*' => 'required|regex:/^\d{6}\d{2}\d{4}$/',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('row', sizeof($request->get('candidate_name')));
        }

        $count = count($request->candidate_name);
        for ($i = 0; $i < $count; $i++) {
            $candidate = new Candidate();
            $candidate->name = $request->candidate_name[$i];
            $candidate->identity_card = $request->candidate_ic[$i];
            $candidate->programme_id = $programme_id;
            $candidate->type = $type;
            $candidate->save();

        }
        return redirect()->route('programme.show', ['id' => $programme_id])->withStatus(__('Candidates successfully added.'));
    }

    public function edit($id, $type)
    {
        $candidate = Candidate::findOrFail($id);

        if ($type == 1) {
            return view('participants.edit', compact('candidate'));

        } else {
            return view('committees.edit', compact('candidate'));
        }
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->update([
            'name' => $request->candidate_name,
            'identity_card' => $request->candidate_ic,
        ]);

        return redirect()->route('programme.show', ['id' => $candidate->programme_id])->withStatus(__('Candidate was successfully updated.'));
    }

    public function destroy($programme_id, Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('programme.show', ['id' => $programme_id])->withStatus(__('Candidates successfully deleted.'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request, $programme_id, $type)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        Excel::import(new CandidateImports($programme_id, $type), request()->file('import_file'));

        $type = ($type == 1) ? 'Candidates' : 'Committees';
        return redirect()->route('programme.show', ['id' => $programme_id])->withStatus(__($type . ' was successfully uploaded.'));


    }
}
