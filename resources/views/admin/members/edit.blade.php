@extends('layouts.layout-admin')

@section('content')
<p class="m-4 font-weight-bold">Administration / Gestion des membres</p>

<div class="card-columns">

    <!-- MON PROFIL-->
    <div class="card">
        <form action="{{URL::route('admin.member.update', ['user' => $otherUser] )}}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Mon Profil</h3>
            </div>
            <div class="card-body">
                <h5>Nom</h5>

                <input id="name" type="text"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       name="name" value="{{strtoupper($otherUser->name)}}">

                <h5>Prenom</h5>
                <input id="firstname" type="text"
                       class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                       name="firstname" value="{{ucfirst($otherUser->firstname)}}">


                <h5>Date de Naissance</h5>
                <input id="birthday" type="date"
                       class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                       name="birthday" value="{{$otherUser->birthday ? $otherUser->birthday->format('Y-m-d') : ''}}">


                <h5>Email</h5>
                <input id="email" type="text"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{$otherUser->email}}">

                <h5>Paypal</h5>

                <input id="paypal" type="text"
                       class="form-control{{ $errors->has('paypal') ? ' is-invalid' : '' }}"
                       name="paypal" value="{{$otherUser->paypal}}">

                @if($user->roles[0]->name === 'superAdmin')

                <h5>Rôle</h5>

                <select class="custom-select {{ $errors->has('role_id') ? ' is-invalid' : '' }}"
                        name="role_id" id="selecteur_role">
                    <option selected value="{{$otherUser->roles[0]->id}}">{{$otherUser->roles[0]->name}}</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>

                @endif
            </div>

            <div class="card-footer text-right">
                <button type="submit"
                        class="btn btn-info">Modifier
                </button>
            </div>
        </form>
    </div>
</div>

@endsection