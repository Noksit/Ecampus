@extends('layouts.layout')

@section('contenu')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <img class="border border-info img-fluid shadow rounded-circle" src="{{asset($user->imgprofil)}}"
                 alt="Image de profil" style="with:180px; height:180px;">
        </div>

        <div class="row mt-2">
            <div class="col-md-12 text-center">
                <p class="font-weight-bold">
                    {{ $user->name }} {{ $user->firstname }}<br>
                    @if($user->id !== Auth::id())
                        <a href="{{URL::route('user-profil-message')}}"><i class="far fa-envelope-open"
                                                                           style="font-size: 1.1em; margin:0 5px;"></i>
                            <span class="small text-primary">Contactez {{ $user->firstname }} par message</span>
                        </a>
                        -
                    @endif
                    <span class="text-secondary small">Inscrit depuis le {{ $user->created_at->format('d.M.Y') }}</span>

                </p>
                <p class="text-secondary">
                    @if($user->description ==null)
                        L'utilisateur n'a pas ajouté de description pour l'instant...
                    @else
                        {{ $user->description }}
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid border mt-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-1 text-primary text-center border-right p-4">
                    <i class="far fa-comment-alt" style="font-size: 2em;"></i><br>
                    <span class="small">{{ $user->comment->count() }} com's</span>
                </div>
                <div class="col-md-1 text-danger text-center border-right p-4">
                    <i class="far fa-file" style="font-size: 2em;"></i><br>
                    <span class="small">{{ $user->post->count() }} posts</span>
                </div>
                <div class="col-md-1 text-success text-center border-right p-4">
                    <i class="far fa-clipboard" style="font-size: 2em;"></i><br>
                    <span class="small">{{ $user->tutorial->count() }} tutos</span>
                </div>

                @isset($userAuth)
                    <div class="col-md-3  text-center p-4">
                        @if($userAuth->subscription !== 1)
                            <a href="{{route('user-sub')}}" class="form-control col-12 btn btn-dark">S'abonnez!</a>
                        @else
                            <a href="{{route('user-unsub')}}" class="form-control col-12 btn btn-outline-dark">Se
                                désabonner</a>
                        @endif
                    </div>
                @endisset

                @empty($userAuth)
                    <div class="col-md-3 text-center p-4">
                        @if($user->follow > 0)
                            <a href="{{route('unfollow', ['slug' => $user->slug])}}"
                               class="form-control btn btn-danger">
                                Arrêter de suivre<br> {{$user->firstname}}
                            </a>
                        @else
                            <a href="{{route('follow', ['slug' => $user->slug])}}"
                               class="form-control btn btn-success">
                                Suivre
                            </a>
                        @endif
                    </div>
                @endempty


                <div class="col-md-5 offset-md-1 p-4">
                    @isset($userAuth)
                        @if($user->id == $userAuth->id)
                            <a href="{{URL::route('post-ajout')}}" class="btn btn-primary col-5 form-control">
                                Publiez un Post
                            </a>

                            <a href="{{URL::route('tuto-ajout')}}" class="btn btn-primary col-5 form-control">
                                Publier un Tutoriel
                            </a>
                        @endisset

                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- AFFICHAGE DES PUBLICATION SELON PL CONSULTE -->
    <div class="container mt-5 mb-5">
        @isset($userAuth)
            @foreach( $publications as $publication)
                @if ($publication->type == 'post')


                    <div class="col-md-8 offset-md-2 mt-4 mb-2">
                        <div id="list-liker" class="small rounded-top">
                            Like :
                            @foreach($publication->likes as $like)
                                <a href="{{ route('other-profil', [ 'slug' => $like->user->slug]) }}">{{$like->user->firstname}}</a> /
                            @endforeach
                        </div>
                        <div class="card shadow">
                            <div class="ribbon-{{ $publication->category->name }}">
                                <span>{{ $publication->category->name }}</span></div>

                            <div class="card-header text-right" style="padding:0;">
                                @if ($user->id == $userAuth->id)

                                    <a href="{{route('update-publication-post',['slug' => $publication->slug])}}">
        <span name="delete" style="color:#80A1C1;  margin-right: 10px;"><i
                    class="fas fa-pencil-alt"></i></span></a>

                                    <a href="{{route('publication-delete',['slug' => $publication->slug])}}">
        <span name="delete" style="color:#dc3545;  margin-right: 10px;"><i
                    class="fas fa-eraser"></i></span></a>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-3 img_profil justify-content-center">

                                    <img class="img-fluid rounded-circle shadow" style="margin:20px;"
                                         src="{{asset($user->imgprofil)}}" alt="Image de profil">
                                </div>
                                <div class="col-9">
                                    <div class="card-body">

                                        <div class="card-title font-weight-bold">{{ $publication->title }}</div>
                                        <div class="card-text small">{!! $publication->content !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <span class="float-left small">Ecrit le : {{ $publication->created_at->format('d/m/Y')}}</span>
                                <!-- List of members like this post -->

                                @if($publication->like == 0)
                                    <a href="{{ route('like',['slug' => $publication->slug]) }}"
                                       class="none-text-decoration" id="like-heart">
                                        <i class="far fa-heart"></i>
                                    </a>
                                @else
                                    <a href="{{ route('dislike', ['slug' => $publication->slug]) }}"
                                       class="none-text-decoration">
                                        <i class="fas fa-heart" style="color:red;"></i>
                                    </a>
                                @endif
                                    {{$publication->likes->count() }}
                                    &nbsp;&nbsp;

                                <a href="#" data-toggle="modal"
                                   data-target="#exampleModal{{ $publication->id }}"><i
                                            class="far fa-comment"></i></a>
                                {{ $publication->comment->count() }}
                                @include('components.Modal.comment')

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-8 offset-md-2 mt-4 mb-2 text-center">
                        <div class="card shadow">
                            <div class="ribbon-{{ $publication->category->name }}">
                                <span>{{ $publication->category->name }}</span></div>
                            <div class="card-header text-right" style="padding:0;">
                                @if ($user->id == $userAuth->id)
                                    <a href="{{route('update-publication-tutorial',['slug' => $publication->slug])}}">
        <span name="delete" style="color:#80A1C1;  margin-right: 10px;"><i
                    class="fas fa-pencil-alt"></i></span></a>
                                    <a href="{{route('publication-delete',['slug' => $publication->slug])}}">
        <span name="delete" style="color:#dc3545;  margin-right: 10px;"><i
                    class="fas fa-eraser"></i></span></a>
                                @endif
                            </div>
                            <img class="card-img-top img-fluid"
                                 src="{{asset('/storage/imgpublication-crop/'.$publication->imgpublication)}}"
                                 alt="Image card top" style="height: 220px;">
                            <div class="card-body">
                                <!--Social shares button-->
                                <p class="text-success">
                                    @if( $publication->price == '0')
                                        Tutoriel gratuit
                                    @else
                                        En vente pour seulement <b>{{ $publication->price }}€</b>
                                    @endif
                                </p>
                                <h3 class="card-title">
                                    {{ $publication->title }}
                                </h3>


                                <p class="card-text small"
                                   id="affichage_post">{{ $publication->description }}</p>
                            </div>
                            <div class="card-footer small">
                                <span class="float-left"> Ecrit le : {{ $publication->created_at->format('d/m/Y') }}</span>
                                <a href="{{route('front-tutorial',['slug' => $publication->slug])}}"
                                   class="btn btn-light float-right">Lire <i
                                            class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endisset

    <!-- AFFICHAGE POUR UN PROFIL DIFFERENT DE L'UTILISATEUR IDENTIFIE-->
        @empty($userAuth)
            @foreach( $publications as $publication)
                @if ($publication->type == 'post')


                    <div class="col-md-8 offset-md-2 mt-3 mb-2">
                        <div id="list-liker" class="small rounded-top">
                            Like :
                            @foreach($publication->likes as $like)
                                <a href="{{ route('other-profil', [ 'slug' => $like->user->slug]) }}">{{$like->user->firstname}}</a> /
                            @endforeach
                        </div>

                        <div class="card shadow">
                            <div class="ribbon-{{ $publication->category->name }}">
                                <span>{{ $publication->category->name }}</span></div>


                            <div class="row">
                                <div class="col-3 img_profil justify-content-center">

                                    <img class="img-fluid rounded-circle shadow" style="margin:20px;"
                                         src="{{asset($user->imgprofil)}}" alt="Image de profil">
                                </div>
                                <div class="col-9">
                                    <div class="card-body">

                                        <div class="card-title font-weight-bold">{{ $publication->title }}</div>
                                        <div class="card-text small">{!! $publication->content !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <span class="float-left small">Ecrit le : {{ $publication->created_at->format('d/m/Y')}}</span>

                                @if($publication->like == 0)
                                    <a href="{{ route('like',['slug' => $publication->slug]) }}"
                                       class="none-text-decoration" id="like-heart">

                                        <i class="far fa-heart"></i>
                                    </a>

                                @else
                                    <a href="{{ route('dislike', ['slug' => $publication->slug]) }}"
                                       class="none-text-decoration">
                                        <i class="fas fa-heart" style="color:red;"></i>
                                    </a>
                                @endif

                                    {{ $publication->likes_count }}
                                    &nbsp;&nbsp;
                                <a href="#" data-toggle="modal"
                                   data-target="#exampleModal{{ $publication->id }}"><i
                                            class="far fa-comment"></i></a>
                                {{ $publication->comment->count() }}
                                @include('components.Modal.comment')

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-8 offset-md-2 mt-3 mb-2 text-center">
                        <div class="card shadow">
                            <div class="ribbon-{{ $publication->category->name }}">
                                <span>{{ $publication->category->name }}</span></div>
                            <img class="card-img-top img-fluid"
                                 src="{{asset('/storage/imgpublication-crop/'.$publication->imgpublication)}}"
                                 alt="Image card top" style="height: 220px;">
                            <div class="card-body">
                                <!--Social shares button-->
                                <p class="text-success">
                                    @if( $publication->price == '0')
                                        Tutoriel gratuit
                                    @else
                                        En vente pour seulement <b>{{ $publication->price }}€</b>
                                    @endif
                                </p>
                                <h3 class="card-title">
                                    {{ $publication->title }}
                                </h3>


                                <p class="card-text small"
                                   id="affichage_post">{{ $publication->description }}</p>
                            </div>
                            <div class="card-footer small">
                                <span class="float-left"> Ecrit le : {{ $publication->created_at->format('d/m/Y') }}</span>
                                <a href="{{route('front-tutorial',['slug' => $publication->slug])}}"
                                   class="btn btn-light float-right">Lire <i
                                            class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endempty
    </div>

@endsection
