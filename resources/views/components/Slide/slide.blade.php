<div id="carouselHome" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
        <li data-target="#carouselHome" data-slide-to="1"></li>
        <li data-target="#carouselHome" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-caption">
                @auth
                    <a href="{{route('listing-all')}}" id="link_caroussel"<button class="btn btn-primary">Commencez l'exploration !</button></a>
                @else
                    <a href="{{route('login')}}" id="link_caroussel"><button class="btn btn-primary">Commencez l'exploration !</button></a>
                @endauth
            </div>
        </div>
        <div class="carousel-item items2">
            <div class="carousel-caption">
            </div>
        </div>
        <div class="carousel-item items3">
            <div class="carousel-caption">
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="bandeau-explicatif-bg">
    <div class="container p-5 ">
        <div class="row text-center">
            <div class="col-md-4 explain-bandeau"><i style="font-size:2em; color:#007791; margin-bottom: 8px;"
                                                     class="fab fa-hubspot"></i>
                <br> Des milliers de tutoriels en ligne
                <br>Rejoignez vite la communauté E-campus!
            </div>
            <div class="col-md-4 explain-bandeau "><i style="font-size:2em;color:#007791; margin-bottom: 8px;"
                                                      class="fab fa-angellist"></i>
                <br> Des tutos de qualité par nos Formateurs.
                <br>Devenez Formateur!
            </div>
            <div class="col-md-4  explain-bandeau"><i style="font-size:2em;color:#007791; margin-bottom: 8px;"
                                                      class="far fa-plus-square"></i>
                <br>Besoin d'aide sur un sujet ?
                <br>Envoyez un message privé ou créez un post !
            </div>
        </div>
    </div>
</div>
