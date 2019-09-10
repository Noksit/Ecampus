<?php

namespace App\Http\Controllers\FrontEnd;

use App\Follow;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = Auth::user();
        $user = $userAuth;
        $userId = $user->id;

        $user->load('unreadMessage');


        $followings = Follow::Where('user_id_followed', $userId)
            ->with(['followers' => function ($query) use ($userId) {
                $query->with(['unreadMessageByUser' => function ($query) use ($userId) {
                    $query->where('to_user_id', $userId);
                }]);
            }])
            ->get();
        $followers = Follow::where('user_id_following', $userId)
            ->with(['followings' => function ($query) use ($userId) {
                $query->with(['unreadMessageByUser' => function ($query) use ($userId) {
                    $query->where('to_user_id', $userId);
                }]);
            }])
            ->get();

        return view('conversation.index', [
            'user' => $user,
            'userAuth' => $userAuth,
            'followings' => $followings,
            'followers' => $followers
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $user = Auth::user();
        $otherUser = User::findBySlugOrFail($slug);

        $request->validate([
            'content' => 'required|max:360',
        ]);

        $inputs = $request->all();
        $inputs['from_user_id'] = $user->id;
        $inputs['to_user_id'] = $otherUser->id;

        Message::create($inputs);

        return back()->with('message', 'Votre message a bien été envoyé !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $userAuth = Auth::user();

        $otherUser = User::findBySlugOrFail($slug);
        $otherUserId = $otherUser->id;
        $userId = $userAuth->id;
        $userAuth->load('unreadMessage');

        Message::findUnreadMessage($userId, $otherUserId)
            ->update(['read_at' => now()]);

        $followings = Follow::Where('user_id_followed', $userId)
            ->with(['followers' => function ($query) use ($userId) {
                $query->with(['unreadMessageByUser' => function ($query) use ($userId) {
                    $query->where('to_user_id', $userId);
                }]);
            }])
            ->get();
        $followers = Follow::where('user_id_following', $userId)
            ->with(['followings' => function ($query) use ($userId) {
                $query->with(['unreadMessageByUser' => function ($query) use ($userId) {
                    $query->where('to_user_id', $userId);
                }]);
            }])
            ->get();

        $messages = Message::findConversation($userId, $otherUserId)->paginate(20);

        return view('conversation.show', [
            'followers' => $followers,
            'followings' => $followings,
            'otherUser' => $otherUser,
            'user' => $userAuth,
            'messages' => $messages
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
