<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModal">Votre note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-12 ">
                            <p>Notez le tutoriel</p>
                            <form action="{{ route('tutorial.rating',['slug' =>$tuto->slug] )}}" method="POST"
                                  class="star_rating">
                                @csrf
                                <p class="clasificacion">
                                    <input type="radio" id="radio1" name="rate" value="5">
                                    <label for="radio1">&#9733;</label>
                                    <input type="radio" id="radio2" name="rate" value="4">
                                    <label for="radio2">&#9733;</label>
                                    <input type="radio" id="radio3" name="rate" value="3">
                                    <label for="radio3">&#9733;</label>
                                    <input type="radio" id="radio4" name="rate" value="2">
                                    <label for="radio4">&#9733;</label>
                                    <input type="radio" id="radio5" name="rate" value="1">
                                    <label for="radio5">&#9733;</label>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('ratingScript')
    <script>

        var $star_rating = $('.star-rating .far');

        var SetRatingStar = function () {
            return $star_rating.each(function () {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                    return $(this).removeClass('far fa-star').addClass('fas fa-star');
                } else {
                    return $(this).removeClass('fas fa-star').addClass('far fa-star');
                }
            });
        };

        $star_rating.on('mouseover', function () {
            $star_rating.siblings('input.rating-value').val($(this).data('rating'));
            return SetRatingStar();
        });

        SetRatingStar();

        $(document).ready({});
    </script>
@endpush