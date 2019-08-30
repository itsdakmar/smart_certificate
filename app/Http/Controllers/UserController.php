<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminPasswordRequest;
use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Role::pluck('name', 'id');

        return view('users.create',compact('items'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $role = Role::find($request->roles);
        $user = $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        $user->assignRole($role->name);
        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }



    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {

        $items = Role::pluck('name', 'id');
        return view('users.edit', compact('user','items'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $role = Role::find($request->roles);

        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        $user->removeRole($user->getRoleNames());
        $user->assignRole($role->name);

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    public function password(AdminPasswordRequest $request, $user)
    {
        $user = User::findOrFail($user);
        $user->update(['password' => Hash::make($request->get('password'))]);

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
