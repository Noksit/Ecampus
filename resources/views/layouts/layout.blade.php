<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Titre du site -->
    <title>E-Campus - Le site des E-tudiants</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{URL::asset('images/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">

</head>
<body>
@if (session()->has('message'))
    <div class="message_alert text-center">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<header class="p-3">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center logo-image">
                <a href="{{URL::asset('/')}}">
                    <img class="img-fluid" src="{{URL::asset('images/logo_sans_ombre_leger.png')}}" alt="Logo E-campus"
                         title="Logo E-campus">
                </a>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-center">
                <div class="dropdown">
                    <button class="btn btn-info" type="button" id="dropdownMenu2" title="Choisir une catégorie"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-list"></i>
                    </button>
                    <div class="dropdown-menu " aria-labelledby="dropdownMenu2">
                        @foreach($categories = \App\Category::all() as $category)
                            <a class="dropdown-item" href="{{URL::route('listing-categorie')}}/{{$category->name}}">
                                {{$category->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-4 col-sm-12 col-xs-12 ">
                <form method="post" action="{{URL::route('search')}}">
                    @csrf
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Que recherchez vous ?">
                </form>
            </div>
            <div class="col-1 text-lg-right header-link">
                <div class="panier">
                    <a href="{{URL::route('front-panier')}}" class="btn btn-light dropdown" id="dropdownMenuPanier"
                       title="Votre Panier"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-shopping-basket" style="size:25px; color: #17a2b8 "></i>
                    </a>
                    <div class="dropdown-menu" id="panier_hover" aria-labelledby="dropdownMenuPanier">
                        <p class="dropdown-header"> Votre panier est vide</p>
                        <a class="dropdown-item" href="{{URL::route('front-panier')}}">Voir le panier</a>
                    </div>
                </div>
            </div>
            @guest
                <a href="{{URL::route('login')}}" class="btn btn-light" title="Connectez-vous!">Connexion</a>
                <a href="{{URL::route('register')}}" class="btn btn-info" title="Inscrivez-vous!">S'inscrire</a>
            @else
                <div class="col-1 text-right">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown dropdown-toggle" id="dropdownMenuProfil" title="Profil"
                                data-toggle="dropdown" aria-label="dropdownMenuProfil" aria-haspopup="true"
                                aria-expanded="false">
                            <span>{{ Auth::user()->firstname }}</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuProfil">
                            <a class="dropdown-item" href="{{URL::route('user-profil')}}" title="Mon Profil">
                                Profil
                            </a>
                            <a class="dropdown-item" href="{{URL::route('user-profil-infos')}}">
                                Infos
                            </a>
                            <a class="dropdown-item" href="{{URL::route('user-profil-message')}}">
                                Messages
                            </a>
                            <a class="dropdown-item" href="{{URL::route('user-profil-preference')}}">
                                Preferences
                            </a>
                            <a class="dropdown-item" href="{{URL::route('user-profil-bought')}}">
                                Tutos achetés
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->unreadmessage->count() > 0)
                <div class="col-2">
                    <a href="{{URL::route('user-profil-message')}}" class="btn"><i class="far fa-envelope" style="font-size: 1.4em; color:red;"></i>
                        <span style="color:red">{{Auth::user()->unreadMessage->count()}}</span></a>
                </div>
                @endif
            @endguest

        </div>
    </div>
</header>
{{--Zone de contenu--}}
@yield('contenu')
{{--Fin zone de contenu--}}
<footer class="p-4 mt-3">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <h5>E-Campus, qui sommes nous ? </h5>
                <p>E-Campus, site d’apprentissage communautaire, permet de mettre en relation des apprentis codeurs
                    et
                    des professionnels qui partagent et vendent leur savoir. Devenez ce développeur, que s'arrachent
                    aujourd’hui toutes les entreprises !</p>
            </div>

            <div class="col-md-4">
                <h5>Nos derniers articles</h5>
                <!-- todo mettre en place l'url route direction les posts-->
                @forelse($publications = App\Publication::with('user')->latest()->take(5)->get() as $publication)
                    <a class="small" href="{{route('other-profil',['slug' => $publication->user->slug])}}">{{$publication->title}}</a>
                    <br>
                @empty
                    <p>Vide</p>
                    <br>
                @endforelse
            </div>

            <div class="col-md-4">
                <h5>Contact</h5>
                <a href="{{URL::route('front-cgu')}}">C.G.U</a>
                <br>
                <a href="{{URL::route('front-aboutus')}}">Qui somme nous ?</a>
                <br>
                <a href="{{URL::route('front-contact')}}">Nous contacter</a>
                <br>
                <a href="{{URL::route('front-rgpd')}}">Mentions légales</a>
            </div>
        </div>
    </div>
</footer>
<!-- SCRIPTS -->


<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="{{asset('js/app.js')}}"></script>

<script src="{{asset('js/all.js')}}"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

<!-- Initialize Quill editor -->
@stack('scripts_tuto')
@stack('scripts_post')
@stack('ratingScript')
</body>
</html>