<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Publication;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoriesList()
    {
        $user = Auth::user();
        $categories = Category::with('post')->get();
        return view('publication.categoryList', ['categories' => $categories, 'user' => $user]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {

        $category = Category::where('name', $name)->firstOrFail();

        $bestTutorial = Publication::tuto()->where('category_id', $category->id)->first();

        $bestsTutorials = Publication::tuto()->where('category_id', $category->id)->limit(4)->get();

        $lastTutorials = Publication::tuto()->where('category_id', $category->id)->latest()->limit(8)->get();


        return view('publication.show', [
            'category' => $category,
            'bestTutorial' => $bestTutorial,
            'bestsTutorials' => $bestsTutorials,
            'lastTutorials' => $lastTutorials
        ]);
    }

    public function showByCategory($name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $tutorials = Publication::with('category', 'user', 'consultation')
            ->withCount('comment')
            ->tuto()
            ->where('category_id', $category->id)
            ->paginate();

        return view('publication.showByCategory', [
            'category' => $category,
            'tutorials' => $tutorials
        ]);
    }


    /**
     * Show publication page
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function index()
    {
        if (request()->has('price')) {

            if (request('price') === 'asc') {
                $tutorials = Publication::with('category', 'user', 'consultation')
                    ->withCount('comment')
                    ->tuto()
                    ->orderBy('price', 'asc')
                    ->paginate();
            } elseif (request('price') === 'desc') {

                $tutorials = Publication::with('category', 'user', 'consultation')
                    ->withCount('comment')
                    ->tuto()
                    ->orderBy('price', 'desc')
                    ->paginate();
            }
        } else {
            $tutorials = Publication::with('category', 'user', 'consultation')
                ->withCount('comment')
                ->tuto()
                ->paginate();
        }
        return view('publication.index', ['tutorials' => $tutorials]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function softDelete($slug)
    {
        $publication = Publication::findBySlugOrFail($slug);
        $publication->delete();

        session()->flash('message', 'Votre publication a bien été supprimée !');

        return redirect()->route('user-profil');
    }


}
