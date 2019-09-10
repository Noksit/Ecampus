@extends('layouts.layout')


@section('contenu')

    <!-- Barre de naviguation -->
    <div class="container-fluid">
        @include('components.navBar.config')
    </div>

    <!-- Bandeau de sous-menu -->
    <div class="container-fluid p-4 bg-light shadow">
        <h3 class="text-center">
            Vos informations personnelles : Modification de vos données personnelles
        </h3>
    </div>

    <!-- Contenu de l'onglet -->
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12 ">

                <div class="card-columns">

                    <!-- MON PROFIL-->
                    <div class="card">
                        <form action="{{URL::route('user.update')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Mon Profil</h3>
                            </div>
                            <div class="card-body">
                                <h5>Nom</h5>

                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{$user->name}}">

                                <h5>Prenom</h5>
                                <input id="firstname" type="text"
                                       class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                       name="firstname" value="{{$user->firstname}}">


                                <h5>Date de Naissance</h5>
                                <input id="birthday" type="date"
                                       class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                       name="birthday" value="{{$user->birthday ? $user->birthday->format('Y-m-d') : ''}}">


                                <h5>Email</h5>
                                <input id="email" type="text"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{$user->email}}">

                                <h5>Paypal</h5>

                                <input id="paypal" type="text"
                                       class="form-control{{ $errors->has('paypal') ? ' is-invalid' : '' }}"
                                       name="paypal" value="{{$user->paypal}}">
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit"
                                        class="btn btn-info">Modifier
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- DESCRIPTION-->
                    <div class="card">
                        <form action="{{URL::route('user.update')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Ma description</h3>
                            </div>
                            <div class="card-body">
                                <textarea name="description" rows="15"
                                          class="form-control">{{$user->description}}</textarea>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-info">Modifier</button>
                            </div>
                        </form>
                    </div>

                    <!-- PHOTO-->
                    <div class="card ">
                        <form action="{{URL::route('user.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Ma Photo</h3>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{asset($user->imgprofil)}}"
                                     alt="Avatar Romaric"
                                     class="rounded border img-fluid">
                            </div>
                            <div class="card-footer">
                                <input type="file" name="avatar" id="avatar">
                                <button class="btn btn-info float-right" value="{{public_path($user->imgprofil)}}" type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--****************  FIN DE INFORMATIONS PERSONNELS   ************************************************** -->

@endsection