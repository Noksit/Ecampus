<?php

namespace App\Http\Controllers\FrontEnd;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
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



    public function store(Request $request, $slug)
    {
        //

        $user = Auth::user();
        $publication = Publication::findBySlugOrFail($slug);

        $request->validate([
            'content' => 'required|max:360',
        ]);

        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['publication_id'] = $publication->id;

        Comment::create($inputs);

        return back()->with('message', 'Votre commentaire a bien été ajouté !');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
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
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function softDelete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('message', 'Votre commentaire a bien été supprimé !');
    }

}
