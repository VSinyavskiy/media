<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class AppController extends Controller
{
	public function age()
    {
        return view('app.age_gate');
    }

    public function index()
    {
        return view('app.index');
    }
}
