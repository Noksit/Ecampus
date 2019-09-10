<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $posts = Publication::where('type', '=', 'post')->get();

        return view('admin.publications.post.index', ['user' => $user, 'posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.publications.post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        preg_match_all('!(<img[^>]*src="([^"]*)")!', $request['content'], $tableauDImg);

        foreach ($tableauDImg['1'] as $i) {
            $request['content'] = htmlspecialchars_decode(str_replace($i, $i . ' class="img-fluid"', $request['content']));
        }

        $user = Auth::user();

        $this->validate($request, [
            'category_id' => 'required|numeric',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;

        Publication::create($inputs);

        //Un petit message de succés ...
        session()->flash('message', 'Votre post a bien été créé !');

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        $user = Auth::user();
        $user->load('roles');

        $categories = Category::all();
        $publication->with('user')
            ->firstOrFail();
        $decodeContent = html_entity_decode($publication->content);

        return view('admin.publications.post.edit', [
            'user' => $user,
            'publication' => $publication,
            'categories' => $categories,
            'decodeContent' => $decodeContent
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        {
            $inputs['imgpublication'] = $publication->imgpublication;
            $inputs = $request->all();

            $validateData = $request->validate([
                'category_id' => 'integer',
                'title' => 'string|max:191',
                'content' => 'required'
            ]);

            $publication->update($validateData);

            return redirect()->route('administration')->with('message', 'Modification effectuée');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('administration')->with('message', 'Publication supprimée');
    }
}



