<?php

namespace App\Http\Controllers;


use App\Comment;
use App\ContactRequest;
use App\Publication;
use App\User;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $users = User::all()->count();
        $tutoriels= Publication::where('type','tutorial')->get()->count();
        $posts= Publication::where('type','post')->get()->count();
        $comments = Comment::all()->count();
        $contactRequest = ContactRequest::all()->count();

        return view('admin.index',
                ['user' => $user,
                'users' =>$users,
                'tutoriels' => $tutoriels,
                'posts' => $posts,
                'comments' => $comments,
                'contactRequest' => $contactRequest]);

    }

}
