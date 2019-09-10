@extends('layouts.layout-admin')

@section('content')
    <p class="m-4 font-weight-bold">Administration / Gestion des tutoriels</p>

    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">Répondre</th>
            <th scope="col">Supprimer</th>

        </tr>
        </thead>
        @foreach( $contactRequests as $contactRequest)
            <tbody>
            <tr>
                <th scope="row">{{ $contactRequest->id }}</th>
                <td>{{ $contactRequest->title }}</td>
                <td>{{ $contactRequest->content}}</td>
                <td>{{ $contactRequest->user->name }} {{ $contactRequest->user->firstname }}</td>
                <td><a href="{{ route('admin.request.email', [ 'contactRequest' => $contactRequest->id ]) }}">Répondre</a></td>
                <td><a href="">Supprimer</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>

@endsection