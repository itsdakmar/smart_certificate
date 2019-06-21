<?php

namespace App\Http\Controllers;

use App\Programmes;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Programmes $model){
        return view('program.index', ['users' => $model->paginate(15)]);
    }

    public function show(){
        return "hello-show";
    }
}
