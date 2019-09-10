@extends('layouts.layout')


@section('contenu')
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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ $otherUser->name }} {{ $otherUser->firstname }}</div>
                    <div class="card-body">
                        @if($messages->hasMorePages())
                            <div class="text-center">
                                <a href="{{ $messages->nextPageUrl() }}" class="btn btn-light"> Voir les messages précédents</a>
                            </div>
                        @endif
                        @foreach($messages as $message)
                            <div style="overflow: hidden">
                                @if($message->from_user_id === $user->id)
                                    <div class="p-2 m-2 text-right bg-info rounded text-light float-right">
                                        {!! nl2br(e($message->content)) !!}
                                        <br>
                                        <span class="small"><em>{{ $message->created_at->format('d.m.Y à H:i') }}</em></span>
                                    </div>
                                    <hr class="bg-light">
                                @else
                                    <div class="bg-light rounded p-2 m-2 float-left" >
                                        {!! nl2br(e($message->content)) !!}
                                        <br>
                                        <span class="small"><em>{{ $message->created_at->format('d.m.Y à H:i') }}</em></span>
                                    </div>
                                    <hr class="bg-light">
                                @endif
                            </div>
                        @endforeach
                            @if($messages->previousPageUrl())
                                <div class="text-center">
                                    <a href="{{ $messages->previousPageUrl() }}" class="btn btn-light"> Voir les messages suivants</a>
                                </div>
                            @endif
                    </div>
                    <div class="card-footer">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" placeholder="Votre message.." class="form-control" id=""
                                          rows="4"></textarea>
                                <button class="btn btn-info m-2" type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

