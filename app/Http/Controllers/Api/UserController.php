<?php

namespace App\Http\Controllers\Api;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {

        return User::with('publication',
            'post',
            'tutorial',
            'comment',
            'followers',
            'followings',
            'roles',
            'postsBought',
            'unreadMessageByUser',
            'unreadMessage')->get();

    }


    /**
     * @param User $user
     * @return User
     */
    public function edit(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
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

        if ($request['role_id'] == 4 OR $request['role_id'] == 5) {

            $admin = Role::where('name', 'admin')->first();
            $user->roles()->attach($admin);
        }


        return response()->json($user, 200);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => ucfirst($request['name']),
            'firstname' => ucfirst($request['firstname']),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'writer')->first());

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function show(User $user)
    {

        return $user->with('publication',
            'post',
            'tutorial',
            'comment',
            'followers',
            'followings',
            'roles',
            'postsBought',
            'unreadMessageByUser',
            'unreadMessage')->find($user->id);

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);

    }
}



