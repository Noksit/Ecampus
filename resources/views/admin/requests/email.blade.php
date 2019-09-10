<?php $message->subject('Ecampus.click - Reponse automatique suite à votre request'); ?>

<div style="background: #333333; width:100%;">
    <div style="text-align:center; margin:0 auto; border-radius: 10px; background-color: #f5f5f5; padding: 30px 0; width: 50%; overflow: hidden;">
        <h3 style="font-size: 1em; color:orange;">Hello, {{ $username }}</h3>
        <h1 style="color:saddlebrown;">Nice to meet you !</h1>
        <br><br>
        <img src="{{ $message->embed(public_path() . '/images/logo_sans_ombre.png') }}" style="width: 290px; height:145px;"/>
        <br><br>
        <p>Bonjour, votre requête à bien été prise en compte par notre équipe ! =D </p>
        <p>Ne vous inquiétez pas, <b>{{ $username }}</b> votre demande est en cour de traitement ..</p>
        <br><br><br>
        <a href="https://ecampus.click" style=" padding: 8px; text-decoration: none; border-radius:6px; background: orangered; color: white; font-size: 1.2em;"> Voir votre compte </a>
    </div>

</div>
