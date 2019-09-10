@extends('layouts.layout')

@section('contenu')
    <div class="container-fluid bandeau-sombre">
        <div class="row bg-dark p-2 text-center">

            <div class="col-md-12">
                <h1 class="m-5">RESULTAT DE VOTRE RECHERCHE</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        @foreach ($tutorials as $tutorial)

            <div class="col-md-12 rounded mt-5 mb-5">
                <div class="ribbon-{{ $tutorial->category->name }}"><span>{{ $tutorial->category->name }}</span></div>
                <div class="row">
                    <div class="col-md-3 p-0">
                        <a href="{{route('front-tutorial',['slug' => $tutorial->slug])}}">
                            <img src="{{asset('storage/imgpublication-resize/'.$tutorial->imgpublication)}}" alt="Image du tutoriel"
                                 style="width: 280px; height: 170px;" class="shadow">
                        </a>
                    </div>

                    <div class="col-md-9 pl-5">
                        <div class="row">
                            <div class="col-md-9 mt-3">
                                <h2>{{ $tutorial->title }}</h2>
                                <p class="font-weight-bold p-2 bg-light">{{ $tutorial->description }}</p>
                                <p class="small">
                                    Proposé par
                                    <a href="{{ route('user-profil', ['slug' => $tutorial->user->slug ])}}"
                                       class="link_to_card">
                                        {{ $tutorial->user->name }} {{ $tutorial->user->firstname }}
                                    </a>
                                    <br>
                                    Partagé le {{ $tutorial->created_at->format('d.m.Y') }}</p>
                            </div>
                            <div class="col-md-3 border-left">
                                <p class="text-success lead">
                                    @if( $tutorial->price == '0')
                                        Tutoriel gratuit
                                    @else
                                        {{ $tutorial->price }}<b>€</b>
                                    @endif
                                </p>
                                <p><i class="far fa-edit"></i> {{ $tutorial->comment_count }} commentaire(s)</p>
                                <p><i class="far fa-user-circle"></i>
                                    @if($tutorial->consultation == null)
                                        <em>Auncun visionnage</em>
                                    @else
                                        {{ $tutorial->consultation->occurrences }} visionnages
                                    @endif
                                </p>
                                <a href="{{route('front-tutorial',['slug' => $tutorial->slug])}}" class="btn btn-info">
                                    @if($tutorial->price == '0')
                                        Visionner
                                    @else
                                        Acheter
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
    <!-- FIN CONTENU -->
@endsection


