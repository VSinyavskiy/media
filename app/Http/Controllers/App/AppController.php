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

    public function user()
    {
        $user = auth()->guard('web')->user();

        return view('app.user', compact('user'));
    }

    public function history()
    {
        return view('app.history');
    }

    public function winners()
    {
        return view('app.winners');
    }

    public function game()
    {
        return view('app.game');
    }
}
