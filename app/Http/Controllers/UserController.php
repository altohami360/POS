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
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('users-create');

        $modals = ['users', 'categories', 'products', 'clients', 'orders'];
        $maps = ['create', 'read', 'update', 'delete'];

        return view('users.create', compact('modals', 'maps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|min:8|confirmed',
            // 'image' => 'mimes:jpg,png,jpeg|max:4096',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'active', 'permissions', 'image']);
        $request_data['active'] = $request->active ? true : false;
        $request_data['password'] = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $image = $request->file('image')->store('images/users', 'public');
            $request_data['image'] =  $image;
        }

        $user = User::create($request_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        // toaster()->success('Have fun storming the castle!', 'Miracle Max Says');
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
        Gate::authorize('users-update');

        $modals = ['users', 'categories', 'products', 'clients', 'orders'];
        $maps = ['create', 'read', 'update', 'delete'];

        return view('users.edit', compact('user', 'modals', 'maps'));
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
        //
    }
}
