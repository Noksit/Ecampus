<div class="row bg-dark p-2 text-center">
    <a href="{{URL::route('user-profil-infos')}}" class="text-light btn col-4 border-right">
        <p class="text-uppercase font-weight-bold pt-2">
            <i class="far fa-user-circle" style="font-size: 1.6em; margin-right: 20px; color:#FFFFFF;"></i>
            Vos infos
        </p>
    </a>
    <a href="{{URL::route('user-profil-message')}}" class="btn col-4 text-light">
            <p class="text-uppercase font-weight-bold pt-2">
                <i class="far fa-envelope" style="font-size: 1.6em; margin-right: 20px; color:#FFFFFF;"></i>
                Messagerie
            </p>
    </a>
    <a href="{{URL::route('user-profil-preference')}}" class="col-4 border-left btn text-light">
        <p class="text-uppercase font-weight-bold pt-2">
            <i class="fas fa-cogs" style="font-size: 1.6em; margin-right: 15px; color:#FFFFFF;"></i>
            Préférences
        </p>
    </a>
</div>

