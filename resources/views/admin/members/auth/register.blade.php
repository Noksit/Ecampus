@extends('layouts.layout-admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-4">


                <div class="card">
                    <div class="card-header">{{ __('S\'inscrire') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.member.store') }}">
                            @csrf

                            <div class="form-group row">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"
                                       name="name" placeholder="Nom" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <input class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                       type="text"
                                       name="firstname" placeholder="Prenom" value="{{ old('firstname') }}" required
                                       autofocus>
                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text"
                                       name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Confirmer l'inscription
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i
                                                class="fab fa-facebook-f"></i> Facebook</a>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
