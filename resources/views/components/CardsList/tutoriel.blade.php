@foreach($tutos as $tuto)
    <div class="col-sm-6 col-md-4 mb-3">

        <div class="card shadow" style="height:410px;">
            <div class="ribbon-{{$tuto->category->name}}">
                <span>
                    {{$tuto->category->name}}
                </span>
            </div>
            <a href="{{route('front-tutorial',['slug' => $tuto->slug])}}">

                <img class="card-img-top" src="{{asset('storage/imgpublication-crop/'.$tuto->imgpublication)}}"
                     alt="{{$tuto->image}}">
            </a>
            <div class="card-body">
                <div class="row">
                    <p class="card-title font-weight-bold col-8">
                        {{$tuto->title}}
                    </p>
                    <span class="card-title col-4 text-right font-weight-bold text-success small">
                        @if( $tuto->price == '0')
                            Gratuit
                        @else
                            {{ $tuto->price }} €
                        @endif
                    </span>
                </div>
                <p class="card-text small">
                    {{ str_limit($tuto->description, $limit = 150, $end = '...') }}
                </p>
            </div>
            <div class="card-footer">
                <a href="{{route('other-profil',['slug' => $tuto->user->slug])}}"><span
                            class="float-left">{{ $tuto->user->name }} {{ $tuto->user->firstname }}</span></a>
                <br>
                <span class="small">Ecrit à {{ $tuto->created_at->format('h:m \l\e d/m/Y') }}</span>
                <a href="{{route('front-tutorial',['slug' => $tuto->slug])}}" class="btn btn-light float-right">Lire <i
                            class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

@endforeach