@extends('layouts.layout-admin')

@section('content')
    <div class="row m-3">
        <div class="col-10">
            <p class="font-weight-bold">Administration / Gestion des posts</p>
        </div>
        <div class="col-2">
            <a class="btn btn-success form-control" href="{{route('admin.post.create')}}">Ajouter</a>
        </div>
    </div>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Créateur</th>
            <th scope="col">Contenu</th>
            <th scope="col">Date d'ajout</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        @foreach( $posts as $post)
            <tbody>
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>
                    <a href="{{route('other-profil',['slug' => $post->user->slug])}}">
                        {{ $post->title }}
                    </a>
                </td>
                <td>{{ $post->Category->name}}</td>
                <td>{{ $post->user->name }} {{ $post->user->firstname }}</td>
                <td>{!! str_limit($post->content, $limit = 300) !!}</td>
                <td>{{ $post->created_at->format('d.m.Y') }}</td>
                <td><a href="{{route('admin.post.edit', ['publication' => $post])}}">Modifier</a></td>
                <td><a href="{{route('admin.post.delete', ['publication' => $post])}}">Suprimer</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>

@endsection