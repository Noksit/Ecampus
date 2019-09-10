@extends('layouts.layout')
@section('contenu')
    <link rel="stylesheet" href="{{URL::asset('css/panier.css')}}">



    <div class="container" id="conteneur_bandeau_panier">
        <div class="row">
            <div class="col-md-12">
                <p>VOTRE PANIER</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="container_panier">
                <p>0 article dans votre panier</p>
            </div>
            <div class="col-md-12 text-center pb-5" id="box_list_panier">
                <img src="{{asset('images/achat.png')}}" alt="Votre panier">

                <br>
                <p>Votre panier est vide . Continuez vos achats et trouvez un cour !</p>
                <br>
                <a class="btn" href="{{URL::asset('/')}}">Continuer vos achats</a>
            </div>
        </div>
    </div>
@endsection