<?php

namespace App\Http\Controllers\FrontEnd;

use App\Follow;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function followUser($slug)
    {

        $userFollowed = User::findBySlugOrFail($slug);
        $userFollowing = Auth::user();

        foreach ($userFollowing->followings as $following)
            if ($following->id == $userFollowed->id) {
                return redirect()->route('other-profil', ['slug' => $slug]);
            }

        $userFollowed->followers()->attach($userFollowing->id);
        session()->flash('message',
            'Vous suivez maintenant le profil de ' . $userFollowed->firstname . ' ' . $userFollowed->name);
        return redirect()->route('other-profil', ['slug' => $slug]);
    }

    public function unFollowUser($slug)
    {
        $userFollowed = User::findBySlugOrFail($slug);
        $userFollowing = Auth::user();

        foreach ($userFollowing->followings as $following)
            if ($following->id !== $userFollowed->id) {
                return redirect()->route('other-profil', ['slug' => $slug]);
            }

        $userFollowed->followers()->detach($userFollowing->id);
        session()->flash('message',
            'Vous ne suivez plus le profil de ' . $userFollowed->firstname . ' ' . $userFollowed->name);

        return redirect()->route('other-profil', ['slug' => $slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follow $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follow $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Follow $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        //
    }
}
