<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Publication;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TutorialController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $tutoriels = Publication::where('type', '=', 'tutorial')->get();

        return view('admin.publications.tutorial.index', ['user' => $user, 'tutoriels' => $tutoriels]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.publications.tutorial.create', ['categories' => $categories]);
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
        return redirect()->route('admin.tutorials.index');
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

        return view('admin.publications.tutorial.edit', [
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
            'required' => 'string|max:191|nullable',
            'goals' => 'string|max:191|nullable',
            'content' => 'required'
        ]);


        $publication->update($validateData);

        return redirect()->route('administration')->with('message', 'Modification effectuée');
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



