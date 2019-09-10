@extends('layouts.layout')@section('contenu')
    <!-- CONTENU -->
    <div class="container-fluid">
        @include('components.navBar.config')
    </div>
    <div class="container-fluid p-4 bg-light shadow">
        <h3 class="text-center">
            Votre messagerie : Envoyer/Recevoir des messages
        </h3>
    </div>
    <div class="container-fluid conteneur_config mt-5">
        <div class="row ">
            <div class="col-md-2 text-center list-group">
                <!-- Debut de la messagerie -->
            @include('conversation.users')
            <!--****************  FIN DE MESSAGERIE   ************************************************** -->
            </div>
        </div>
    </div>
@endsection