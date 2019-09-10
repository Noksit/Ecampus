@foreach( $lastTutorials as $bestTutos)
    <div class="col-md-3 mt-3">
        <div class="card shadow" style="height: 350px;">
            <div class="card-header">
                <div class="row">
                    <div class="col-8 small">
                        <b>{{ $bestTutos->title }}</b>
                    </div>
                    <div class="col-4">
                        <p class="card-text small text-success text-right">
                            @if( $bestTutos->price == '0')
                                Gratuit
                            @else
                                {{ $bestTutos->price }} €
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <a class="link_to_card" href="{{route('front-tutorial',['slug' => $bestTutos->slug])}}">
                <img class="card-img-top" src="{{asset('storage/imgpublication-resize/'.$bestTutos->imgpublication)}}" alt="Card image cap" style="height: 130px">
            </a>
            <div class="card-body small">
                <p class="card-text small">
                    {{ str_limit($bestTutos->description, $limit = 150, $end = '...') }}
                </p>
            </div>
            <div class="card-footer small">
                <span class="small">
                    Partagé le {{ $bestTutos->created_at->format('d/m/Y') }}
                    par {{ $bestTutos->user->name }} {{ $bestTutos->user->firstname }}
                </span>
            </div>
        </div>
    </div>
@endforeach