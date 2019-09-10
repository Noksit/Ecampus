@extends('layouts.layout')

@section('contenu')
    <link rel="stylesheet" href="{{URL::asset('css/equipe.css')}}">

    <div class="container content">
        <div class="col-md-12 text-center animated bounce" id="whoisit">
            <h1>Qui somme nous ?</h1>
        </div>
        <div class="row animated bounce">
            <div class="col-md-3 ">
                <div class="card text-center">
                    <div class="ribbon"><span>E-CAMPEUR</span></div>
                    <img class="img-fluid" src="{{URL::asset('images/Cards/Anzor.png')}}" alt="Profil d'Anzor">
                    <div class="card-body">
                        <h5 class="card-title" style="border-top: 2px solid #e5e5e5; padding-top: 8px;">Anzor Issaev</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="ribbon"><span>E-CAMPEUR</span></div>
                    <img class="img-fluid" src="{{URL::asset('images/Cards/Romaric.png')}}" alt="Profil de Romaric">
                    <div class="card-body">
                        <h5 class="card-title" style="border-top: 2px solid #e5e5e5; padding-top: 8px;">Romaric Gilson</h5>
                        <p class="card-text">"Ta gueule, c'est magique !" <br>Si je comprend pas, je fais pas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="ribbon"><span>E-CAMPEUR</span></div>
                    <img class="img-fluid" src="{{URL::asset('images/Cards/Damien.png')}}" alt="Profil de Damien">
                    <div class="card-body">
                        <h5 class="card-title" style="border-top: 2px solid #e5e5e5; padding-top: 8px;">Damien Thibault</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="ribbon"><span>E-CAMPEUR</span></div>
                    <img class="img-fluid" src="{{URL::asset('images/Cards/Anthony.png')}}" alt="Profil d'Anthony">
                    <div class="card-body">
                        <h5 class="card-title" style="border-top: 2px solid #e5e5e5; padding-top: 8px;">Anthony Baptiste</h5>
                        <p class="card-text">27 ans, passioné d'informatique et de développement ! Actuellement en formation d'analyste développeur !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bandeau-sombre pt-4 pb-4 mt-3 pb-3">
        <div class="container">
            <div class="col-md-12 text-center">
                <h2>E-campus en quelque chiffres..</h2>
            </div>
            <div class="row justify-content-center text-center mt-5">
                <div class="col-md-2">
                    <i class="fas fa-users" style="font-size: 3em; margin: 5px 0;"></i>
                    <h3>8510</h3>
                    <span>Inscrits</span>
                </div>
                <div class="col-md-2">
                    <i class="fas fa-graduation-cap" style="font-size: 3em; margin: 5px 0;"></i>
                    <h3>1023</h3>
                    <span>Formateurs</span>
                </div>
                <div class="col-md-2">
                    <i class="fab fa-wpforms" style="font-size: 3em; margin: 5px 0;"></i>
                    <h3>1023</h3>
                    <span>Tutoriels</span>
                </div>
                <div class="col-md-2">
                    <i class="fas fa-pencil-alt" style="font-size: 3em; margin: 5px 0;"></i>
                    <h3>+ de 65000</h3>
                    <span>Posts</span>
                </div>
                <div class="col-md-2">
                    <i class="fas fa-shopping-cart" style="font-size: 3em; margin: 5px 0;"></i>
                    <h3>350</h3>
                    <span>Ventes</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
            <iframe width="100%" height="420" src="https://maps.google.com/maps?width=100%&amp;height=420&amp;hl=en&amp;q=33%20grande%20rue%2C%20valence+(SAS%20-%20E-Campus)&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/"></a></iframe>
    </div>
@endsection