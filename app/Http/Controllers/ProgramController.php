<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(User $model){
        return view('program.index', ['users' => $model->paginate(15)]);
    }

    public function show(){
        return "hello-show";
    }
}
