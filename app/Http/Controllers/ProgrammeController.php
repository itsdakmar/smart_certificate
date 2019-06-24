<?php

namespace App\Http\Controllers;

use App\Programmes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProgrammeController extends Controller
{
    public function index(Request $request, Programmes $programme)
    {

        if ($request->has('filter')) {
            $programme = $this->filter($request, $programme);
        }



        return view('programme.index', ['users' => $programme->paginate(15)]);
    }

    public function filter(Request $request, Programmes $programme)
    {
        // Search for a user based on their name.
        if ($request->has('programme_name')) {
            return $programme->where('programme_name', 'like', '%' . $request->input('programme_name') . '%');
        }

        // Search for a user based on their company.
        if ($request->has('programme_date')) {
            return $programme->where('programme_date', $request->input('programme_date'));
        }
    }

    public function create()
    {
        return view('programme.create');
    }

    public function store(Request $request, Programmes $model)
    {
        $model->create($request->merge([
            'certificate_conf' => 1,
            'status' => 1,
            'programme_start' => date('Y-m-d', strtotime(str_replace('/','-', $request->get('programme_start')))),
            'programme_end' =>date('Y-m-d', strtotime(str_replace('/','-', $request->get('programme_start')))),
            'created_by' => auth()->user()->id,
        ])->all());

        return redirect()->route('programme')->withStatus(__('Programme successfully created.'));
    }
}
