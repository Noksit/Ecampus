<?php

namespace App\Http\Controllers\FrontEnd;

use App\Bought;
use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoughtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('price')) {

            if (request('price') === 'asc') {
                $user = User::where('id', Auth::id())
                    ->with(['postsBought' => function ($query) {
                        $query->withCount('comment')
                            ->tuto()
                            ->orderBy('price', 'asc');
                    }])
                    ->first();
                return view('bought.index', ['user' => $user]);


            } elseif (request('price') === 'desc') {
                $user = User::where('id', Auth::id())
                    ->with(['postsBought' => function ($query) {
                        $query->withCount('comment')
                            ->tuto()
                            ->orderBy('price', 'desc');
                    }])
                    ->first();
                return view('bought.index', ['user' => $user]);

            }
        } else {
            $user = User::where('id', Auth::id())
                ->with(['postsBought' => function ($query) {
                    $query->withCount('comment')
                        ->tuto();
                }])
                ->first();

            return view('bought.index', ['user' => $user]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryList()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('bought.categoryList', ['categories' => $categories, 'user' => $user]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bought $bought
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $category = Category::where('name', $name)->firstOrFail();

        if (request()->has('price')) {

            if (request('price') === 'asc') {
                $user = User::where('id', Auth::id())
                    ->with(['postsBought' => function ($query) use ($category) {
                        $query->where('category_id', $category->id)
                            ->withCount('comment')
                            ->tuto()
                            ->orderBy('price', 'asc');
                    }])
                    ->first();
                return view('bought.show', ['category' => $category, 'user' => $user]);

            } elseif (request('price') === 'desc') {
                $user = User::where('id', Auth::id())
                    ->with(['postsBought' => function ($query) use ($category) {
                        $query->where('category_id', $category->id)
                            ->withCount('comment')
                            ->tuto()
                            ->orderBy('price', 'desc');
                    }])
                    ->first();
                return view('bought.show', ['category' => $category, 'user' => $user]);

            }
        } else {
            $user = User::where('id', Auth::id())
                ->with(['postsBought' => function ($query) use ($category) {
                    $query->where('category_id', $category->id)
                        ->withCount('comment')
                        ->tuto();
                }])
                ->first();
            return view('bought.show', ['category' => $category, 'user' => $user]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bought $bought
     * @return \Illuminate\Http\Response
     */
    public function edit(Bought $bought)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Bought $bought
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bought $bought)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bought $bought
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bought $bought)
    {
        //
    }
}
