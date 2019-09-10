@extends('layouts.layout-admin')

@section('content')
    <div class="container text-center">
        <h1 class="text-success"><i class="far fa-file-alt"></i> Modification du Post de
            <b>{{ $publication->user->firstname }}</b></h1>
        <h3><u><b>{{ $publication->title }}</b></u></h3>
    </div>
    <div class="container mt-3 mb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Modification du post : <b>{{ $publication->title }}</b></div>

                    <div class="card-body">
                        <form id="ajout-post" method="POST"
                              action="{{URL::route('admin.post.update', ['publication' => $publication])}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$publication->user->id}}">
                            <input type="hidden" name="type" value="post">
                            <div class="form-group">
                                <label for="category_id">
                                    Sélectionner une catégorie
                                </label>
                                <select class="custom-select {{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                        name="category_id" id="selecteur_post">
                                    @if($publication->category_id)
                                        <option selected
                                                value="{{$publication->category_id}}">{{$publication->category->name}}</option>
                                    @else
                                        <option selected disabled>Choisir une categorie</option>
                                    @endif
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" name="title"
                                       class="form-control {{$errors->has('title') ? ' is-invalid' : '' }}" id="title"
                                       placeholder="Titre" value="{{old('title') ? old('title') : $publication->title}}"
                                       title="Maximum 50 caractères"/>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="content">Contenu</label>
                                <input type="hidden" style="resize: both; overflow: auto" name="content"
                                       class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}">
                                <div id="editor-container">
                                    {!! old('content') ? old('content') : $publication->content !!}
                                </div>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="reset" class="btn btn-danger" value="Effacer">Effacer</button>
                                    <button type="submit" class="btn btn-primary" value="Enregistrer">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts_post')
    <script>
        //Editor View AddPost
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{header: [1, 2, 3, false]}],

                    ['bold', 'italic', 'underline', 'strike', 'link', 'image'],        // toggled buttons
                    ['code-block'],


                    [{'color': []}, {'background': []}],          // dropdown with defaults from theme
                    [{list: 'bullet'}],

                    [{'align': []}]
                ]
            },
            placeholder: 'Le contenu de votre post...',
            theme: 'snow'  // or 'bubble'
        });

        quill.on('text-change', function () {
            var content = document.querySelector('input[name=content]');
            content.value = quill.root.innerHTML;
        });

    </script>
@endpush