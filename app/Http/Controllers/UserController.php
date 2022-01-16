<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('users-read');

        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (!Gate::allows('users-create')) {
        //     abort(403);
        // }
        Gate::authorize('users-create');

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('users-create');

        // dd($request->permissions);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|min:8|confirmed',
            'image' => 'image|mimes:jpg,png,jpeg|max:4096',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'active', 'permissions', 'image']);
        $request_data['active'] = $request->active ? true : false;
        $request_data['password'] = Hash::make($request->password);


        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $image = $request->file('image')->store('images', 'public');
            $request_data['image'] =  $image;
        }

        // dd($request_data);

        $user = User::create($request_data);

        $user->attachRole('admin');
        $request->permissions ? $user->syncPermissions($request->permissions) : '';

        return redirect()->route('users.index')->with('message', 'Add User Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('users-delete');

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('users-update')) {
            abort(403);
        }
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|string',
        ]);

        $request_data = $request->except(['active', 'permissions']);
        $request_data['active'] = $request->active ? true : false;

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        return redirect()->route('users.index')->with('message', 'Update User Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Gate::allows('users-delete')) {
            abort(403);
        }
    }
}
