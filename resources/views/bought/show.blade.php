@extends('layouts.layout')

@section('contenu')
    @if($user->postsBought->count() > 0)

        <div class="container-fluid bandeau-sombre">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt-4">
                        <p>
                            <a href="{{URL::route('front-index')}}"><i class="fas fa-home" style="color:#fff;"></i></a>
                            -
                            <a href="{{URL::route('user-profil-category-bought')}}">Catégorie</a>
                            /<a href="{{URL::route('user-profil-all-category-bought', ['name'=> $category->name])}}">
                                {{ $category->name }}
                            </a>
                            / Tous
                        </p>
                        <h1 class="mb-5">LISTE DES TUTORIELS DE LA CATEGORIE : {{ $category->name }}</h1>
                    </div>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{URL::route('user-profil-category-bought')}}">
                            <li class="breadcrumb-item mr-3">Liste des catégories</li>
                        </a>
                        <a href="{{URL::route('user-profil-bought')}}">
                            <li class="breadcrumb-item  mr-3 ml-5" aria-current="page">Tous les tutoriels</li>
                        </a>
                    </ol>
                </nav>

            </div>
        </div>

        <div class="container bg-light mt-4 p-2">
            <div class="container bg-light mt-4 p-2">
                <div class="row">
                    <div class="col-10">
                        <h2>Tous les tutoriels de la catégorie : {{ $category->name }}</h2>
                    </div>
                    <div class="col-2 text-center mt-2">
                        <a class="m-1" href="{{URL::route('user-profil-all-category-bought', ['name'=> $category->name])}}/?price=asc"><i
                                    class="fas fa-sort-numeric-down"></i></a>
                        <a class="m-1" href="{{URL::route('user-profil-all-category-bought', ['name'=> $category->name])}}/?price=desc"><i
                                    class="fas fa-sort-numeric-up"></i></a>
                        <a class="m-1" href="{{URL::route('user-profil-all-category-bought', ['name'=> $category->name])}}/?"><i class="fas fa-history"></i></a>
                    </div>
                </div>


            </div>
        </div>
        <div class="container mt-5 mb-5">
            @foreach ($user->postsBought as $tutorial)

                <div class="col-md-12 rounded mt-5 mb-5">
                    <div class="ribbon"><span>{{ $tutorial->category->name }}</span></div>
                    <div class="row">
                        <div class="col-md-3 p-0">
                            <a href="{{route('front-tutorial',['slug' => $tutorial->slug])}}">
                                <img src="{{asset('storage/'.$tutorial->imgpublication)}}" alt="Image du tutoriel"
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
                                    <a href="{{route('front-tutorial',['slug' => $tutorial->slug])}}"
                                       class="btn btn-info">Visionner</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    @endif
    @if($user->postsBought->count() == 0)
        <div class="container-fluid bandeau-sombre">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt-5 pb-5 text-center">
                        <p>VOUS N'AVEZ AUCUN TUTORIEL POUR LA CATEGORIE : <b> {{ $category->name }} </b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @include('components.404.waitpage')
        </div>
    @endif



    <!-- FIN CONTENU -->
@endsection

