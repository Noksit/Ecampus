@extends('layouts.layout')

@section('contenu')
    <!-- CONTENU -->
    <div class="container-fluid bandeau-sombre pt-5 pb-5 shadow">
        <div class="container">
            <div class="row ">
                <div class="col-md-8">
                    <h1>
                        {{$tuto->title}} -
                        <b>
                            {{$tuto->Category->name}}
                        </b>
                    </h1>
                    <p>
                        {{$tuto->description}}
                    </p>
                    <p>
                        @if($rateGlobal != null)
                        Note du tutoriel <b>{{ round($rateGlobal,1) }} sur 5 </b>
                        <span class="small ml-2 bg-warning text-dark p-1"> {{ $ratesPublication->count() }} vote(s) au total</span>
                            @else
                            Ce tutoriel n'a jamais été noté
                        @endif
                    </p>
                    <p class="small">
                        Créé par {{ $tuto->user->name }} {{ $tuto->user->firstname }}
                        le {{ $tuto->created_at->format('d/m/Y \à\ h:m') }} -
                        Derniere mise à jour le {{ $tuto->updated_at->format('d/m/Y') }}
                    </p>
                    @isset( $tuto->consultation)
                        <p>
                            Ce tutoriel a été visionné
                            {{$tuto->consultation->occurrences}} fois
                        </p>
                    @endisset
                        @if(!$rateUser)
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#ratingModal">
                                Noter ce tutoriel !
                            </button>
                            @include('components.Publication.ratingModal')
                        @else
                            <p class="text-warning">Vous avez déja noté ce tutoriel en lui attribuant la note de : <b>{{ $rateUser->rate}}/5</b></p>
                        @endif

                </div>
                <div class="col-md-4">
                    <img class="img_bandeau" src="{{asset('storage/imgpublication-resize/'.$tuto->imgpublication)}}" alt="Image de l'article">
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <div class="p-2">
                    <h3 class="text-secondary bg-light p-3">Descriptif du tutoriel - <b>{{ $tuto->title }}</b></h3>
                    <p class="border-left p-2">{{$tuto->description}}</p>
                </div>
                <div class="m-2">
                    <h3 class="text-secondary bg-light p-3">Que vais-je apprendre dans ce tutoriel ?</h3>
                    <ul class="col-md-6 border-left p-2">
                        <li><i class="fas fa-check"></i> {{ $tuto->goals }}</li>
                    </ul>
                </div>

                <div class="m-2">
                    <h3 class="text-secondary bg-light p-3">Connaissances obligatoires</h3>
                    <ul class="col-md-6 border-left p-2">
                        <li><i class="fas fa-check"></i> {{ $tuto->required }}</li>
                    </ul>
                </div>

                <img class="img-fluid border mt-4" src="{{asset('images/bandeau_horizontal.gif')}}"
                     alt="Pub Horizontal">

                <div class="mt-5">
                    <h3 class="border-bottom text-center">Commentaire(s) de l'article</h3>
                    @foreach($tuto->comment as $comment)
                        <div class="col-md-12 bg-light rounded p-3 mt-2">
                            <div class="row">
                                <div class="col-md-1 text-right">
                                    <a href="{{route('other-profil', ['slug' =>$comment->user->slug])}}">
                                        <img class="w-100 rounded shadow" src="{{asset($comment->user->imgprofil)}}">
                                    </a>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p class="font-weight-bold">{{ $comment->user->name }}  {{ $comment->user->firstname }}
                                        <br>
                                        <span class="font-weight-light small">{{ $comment->created_at->format('d/m/Y \à\ H:i') }}</span>
                                    </p>
                                </div>
                                <div class="col-md-5 text-right">
                                    <p>
                                    @if($comment->user->id == Auth::user()->id)
                                            <a href="{{ URL::route('comment-delete', [ 'id' => $comment->id]) }}">
                                                <i class="fas fa-eraser text-danger"></i>
                                            </a>
                                    @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row ml-5 mt-2">
                                <p class="ml-5 small">{{ $comment->content }}</p>
                            </div>

                        </div>

                    @endforeach
                    <form action="{{ route('tutorial-comment', ['slug' => $tuto->slug]) }}" method="post" class="mb-5">
                        @csrf
                        <textarea name="content" id="content" class="form-control mt-2" rows="5"
                                  placeholder="Votre commentaire ici"></textarea>
                        <input type="submit" class="mt-2 btn btn-primary" value="Commenter">
                    </form>
                </div>
            </div>

            <!-- Descriptif tutoriel bandeau droite-->
            <div class="col-md-3 text-center">
                <p class="text-secondary bg-light p-3 ">Tutoriel certifié par l'E-Campus</p>

                @if($tuto->price == '0')
                    <p class="text-center text-success lead font-weight-bold"> Gratuit </p>
                    <a href="{{ URL::route('affiche-publication', ['slug' => $tuto->slug]) }}">
                        <button class="btn btn-success">Voir le tutoriel</button>
                    </a>
                @else
                    @if($tuto->bought > 0)
                        <p class="text-center text-success lead font-weight-bold"> Déjà Acheté </p>

                        <a href="{{ URL::route('affiche-publication', ['slug' => $tuto->slug]) }}">
                            <button class="btn btn-success">Voir le tutoriel</button>
                        </a>
                    @elseif($user->subscription === 1)
                        <p class="text-center text-success lead font-weight-bold"> Compte abonné ! </p>

                        <a href="{{ URL::route('affiche-publication', ['slug' => $tuto->slug]) }}">
                            <button class="btn btn-success">Voir le tutoriel</button>
                        </a>
                    @else
                        <p class="text-center text-success lead font-weight-bold">
                            <i class="fas fa-shopping-cart"></i>
                            {{ $tuto->price }} €
                        </p>
                        <a href="{{ URL::route('front-buy-tutorial', ['slug' => $tuto->slug]) }}">
                            <button class="btn btn-success">Acheter le tutoriel</button>
                        </a>
                    @endif
                @endif

                <div class="mt-4">
                    <p class="font-weight-bold border-bottom">A propos du formateur</p>

                    <div class="card border-0 pt-2">
                        <a href="{{route('other-profil',['slug' => $tuto->user->slug])}}">
                            <img class="img-fluid rounded-circle w50 shadow"
                                 src="{{asset($tuto->user->imgprofil)}}"
                                 alt="Image de profil">
                        </a>
                        <div class="card-body">
                            <div class="card-title">
                                <a class="btn" href="{{route('other-profil',['slug' => $tuto->user->slug])}}">
                                    {{ $tuto->user->name }} {{ $tuto->user->firstname }}
                                </a>
                            </div>
                            <p class="card-text small">
                                {{ $tuto->user->description }}
                            </p>
                            <p class="small border-top mt-2 pt-2">
                            <div class="row mt-3 mb-3">
                                <div class="text-info text-center col-4">
                                    <i class="far fa-comment-alt" style="font-size: 2em;"></i><br>
                                    <span class="small">{{ $tuto->user->comment->count() }} com's</span>
                                </div>
                                <div class="text-danger text-center col-4">
                                    <i class="far fa-file" style="font-size: 2em;"></i><br>
                                    <span class="small">{{ $tuto->user->post->count() }} posts</span>
                                </div>
                                <div class="text-success text-center col-4">
                                    <i class="far fa-clipboard" style="font-size: 2em;"></i><br>
                                    <span class="small">{{ $tuto->user->tutorial->count() }} tutos</span>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Descriptif tutoriel bandeau droite-->

        </div>
    </div>



    <!-- FIN CONTENU -->
@endsection
