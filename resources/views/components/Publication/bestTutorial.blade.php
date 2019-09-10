

    <div class="col-md-12 bg-light text-secondary shadow p-4 rounded">
        <div class="row">
            <div class="col-md-8">
                <h2 class="font-weight-bold">
                    {{ $bestTutorial->title }}
                </h2>
                <p>
                    {{ $bestTutorial->description }}
                </p>
                <span class="font-weight-bold text-success">
               @if($bestTutorial->price == '0')
                        Gratuit
                    @else
                        Disponible pour seulement {{ $bestTutorial->price }} €
                    @endif
            </span>
                <p class="small">
                    Proposé par :
                    <a class="link_bandeau text-secondary"
                       href="{{route('other-profil',['slug' => $bestTutorial->user->slug])}}">{{ $bestTutorial->user->name }} {{ $bestTutorial->user->firstname }}</a>
                </p>

                <a href="{{route('front-tutorial',['slug' => $bestTutorial->slug])}}">
                    <button class="bg-info text-light border-0 rounded mt-3 ml-1 p-2">Découvrir le tutoriel</button>
                </a>
            </div>

            <div class="col-md-4 text-right">
                <img class="img_bandeau" src="{{asset('storage/imgpublication-resize/'.$bestTutorial->imgpublication)}}" alt="Image de l'article">
            </div>

        </div>
    </div>
