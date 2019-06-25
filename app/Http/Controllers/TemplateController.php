<?php

namespace App\Http\Controllers;

use App\CertificateConfigs;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User $model
     * @return \Illuminate\View\View
     */
    public function index(CertificateConfigs $model)
    {
        return view('template.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        return view('template.create');
    }
}
