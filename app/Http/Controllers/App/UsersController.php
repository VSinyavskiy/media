<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    public function invite(User $user)
    {
        $siteUser = User::findOrFail($user);

        return redirect()->route('game', '#open-invite-success')->withCookie(cookie()->forever('invited', $user->id));
    }

    public function user()
    {
        $user = auth()->guard('web')->user();

        $topDonerUsers = User::users()->confirmed()->whileGameAction()->topTotalPoints()->limit(User::COUNT_TOP)->get();

        if (! $topDonerUsers->contains('id', $user->id)) {
            $user->setPosition($user->calculatePosition());

            $topDonerUsers->pop();
            $topDonerUsers->push($user);
        }

        return view('app.users.show', compact('user', 'topDonerUsers'));
    }

    public function history(Request $request)
    {
        $user   = auth()->guard('web')->user();

        $points = $user->points()->byScoringAT()->paginate(User::COUNT_HISTORY);

        $currentPage = $points->currentPage();
        if ($request->ajax()) {
            return [
                'result'      => view('app.users._history_paginate', compact('points'))->render(),
                'currentPage' => $currentPage,
            ];
        }

        $lastPage = $points->lastPage();

        return view('app.users.history', compact('points', 'currentPage', 'lastPage'));
    }

    public function winners()
    {
        return view('app.users.winners');
    }
}
