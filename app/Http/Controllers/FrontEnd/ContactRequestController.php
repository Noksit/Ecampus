<?php

namespace App\Http\Controllers\FrontEnd;

use App\ContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContactRequestController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $user = Auth::user();

        $request->validate([
            'title' => 'required|max:160',
            'content' => 'required|max:360'
        ]);

        $inputs = $request->all();
        $inputs['user_id'] = $user->id;


        ContactRequest::create($inputs);

        session()->flash('message', 'Votre requête a bien été soumise à notre équipe !');
        return redirect()->route('front-index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactRequest  $contactRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactRequest  $contactRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactRequest  $contactRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactRequest  $contactRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactRequest $contactRequest)
    {
        //
    }
}
