<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();

        if (empty($current_user->name) || empty($current_user->about)) {
            return redirect()->route('profile.edit', compact('current_user'));
        }

        $users = User::all()
            ->whereNotIn('email', $current_user->email)
            ->whereNotIn('name', '');

        return view('profile', [
            'current_user' => $current_user,
            'users' => $users
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
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'about' => 'required|string|min:10|max:255',
            'gender' => 'required|string',
        ]);

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

            $profile::destroy($profile->id);

            return redirect()->route('profile.index')
                ->with('status', 'Delete Success!');
        } catch (\DomainException $e) {
            return $this->$e->getCode();
        }
    }
}
