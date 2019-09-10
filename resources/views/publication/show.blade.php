@extends('layouts.layout')

@section('contenu')

    @isset ($bestTutorial)

        <div class="container-fluid bandeau-sombre">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt-4">
                        <p>
                            <a href="{{URL::route('front-index')}}"><i class="fas fa-home" style="color:#fff;"></i></a>
                            <a href="{{URL::route('listing-categorie')}}">Catégorie</a>
                            /&nbsp;{{ $category->name }}
                        </p>
                        <h1>TUTORIELS {{ $category->name }}</h1>
                    </div>


                    <ol class="breadcrumb">
                        <a href="{{URL::route('listing-categorie')}}">
                            <li class="breadcrumb-item active mr-3" aria-current="page">Sélection</li>
                        </a>
                        <a href="{{ route('listing-all-categorie', ['name' => $category->name]) }}">
                            <li class="breadcrumb-item">Tous les tutoriels de la catégorie</li>
                        </a>
                        <a href="{{URL::route('listing-all')}}">
                            <li class="breadcrumb-item text-right ml-5" aria-current="page">Tous les tutoriels</li>
                        </a>
                    </ol>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="mt-5">
                <div class="row">
                    @include('components.Publication.bestTutorial')
                </div>

                <div class="row mt-5">
                    <div class="col-md-11">
                        <h3 class="border-bottom">Meilleurs tutoriels de la catégorie : <b>{{ $category->name }}</b>
                        </h3>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('listing-all-categorie', ['name' => $category->name]) }}"
                           class="bg-info text-light p-2 rounded link_bandeau"> Voir tout </a>
                    </div>
                </div>
                <!-- On place nos cards -->

                <div class="row mt-3">
                    @include('components.Publication.bestTutorials')
                </div>

                <!-- Derniers Posts-->
                <div class="row mt-5">
                    <div class="col-md-11">
                        <p class="border-bottom">Derniers posts de la catégorie : <b>{{ $category->name }}</b></p>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('listing-all-categorie', ['name' => $category->name]) }}"
                           class="bg-info text-light p-2 rounded link_bandeau"> Voir tout </a>
                    </div>
                </div>
                <!-- On place nos cards -->
                <div class="row">
                    @include('components.Publication.lastTutorials')
                </div>

                <!-- FIN placement des posts -->


            </div>

        </div>

    @endisset

    @empty($bestTutorial)
        <div class="container-fluid bandeau-sombre">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 pt-5 pb-5 text-center">
                        <p>AUCUN TUTORIEL DISPONIBLE POUR LA CATEGORIE : <b> {{ $category->name }} </b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @include('components.404.waitpage')
        </div>
    @endempty


@endsection

