<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Profil;
use App\Publication;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userAuth = Auth::user();
        $userId = Auth::id();
        $userAuth->load('publication');
        $publications = Publication::where('user_id', $userAuth->id)
            ->with('category')
            ->with(['likes' => function ($query){
                $query->with('user');
            }])
            ->withCount(['likes as like' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->latest()
            ->get();


        $user = $userAuth;
        return view('user.index', [
            'user' => $user,
            'userAuth' => $userAuth,
            'publications' => $publications
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
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function otherprofil($slug)
    {
        $user = Auth::user();
        $userId = $user->id;

        $otherId = User::findBySlugOrFail($slug)->id;
        $publications = Publication::where('user_id', $otherId)
            ->with('category')
            ->withCount(['likes as like' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->withCount('likes')
            ->latest()
            ->get();


        $otherUser = User::where('slug', $slug)
            ->withCount(['followers as follow' => function ($query) use ($userId) {
                $query->where('user_id_following', $userId);
            }])->firstOrFail();

        if ($userId === $otherUser->id) {
            return redirect()->route('user-profil');
        }

        return view('user.index', ['user' => $otherUser, 'userFollowing' => $user, 'publications' => $publications]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userAuth = Auth::user();
        $user = $userAuth;

        return view('user.edit', ['user' => $user, 'userAuth' => $userAuth]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * todo coinfirmation de mot de passe pour changement =)
     */
    public function update(Request $request)
    {
        if ($request->has('description')) {
            $validateData = $request->validate([
                'description' => 'string|nullable',
            ]);
            Auth::user()->update($validateData);
        }

        if ($request->has(['name', 'firstname', 'paypal', 'email', 'birthday'])) {

            $validateData = $request->validate([
                'name' => 'string|max:50',
                'firstname' => 'string|max:50',
                'email' => 'string|email|max:255',
                'paypal' => 'string|max:200|nullable',
                'birthday' => 'date|nullable',
            ]);
            $validateData['name'] = ucfirst($validateData['name']);
            $validateData['firstname'] = ucfirst($validateData['firstname']);

            Auth::user()->update($validateData);
        }

        if ($request->hasFile('avatar')) {

            if ($request->file('avatar')->isValid()) {
                $user = Auth::user();

                // open an image file
                $img = Image::make($request->avatar->path());

                // True colors

                $img->limitColors(null);

                // Resize 300x300

                $img->resize(300, 300, function ($constraint) {

                    $constraint->aspectRatio();

                });

                // Blank background if canvas

                $img->resizeCanvas(290, 300, 'center', false, '#ffffff');

                // je force la photo en jpg
                $img->stream('jpg', 90);


                //je lenregistre dans public / img-user de notre storage
                Storage::disk('public')->put('img-user/' . $img->filename . '.jpg', $img);

                // MAJ user
                $user->imgprofil = 'storage/img-user/' . $img->filename . '.jpg';
                $user->save();


            }

        }
        return redirect()->route('user-profil-infos');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preference()
    {
        $userAuth = Auth::user();
        $user = $userAuth;

        return view('user.preference', ['user' => $user, 'userAuth' => $userAuth]);
    }


    /**
     * ABONNEMENT
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscription()
    {
        $user = Auth::user();
        $user->subscription = 1;
        $user->save();


        session()->flash('message', 'Bravo, Vous êtes maintenant abonné');
        return redirect()->route('user-profil');
    }

    /**
     * DESABONNEMENT
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscription()
    {
        $user = Auth::user();
        $user->subscription = 0;
        $user->save();

        session()->flash('message', 'Votre abonnement a été désactivé');
        return redirect()->route('user-profil');
    }
}
