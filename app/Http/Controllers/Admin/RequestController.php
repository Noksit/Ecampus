<?php

namespace App\Http\Controllers\Admin;

use App\ContactRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mail;

class RequestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $contactRequests = ContactRequest::all();

        return view('admin.requests.index', [
            'user' => $user,
            'contactRequests' => $contactRequests
        ]);
    }

    public function email($contactRequest)
    {
        $contactRequestFocus = ContactRequest::findOrFail($contactRequest);
        $user = $contactRequestFocus->user->firstname;

       Mail::send('admin.requests.email', ['username' => $user], function($message){
           $message->to('baptiste.anthony07@gmail.com');
       });

        $contactRequestFocus->delete();

        return back()->with('message', 'Un email à été envoyé à l\'adresse de votre contact !');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}


