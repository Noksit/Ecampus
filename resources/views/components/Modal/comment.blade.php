<!-- Modal Commentaire Post-->
<div class="modal fade" id="exampleModal{{ $publication->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-left" id="exampleModalLongTitle">Commentaire sur le post <br> <b>{{ $publication->title }}</b></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($publication->comment as $comment)
                    <div class="col-md-12 rounded p-3 mt-2">
                        @if($comment->user->id == Auth::user()->id)
                        <div class="text-right">
                            <a href="{{ URL::route('comment-delete', [ 'id' => $comment->id]) }}">
                                <i class="fas fa-eraser text-danger"></i>
                            </a>
                        </div>
                        @endif
                            <div class="row">
                            <div class="col-md-2 text-right">
                                <a href="{{route('other-profil', ['slug' =>$comment->user->slug])}}">
                                    <img class="w-100 rounded shadow" src="{{asset($comment->user->imgprofil)}}">
                                </a>
                            </div>
                            <div class="col-md-10 text-left">
                                <p><b>{{ $comment->user->name }}  {{ $comment->user->firstname }}</b><br>
                                    <span class="font-weight-light small">{{ $comment->created_at->format('d/m/Y \à\ H:i') }}</span></p>

                                <p class=" font-weight-bold bg-light p-1">{{ $comment->content }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <form action="{{ route('post-comment', ['slug' => $publication->slug]) }}" method="post" class="mb-2">
                    @csrf
                    <textarea name="content" id="content" class="form-control" rows="3"
                              placeholder="Votre commentaire ici"></textarea>
                    <input type="submit" class="mt-2 btn btn-primary" value="Commenter">
                </form>
            </div>
        </div>
    </div>
</div>