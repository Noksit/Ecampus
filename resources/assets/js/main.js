
$('.datepicker').datepicker({});

var menu_panier = $('.panier');
var panier = $('#panier_hover');

menu_panier.hover(function() {
    $(this).find('#panier_hover').stop(true, true).delay(200).fadeIn(200);
}, function() {
    $(this).find('#panier_hover').stop(true, true).delay(200).fadeOut(200);
});

$('#summernote_post').summernote({
    height:250,
    placeholder: 'Insérer ici, le contenu de votre post...',
    focus:true
});

$('#summernote_tuto').summernote({
    height:250,
    placeholder: 'Insérer ici, le contenu de votre tutoriel...',
    focus:true
});

$('#summernote').summernote({
    height:250,
    placeholder: 'Insérer ici, le contenu de votre requête...',
    focus:true
});


