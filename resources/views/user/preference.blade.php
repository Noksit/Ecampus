@extends('layouts.layout')


@section('contenu')
    <!-- Barre de naviguation -->
    <div class="container-fluid">
        @include('components.navBar.config')
    </div>

    <!-- CONTENU -->
    <div class="container-fluid p-4 bg-light shadow">
        <h3 class="text-center">
           Votre compte : Gestion des préférences personnelles
        </h3>
    </div>
    <div class="container-fluid conteneur_config mt-5">
        <div class="row ">
            <div class="col-lg-9 col-12 ">
                <!-- DEBUT VOS PREFERENCES -->
                <div class="row">
                    <div class="col-md-10   ">
                        <p class="title text-center">Connexion et sécurité</p>
                    </div>
                    <div class="col-md-10    ">
                        <p class="title text-center"> Informations personnelles et confidentialité</p>
                    </div>
                    <div class="col-md-10   ">
                        <p class="title text-center ">Préférences de compte</p>
                    </div>
                </div>
                <!--FIN DE VOS PREFERENCES -->
            </div>
        </div>
    </div>

@endsection
