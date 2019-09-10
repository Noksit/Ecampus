@extends('layouts.layout-admin')

@section('content')
    <p class="m-4 font-weight-bold">Administration / Gestion des commentaires</p>

    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Contenu</th>
            <th scope="col">Ecris par</th>
            <th scope="col">Correspondant à</th>

            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        @foreach( $comments as $comment)
            <tbody>
            <tr>
                <th scope="row">
                    {{ $comment->id }}
                </th>
                <td class="small">
                    {{ $comment->content }}
                </td>
                <td>
                    <a href="{{route('other-profil', ['slug' => $comment->user->slug])}}">
                        {{ $comment->user->firstname }}
                    </a>
                </td>
                <td>
                    {{$comment->publication->title}}
                </td>

                <td><a href="{{route('admin.comment.edit',['comment' => $comment])}}">Modifier</a></td>
                <td><a href="{{route('admin.comment.delete', ['comment' => $comment])}}">Supprimer</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
{{$comments->links()}}
@endsection