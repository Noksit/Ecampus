<?php

namespace App\Http\Controllers\FrontEnd;

use App\Bought;
use App\Category;
use App\Consultation;
use App\Publication;
use App\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TutorialController extends Controller
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
        $user = Auth::user();
        $categories = Category::all();
        return view('publication.tutorial.create', ['categories' => $categories, 'user' => $user]);
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
            $request['content'] = htmlspecialchars_decode(str_replace($i,
                $i . ' class="img-fluid"',
                $request['content']));
        }

        $user = Auth::user();
        $slug = $user->slug;

        $request->validate([
            'category_id' => 'required|numeric',
            'title' => 'required|max:150',
            'description' => 'max:255',
            'imgpublication' => 'mimetypes:image/gif,image/jpeg,image/png',
            'price' => 'integer|nullable',
            'required' => 'max:100',
            'goals' => 'max:100',
            'content' => 'required',
        ]);

        //Gestion d'image tutoriel

        $inputs = $request->all();
        if ($inputs['price'] == null) {
            $inputs['price'] = 0;
        }

        if ($request->hasFile('imgpublication')) {

            //$imgpublication = $request->file('imgpublication')->storePublicly('imgpublication', 'public');
            //$inputs['imgpublication'] = $imgpublication;
            $inputs['user_id'] = $user->id;

            // open an image file
            $imgResize = Image::make($request->imgpublication->path());
            $imgOrigin = Image::make($request->imgpublication->path());
            $imgCrop = Image::make($request->imgpublication->path());

            // True colors

            $imgResize->limitColors(null);

            // Resize 300x300

            $imgResize->resize(680, 380, function ($constraint) {

                $constraint->aspectRatio();

            });

            $imgCrop->crop(680, 380);

            // Blank background if canvas

            $imgResize->resizeCanvas(680, 380, 'center', false, '#fff');

            // je force la photo en jpg
            $imgResize->stream('jpg', 90);
            $imgOrigin->stream('jpg', 100);
            $imgCrop->stream('jpg', 100);


            //je lenregistre dans public / img-user de notre storage
            Storage::disk('public')->put('imgpublication-resize/' . $imgResize->filename . '.jpg', $imgResize);
            Storage::disk('public')->put('imgpublication-origin/' . $imgOrigin->filename . '.jpg', $imgOrigin);
            Storage::disk('public')->put('imgpublication-crop/' . $imgCrop->filename . '.jpg', $imgCrop);

            // MAJ request
            $inputs['imgpublication'] = $imgResize->filename . '.jpg';


            Publication::create($inputs);


        } else {

            $img = Publication::create($inputs);
            $img->imgpublication = $img->category->name . '.jpg';
            $img->save();

        }
        //Un petit message de succés ...
        session()->flash('message', 'Votre tutoriel a bien été créé !');
        return redirect()->route('user-profil', $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication $publication
     * @return \Illuminate\Http\Response
     */
    public function summary($slug)
    {
        $user = Auth::user();
        $userId = $user->id;
        $tuto = Publication::where('slug', $slug)
            ->with(['comment' => function ($query) {
                $query->with(['user' => function ($query) {
                    $query->with('comment');
                }]);
            }])
            ->withCount(['userOwner as bought' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->withCount(['consultation as seen' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->firstOrFail();

        $rateUser = Rating::where('publication_id', $tuto->id)
            ->where('user_id', $userId)
            ->first();

        $ratesPublication = Rating::where('publication_id', $tuto->id)->get();


        $rateGlobal = 0;

        foreach ($ratesPublication as $rate) {
            $rateGlobal += $rate->rate;
        }

        if ($ratesPublication->count() != 0) {
            $rateGlobal = $rateGlobal / $ratesPublication->count();
        }


        if ($userId !== $tuto->user->id) {
            $consultation = Consultation::updateOrCreate(['publication_id' => $tuto->id, 'user_id' => $userId]);
            Consultation::find($consultation->id)->increment('occurrences');
        }

        return view('publication.tutorial.summary',
            [
                'user' => $user,
                'tuto' => $tuto,
                'rateUser' => $rateUser,
                'ratesPublication' => $ratesPublication,
                'rateGlobal' => $rateGlobal
            ]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $publication = Publication::where('slug', $slug)
            ->with('user')
            ->firstOrFail();

        return view('publication.tutorial.show', ['publication' => $publication]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();
        $publication = Publication::where('slug', $slug)
            ->with('user')
            ->firstOrFail();
        $decodeContent = $publication->content ;



        return view('publication.tutorial.edit',
            ['publication' => $publication, 'categories' => $categories, 'decodeContent' => $decodeContent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Publication $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $publication = Publication::where('slug', $slug);

        if ($request->hasFile('imgpublication')) {

            // open an image file
            $imgResize = Image::make($request->imgpublication->path());
            $imgOrigin = Image::make($request->imgpublication->path());
            $imgCrop = Image::make($request->imgpublication->path());

            // True colors

            $imgResize->limitColors(null);

            // Resize 300x300

            $imgResize->resize(680, 380, function ($constraint) {

                $constraint->aspectRatio();

            });

            $imgCrop->crop(680, 380);

            // Blank background if canvas

            $imgResize->resizeCanvas(680, 380, 'center', false, '#fff');

            // je force la photo en jpg
            $imgResize->stream('jpg', 90);
            $imgOrigin->stream('jpg', 100);
            $imgCrop->stream('jpg', 100);


            //je lenregistre dans public / img-user de notre storage
            Storage::disk('public')->put('imgpublication-resize/' . $imgResize->filename . '.jpg', $imgResize);
            Storage::disk('public')->put('imgpublication-origin/' . $imgOrigin->filename . '.jpg', $imgOrigin);
            Storage::disk('public')->put('imgpublication-crop/' . $imgCrop->filename . '.jpg', $imgCrop);

            // MAJ request
            $inputs['imgpublication'] = $imgResize->filename . '.jpg';

            $publication->update($inputs);

        }

        $validateData = $request->validate([
            'category_id' => 'integer',
            'title' => 'string|max:191',
            'description' => 'max:255',
            'price' => 'integer',
            'required' => 'string|nullable|max:191',
            'goals' => 'string|nullable|max:191',
            'content' => 'required'
        ]);


        $publication->update($validateData);

        return redirect()->route('user-profil')->with('message', 'Modification effectuée !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buy($slug)
    {
        $publication = Publication::findBySlugOrFail($slug);
        $publicationId = $publication->id;
        $price = $publication->price;
        $userId = Auth::id();

        Bought::updateOrCreate(['user_id' => $userId, 'publi_id' => $publicationId, 'price' => $price]);

        return back();
    }

}
