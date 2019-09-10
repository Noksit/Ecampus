@extends('layouts.layout-admin')

@section('content')
    <p class="m-4 font-weight-bold">Administration / Gestion des achats</p>

    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Date d'enregistrement</th>
            <th scope="col">Consulter</th>
            <th scope="col">traiter</th>
        </tr>
        </thead>
        @foreach( $purchases as $purchase)
            <tbody>
            <tr>
                <th scope="row">{{ $purchase->id }}</th>
                <td class="font-weight-bold">{{ $purchase->user->name }}</td>
                <td class="font-weight-bold">{{ $purchase->user->email }}</td>
                <td>{{ $purchase->created_at->format('d.m.Y') }}</td>
                <td><a href="">Consulter</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <div class="col-12 mt-3 mb-2">
        <div class="card shadow">

            <div class="card-header">
                <span style="font-weight: bold;">Statistiques des achats</span>
            </div>

            <div class="row">
                <div class="col-9">
                    <div class="card-body">
                        <li>Achats des dernieres 24 heures : {{$dailyPurchases->count()}} achats pour CA de {{$dailyPurchases->sum('price')}}</li>
                        <li>Achats de la semaine : {{$weeklyPurchases->count()}} achats pour un CA de {{$weeklyPurchases->sum('price')}}</li>
                        <li>Achats du mois : {{$monthlyPurchases->count()}} achats pour un CA de {{$monthlyPurchases->sum('price')}}</li>
                        <li>Total des achats pour l'année en cours : {{$yearPurchases->count()}} achats pour un CA de {{$yearPurchases->sum('price')}}</li>
                        <li>Total des achats : {{$purchases->count()}} achats pour un CA de {{$purchases->sum('price')}}</li>
                    </div>
                </div>
            <div class="card-footer text-right">

            </div>
        </div>
    </div>

@endsection