<footer>
    <div class="footerDesc m-auto d-flex justify-content-center">
        @if (isset($ACTIVE_TITLE) && $ACTIVE_TITLE != 'ventura')
        <div class="navicon-section">
            @if (isset($ROUTES) && count($ROUTES))
                @foreach ($ROUTES as $ROUTE)
                    @if (isset($ROUTE['ACTIVE_ROUTE']) && $ROUTE['ACTIVE_ROUTE'])
                        <a href="{{ route($ROUTE['ROUTE']) }}">
                            <span class="nav-icon @if (isset($ACTIVE_PAGE) && $ACTIVE_PAGE == $ROUTE['ACTIVE']) active @endif"><i class="fa-solid fa-circle"></i></span>
                        </a>
                    @endif
                @endforeach
            @endif
            @if (isset($ACTIVE_CHAT_ROUTES) && $ACTIVE_CHAT_ROUTES)
                <a href="{{ route('chat.chatting', [ 'ids' => auth()->user()->id . '_' ]) }}">
                    <span class="nav-icon @if (isset($ACTIVE_PAGE) && $ACTIVE_PAGE == 'members') active @endif"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
                </a>
                <a href="{{ route('chat.chatting', [ 'ids' => auth()->user()->id . '_' .auth()->user()->id]) }}">
                    <span class="nav-icon @if (isset($ACTIVE_PAGE) && $ACTIVE_PAGE == 'chatting') active @endif"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
                </a>
            @endif
            @if (isset($ACTIVE_GROUP_ROUTES) && $ACTIVE_GROUP_ROUTES)
                <a href="{{ route('teams.index') }}">
                    <span class="nav-icon @if (isset($ACTIVE_PAGE) && ($ACTIVE_PAGE == 'own' || $ACTIVE_PAGE == 'create' || $ACTIVE_PAGE == 'edit')) active @endif"><i class="fa fa-circle" aria-hidden="true"></i></span>
                </a>
                <a href="{{ route('friends.teams.index') }}">
                    <span class="nav-icon @if (isset($ACTIVE_PAGE) && ($ACTIVE_PAGE == 'friends')) active @endif"><i class="fa fa-circle" aria-hidden="true"></i></span>
                </a>
                <a href="{{ route('team.chat.index', [ 'id' => 0 ]) }}">
                    <span class="nav-icon @if (isset($ACTIVE_PAGE) && $ACTIVE_PAGE == 'chat') active @endif"><i class="fa fa-circle" aria-hidden="true"></i></span>
                </a>
            @endif
            @if (isset($CREATE_ROUTE) && isset($ACTIVE_CREATE) && $ACTIVE_CREATE)
                <a href="{{ route($CREATE_ROUTE) }}">
                    <span class="nav-icon @if (isset($ACTIVE_PAGE) && $ACTIVE_PAGE == 'create') active @endif"><i class="fa-solid fa-circle"></i></span>
                </a>
            @endif
        </div>            
        @else
        <div class="video-controls">
            <img class="play-icon" src="{{ asset('images/svg/PlayButtonWhite.svg') }}" alt="PlayButton svg">
            <img class="stop-icon d-none" src="{{ asset('images/svg/StopButtonWhite.svg') }}" alt="StopButton svg">
        </div>
        @endif
    </div>
</footer>