@if(count($followers) > 0)
    <h4>
        VOUS SUIVEZ :
    </h4>

    @foreach($followers as $follower)
        <a href="{{ route('conversation.show',['slug' => $follower->followings->first()->slug ])}}"
           class="m-1 p-2 border bg-light list-group-item">
            {{ $follower->followings->first()->name }} {{ $follower->followings->first()->firstname }}
        </a>

        @if(count($follower->followings->first()->unreadMessageByUser) > 0)
            <span class="rounded-circle  m-2 p-2 text-danger font-weight-bold small ">
             {{ count($follower->followings->first()->unreadMessageByUser) }} message(s)..
        </span>
        @endif
    @endforeach
@endif

@if(count($followings) > 0)
    <h4>
        SUIVI PAR:

    </h4>
    @foreach($followings as $following)
        <a href="{{ route('conversation.show',['slug' => $following->followers->first()->slug ])}}"
           class="m-1 p-2 border bg-light list-group-item">
            {{ $following->followers->first()->name }} {{ $following->followers->first()->firstname }}
        </a>
        @if(count($following->followers->first()->unreadMessageByUser) > 0)
            <span class="rounded-circle  m-2 p-2 text-danger font-weight-bold small ">
             {{ count($following->followers->first()->unreadMessageByUser) }} message(s)..
        </span>
        @endif
    @endforeach
@endif



