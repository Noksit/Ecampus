@extends('layouts.layout-admin')

@section('content')

    <div class="container-fluid pt-4 pb-4 bandeau-sombre">
        <div class="container">
            <h1 class="text-success"><i class="far fa-file-alt"></i> Modification du Tutoriel de <b>{{ $publication->user->firstname }}</b></h1>
            <p><b><u>{{ $publication->title }}</u></b></p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modification du tutoriel suivant : <b>{{ $publication->title }}</b></div>

                    <div class="card-body">
                        <form method="POST" action="{{URL::route('admin.tutorial.update', ['publication' => $publication])}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="type" value="tutorial">
                            <div class="form-group">
                                <label for="selecteur_tuto">Selectionner une catégorie </label>
                                <select class="custom-select {{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                        name="category_id" id="selecteur_tuto">
                                    @if($publication->category_id)

                                        <option selected value="{{$publication->category_id}}">{{$publication->category->name}}</option>
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
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title"
                                       placeholder="Titre du tutoriel"
                                       title="Maximum 50 caractères" value="{{old('title') ? old('title') : $publication->title}}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                       placeholder="Un descriptif rapide de votre tutoriel.."
                                       id="description_tuto" title="Maximum 150 caractères"
                                       value="{{old('description') ? old('description') : $publication->description}}">
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="imgpublication">Image</label>
                                <div class="img-fluid text-center">
                                    <p>Votre image existante</p>
                                    <img class="img_bandeau w-50 border-dark mb-3" src="{{asset('storage/imgpublication-crop/'.$publication->imgpublication)}}" alt="Image de l'article">
                                </div>
                                <input type="file" name="imgpublication" class="form-control" id="imgpublication">
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="text" name="price" value="{{old('price') ? old('price') : floatval($publication->price)}}" id="price"
                                       placeholder="Si gratuit, ne pas remplir"
                                       class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}">
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="required">Prérequis</label>
                                <input type="text" name="required" id="required" title="Maximum 100 caractères"
                                       class="form-control{{ $errors->has('required') ? ' is-invalid' : '' }}"
                                       placeholder="Prerequis du tutoriel" value="{{old('required') ? old('required') : $publication->required}}">

                                <div class="form-group">
                                    <label for="objectifs">Objectifs</label>
                                    <input type="text" name="goals" id="objectifs" title="Maximum 100 caractères"
                                           class="form-control{{ $errors->has('goals') ? ' is-invalid' : '' }}"
                                           placeholder="Objectifs du tutoriel" value="{{old('goals') ? old('goals') : $publication->goals}}">

                                </div>

                                <div class="form-group">
                                    <label for="content">Contenu</label>
                                    <input type="hidden" name="content"
                                           class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}">
                                    <div id="editor_tutorial">
                                        {!! old('content') ? old('content') : $publication->content !!}
                                    </div>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="reset" class="btn btn-danger" value="Effacer">Effacer</button>
                                        <button type="submit" class="btn btn-primary" value="Enregistrer">Enregistrer
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_tuto')
    <script>
        //Editor View AddTutorial
        var quill = new Quill('#editor_tutorial', {
            modules: {
                toolbar: [
                    [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],
                    ['bold', 'italic', 'underline', 'strike','link'],        // toggled buttons
                    ['code-block'],
                    [{'list': 'bullet'}],
                    [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
                    [{'color': []}, {'background': []}],          // dropdown with defaults from theme
                    [{'align': []}]
                ]
            },
            placeholder: 'Le contenu de votre tutoriel...',
            theme: 'snow'  // or 'bubble'
        });
        quill.on('text-change', function () {
            var content = document.querySelector('input[name=content]');
            content.value = quill.root.innerHTML;
            console.log(content);
        });

    </script>
@endpush