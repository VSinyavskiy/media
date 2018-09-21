<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

use App\Models\User;

class AppController extends Controller
{
	public function age()
    {
        return view('app.age_gate');
    }

    public function index()
    {
    	$user = auth()->guard('web')->user();
    	
    	$topDonerUsers = User::users()->confirmed()
    									->whileGameAction()
    									->sortByTopTotalPoints()
    									->limit(User::COUNT_TOP)
    									->get();

        return view('app.index', compact('user', 'topDonerUsers'));
    }
}
