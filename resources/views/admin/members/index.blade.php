@extends('layouts.layout-admin')

@section('content')
    <div class="m-3 row">
        <div class="col-10">
            <p class="font-weight-bold">Administration / Gestion des membres</p>
        </div>
        <div class="col-2">
            <a class="btn btn-success form-control" href="{{route('admin.member.create')}}">Ajouter</a>
        </div>

    </div>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Email</th>
            <th scope="col">Rôle</th>
            <th scope="col">Date d'enregistrement</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        @foreach( $users as $user)
            <tbody>
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->email }}</td>
                <td class="font-weight-bold"></td>
                <td>{{ $user->created_at->format('d.m.Y') }}</td>
                <td><a href="{{route('admin.member.edit', ['user' => $user])}}">Modifier</a></td>
                <td><a href="">Supprimer</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>

@endsection