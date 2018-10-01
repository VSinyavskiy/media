<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Present;
use App\Http\Requests\App\Users\WinnersRequest;

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

        $topDonerUsers = User::users()->confirmed()
                                        ->whileGameAction()
                                        ->sortByTopTotalPoints()
                                        ->limit(User::COUNT_TOP)
                                        ->get();

        if (! $topDonerUsers->contains('id', $user->id)) {
            $user->setPosition($user->calculatePosition());

            $topDonerUsers->push($user);
        }

        return view('app.users.show', compact('user', 'topDonerUsers'));
    }

    public function history(Request $request)
    {
        $user   = auth()->guard('web')->user();

        $points = $user->points()->sortByScoringAT()->paginate(User::COUNT_HISTORY); 

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

    public function winners(WinnersRequest $request)
    {
        $presents = Present::select(['*']);

        if ($request->has('phone') && !is_null($request->phone)) {
            $presents = $presents->whereHas('user', function ($query) use ($request) {
                $query->where('phone', 'like', '%' . withoutSymbols($request->phone, ['_', ' ']) . '%');
            });
        }

        $presents = $presents->userConfirmed()->sortByCreatedAT()->with('user')->paginate(Present::COUNT_WINNERS);

        $currentPage = $presents->currentPage();
        if ($request->ajax()) {
            return [
                'result'      => view('app.users._winners_paginate', compact('presents', 'currentPage'))->render(),
                'currentPage' => $currentPage,
            ];
        }

        $lastPage = $presents->lastPage();

        return view('app.users.winners', compact('presents', 'currentPage', 'lastPage', 'request'));
    }
}
