<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Titre du site -->
    <title>Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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
<div class="container-fluid">
    <div class="row bg-light text-dark shadow">
        <div class="col-2 text-center pt-2 ">
            <p class="font-weight-bold">Administration {e}Campus</p>
        </div>
        <div class="col-4 text-left pt-2">
            <a href="{{ URL::route('front-index') }}"><i class="fas fa-home"></i></a>
            <a class="ml-2" href="{{ URL::route('administration') }}"><i class="fas fa-undo-alt"></i></a>
        </div>
        <div class="col-6 pt-1">
            <form class="form-inline justify-content-end">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher.." aria-label="Rechercher..">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </div>
    <div class="row text-dark">
        <div class="col-2 bg-light text-center pt-3 shadow">
            <img src="{{ asset(Auth::user()->imgprofil) }}" alt="Image de profil" class="w-50 rounded-circle shadow">
            <p class="mt-2 font-weight-bold">{{ Auth::user()->name }}  {{ Auth::user()->firstname }} </p>

            <a class="btn btn-danger" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <ul class="nav administration mt-5 pb-4 text-left pl-3">
                <li class="nav-item  w-100 mt-2">
                    <a href="{{ URL::route('admin.members.index') }}" class="nav-link active"> <i class="fas fa-users"
                                                                                                  style="font-size: 1.5em; margin-right: 8px;"></i>
                        Gestion des membres</a>
                </li>
                <li class="nav-item  w-100 mt-2">
                    <a href="{{ URL::route('admin.posts.index') }}" class="nav-link"><i class="fas fa-file-alt"
                                                                                        style="font-size: 1.5em; margin-right: 8px;"></i>Gestion
                        des posts</a>
                </li>
                <li class="nav-item  w-100 mt-2">
                    <a href="{{ URL::route('admin.tutorials.index') }}" class="nav-link"><i class="far fa-clipboard"
                                                                                            style="font-size: 1.5em; margin-right: 8px;"></i>Gestion
                        des tutoriels</a>
                </li>
                <li class="nav-item  w-100 mt-2">
                    <a href="{{ URL::route('admin.comments.index') }}" class="nav-link"><i class="far fa-comment"
                                                                                           style="font-size: 1.5em; margin-right: 8px;"></i>Gestion
                        des commentaires</a>
                </li>
                <li class="nav-item  w-100 mt-2">
                    <a href="{{ URL::route('admin.request.index') }}" class="nav-link"><i class="fas fa-envelope-open"
                                                                                          style="font-size: 1.5em; margin-right: 8px;"></i>Gestion
                        des requêtes</a>
                </li>
                <hr style="background: #e3e3e3;">
                <li class="nav-item  w-100 mt-2">
                    <a href="{{route('admin.marketing.index')}}" class="nav-link"><i class="fas fa-cart-arrow-down"
                                                                                     style="font-size: 1.5em; margin-right: 8px;"></i>Gestion
                        marketing</a>
                </li>
                <li class="nav-item  w-100 mt-2">
                    <a href="{{route('admin.comptable.index')}}" class="nav-link"><i class="fas fa-calculator"
                                                                                     style="font-size: 1.5em; margin-right: 8px;"></i>Gestion
                        comptable</a>
                </li>

                <hr style="background: #e3e3e3;">


            </ul>
        </div>

        <div class="col-10 text-black-50">
            @yield('content')
        </div>
    </div>
</div>


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