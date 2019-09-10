@extends('layouts.layout')

@section('contenu')
    <!-- CONTENU -->
    <div class="container-fluid bandeau-sombre">
        <div class="container pt-4 pb-4">
            <div class="row">
                <div class="col-md-12 p-3">
                    <h1>Liste des catégories {e}Campus </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row justify-content-center">
        <ul class="p-0">
            @foreach($categories as $category)
                <a href="{{ URL::route('listing-categorie') }}/{{ $category->name }}">
                    <li class="bg-light w-100 mt-3 p-3 text-center shadow">VOIR LES TUTORIELS DE LA CATEGORIE : <b>{{$category->name}}</b></li>
                </a>
            @endforeach
        </ul>
        </div>
    </div>

    <!-- FIN DU CONTENU-->
@endsection