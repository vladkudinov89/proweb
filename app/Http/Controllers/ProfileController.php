<?php

namespace App\Http\Controllers;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\DeleteUserRequest;
use App\Actions\User\GetAllUsersAction;
use App\Entities\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @var GetAllUsersAction
     */
    private $getAllUsersAction;
    /**
     * @var DeleteUserAction
     */
    private $deleteUserAction;

    /**
     * ProfileController constructor.
     * @param GetAllUsersAction $getAllUsersAction
     */
    public function __construct(
        GetAllUsersAction $getAllUsersAction,
        DeleteUserAction $deleteUserAction
    )
    {
        $this->getAllUsersAction = $getAllUsersAction;
        $this->deleteUserAction = $deleteUserAction;
    }

    public function index()
    {
        $current_user = \Auth::user();

        if (empty($current_user->name) || empty($current_user->about)) {
            return redirect()->route('profile.edit', compact('current_user'));
        }

        return view('profile', [
            'current_user' => $current_user,
            'users' => $this->getAllUsersAction->execute($current_user)->getCollection()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Entities\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        return view('profile.show', [
            'user' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Entities\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Entities\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = Auth::user();

        $user->update($request->only('name', 'about', 'gender'));

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Entities\User $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $profile)
    {
        try {
            $this->authorize('update', $profile);

            $this->deleteUserAction->execute(new DeleteUserRequest($profile->id));

            return redirect()->route('profile.index')
                ->with('status', 'Delete Success!');
        } catch (\DomainException $e) {
            return $this->$e->getCode();
        }
    }
}
