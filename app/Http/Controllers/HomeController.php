<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $array = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];

        $programmes = DB::table('programmes')
            ->selectRaw('MONTH(programme_start) month , COUNT(*) total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get()->toArray();

        foreach ($programmes as $programme) {
            $array[$programme->month] = $programme->total;
        }

        $data = Json::encode(array_values($array));

       $certificates = DB::table('programmes')
           ->selectRaw('COUNT("candidates.*") as total')
           ->where('programmes.status','=',3)
           ->join('candidates','programme_id','programmes.id')
           ->get()->toArray();


       $generated = $certificates[0]->total;

        return view('dashboard', compact('data','generated'));
    }
}
