<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $users = User::with('roles')->get();

        return view('admin.members.index', ['user' => $user, 'users' => $users]);
    }


    public function edit(User $user)
    {
        $userAuth = Auth::user();
        $userAuth->load('roles');
        $roles = Role::all();

        return view('admin.members.edit', ['user' => $userAuth, 'otherUser' => $user, 'roles' => $roles]);
    }


    public function update(Request $request, User $user)
    {
        $validateData = $request->validate([
            'name' => 'string|max:50',
            'firstname' => 'string|max:50',
            'email' => 'string|email|max:255',
            'paypal' => 'string|max:200|nullable',
            'birthday' => 'date|nullable',
        ]);

        $validateData['name'] = strtoupper($validateData['name']);
        $validateData['firstname'] = ucfirst($validateData['firstname']);

        $user->update($validateData);

        $role = Role::where('id', $request['role_id'])->first();
        $user->roles()->detach();
        $user->roles()->attach($role);

        if ($request['role_id'] == 4 OR $request['role_id'] == 5){

            $admin = Role::where('name', 'admin')->first();
            $user->roles()->attach($admin);
        }


        return redirect()->route('admin.members.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $data)
    {
        $user = User::create([
            'name' => ucfirst($data['name']),
            'firstname' => ucfirst($data['firstname']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'writer')->first());

        return redirect()->route('admin.members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}



