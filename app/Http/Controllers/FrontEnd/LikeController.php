<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Like;
use App\Publication;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{

    public function store($slug){

        $inputs['user_id'] = Auth::id();
        $inputs['publication_id'] = Publication::findBySlugOrFail($slug)->id;

        Like::updateOrCreate($inputs);

        return back();
    }

    public function destroy($slug){

        $userId = Auth::id();
        $publicationId = Publication::findBySlugOrFail($slug)->id;

        Like::where('user_id',$userId)
            ->where('publication_id', $publicationId)
            ->delete();

        return back();
    }
}
