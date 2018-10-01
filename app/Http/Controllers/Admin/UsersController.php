<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Requests\Admin\Users\UpdateUserRequest;

use Illuminate\Http\Request;

use Datatables;
use Html;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle      = __('admin.users.title');

        return view('admin.users.index', compact('role', 'pageTitle', 'request'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $users = User::users();

        if ($request->has('winners')) {
            $user = $users->whereHas('presents');
        }

        $users = $users->with('media');

        $datatables = Datatables::of($users)
            ->editColumn('id', function(User $user) {
                return $user->id . ($user->is_winner ? '<span class="winners"></span>' : '');
            })
            ->editColumn('avatar', function(User $user) {
                return Html::image($user->avatar->getUrl(), null, ['width' => 100])->toHtml();
            })
            ->editColumn('phone', function(User $user) {
                return $user->masked_phone;
            })
            ->editColumn('is_mail_confirmed', function(User $user) {
                return getBooleanText($user->is_mail_confirmed);
            })
            ->editColumn('10th_friend_invited_at', function(User $user) {
                return $user->{'10th_friend_invited_at'} ?? '-';
            })
            ->addColumn('actions', function(User $user) {
                return view('admin.users._actions', compact('user'))->render();
            });

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $pageTitle = __('admin.users.show_title');

        $invitedUsersIds = $user->points()->friendInviteEvent()->pluck('invited_user_id')->toArray();
        $invitedUsers    = User::find($invitedUsersIds);

        return view('admin.users.show', compact('pageTitle', 'user', 'invitedUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->updateConfirmed($request->is_mail_confirmed);

        if(!$request->ajax()) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
    }
}
