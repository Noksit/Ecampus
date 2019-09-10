<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        $categories = Category::all();
        $user = Auth::user();
        return view('publication.post.create', ['categories' => $categories, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        preg_match_all('!(<img[^>]*src="([^"]*)")!', $request['content'], $tableauDImg);

        foreach ($tableauDImg['1'] as $i) {
            $request['content'] = htmlspecialchars_decode(str_replace($i,
                $i . ' class="img-fluid"',
                $request['content']));
        }

        $user = Auth::user();
        $slug = $user->slug;

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

        return redirect()->route('user-profil', $slug);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        //
    }


    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $publication = Publication::where('slug', $slug)
            ->with('user')
            ->firstOrFail();
        $decodeContent = $publication->content;


        return view('publication.post.edit',
            ['publication' => $publication, 'categories' => $categories, 'decodeContent' => $decodeContent]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $publication = Publication::where('slug', $slug);
        $validateData = $request->validate([
            'category_id' => 'integer',
            'title' => 'string|max:191',
            'content' => 'required'
        ]);

        $publication->update($validateData);

        return redirect()->route('user-profil')->with('message', 'Modification effectuée !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }

}
