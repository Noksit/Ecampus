@extends('layouts.layout')
@section('contenu')
    <link rel="stylesheet" href="{{URL::asset('css/contact.css')}}">

    <div id="bandeau_contact" class="shadow">
        <div class="container text-center text-light" id="content_contact">
            <h1>Contact E-Campus</h1>
            <span>Envoyez nous un message directement</span>
        </div>
    </div>

    <!-- CONTENU -->
    <div class="container text-center mt-5">

            <h3>Envoyer une requête à notre équipe ...</h3>

            <form action="{{route('contact-request')}}" method="POST" name="formulaire_contact" class="mt-4 mb-5">
                @csrf
                    <input class="form-control bg-light" type="text" name="title"  placeholder="Objet de votre requête" />
                    <textarea class="form-control bg-light mt-2" rows="7" name="content" placeholder="Contenu de votre requête"></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Envoyer ma requête</button>
            </form>

    </div>
@endsection