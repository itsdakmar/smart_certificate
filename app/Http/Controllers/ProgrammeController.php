<?php
/**
 * Programme Controller
 *
 * Date Created : June 2019
 * Create By : Amar Razaman
 */

namespace App\Http\Controllers;

use App\Programme;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;



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
        return view('programme.create');
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
        $candidates = $programme->candidates()->paginate(7);
        return view('programme.show', compact('programme','candidates'));
    }

    public function print()
    {
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('programme.print')->stream('download.pdf');
//        return view('programme.print');
    }

}
