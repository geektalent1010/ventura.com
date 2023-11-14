@extends('layouts.app', ['ACTIVE_TITLE' => 'DASHBOARD', 'ROUTES' => [
  ['ROUTE' => 'dashboard', 'ACTIVE' => 'dashboard', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'dashboard'])

@section('title', __('- Dashboard'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    .blinking {
        -webkit-animation: 1s blink ease infinite;
        -moz-animation: 1s blink ease infinite;
        -ms-animation: 1s blink ease infinite;
        -o-animation: 1s blink ease infinite;
        animation: 1s blink ease infinite;
    }

    @keyframes "blink" {
        from, to {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }

    @-moz-keyframes blink {
        from, to {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }

    @-webkit-keyframes "blink" {
        from, to {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }

    @-ms-keyframes "blink" {
        from, to {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }

    @-o-keyframes "blink" {
        from, to {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
    }
</style>
@endsection

@section('PAGE_START')
<script src="https://media.twiliocdn.com/sdk/js/chat/v3.3/twilio-chat.min.js"></script>
@endsection

@section('PAGE_CONTENT')
<div class="main-bg d-flex align-items-center justify-content-center">
    <div class="row m-0 px-0 dashboard-section">
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('profile') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <circle class="st0" cx="31" cy="8.5" r="8.2"/>
                            <path class="st0" d="M31,19.6L31,19.6c-8.1,0-14.7,6.6-14.7,14.7l0,0c0,1.9,1.5,3.4,3.4,3.4h22.7c1.9,0,3.4-1.5,3.4-3.4l0,0
                                C45.7,26.2,39.1,19.6,31,19.6z"/>
                        </g>
                        </svg>
                    </div>
                    <span>MY PAGE</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('connect.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <g id="left_button_00000053518244479700531320000016893920283651915932_">
                                <g id="icon_00000178920503850201212240000012080622423361577384_">
                                    <circle class="st0" cx="41.1" cy="9.6" r="6.9"/>
                                    <path class="st0" d="M49.8,22.6C47.6,20.4,44.5,19,41,19c-2.3,0-4.5,0.6-6.4,1.8c3.7,3.3,6.1,8.1,6.2,13.5h9.7
                                        c1.6,0,2.9-1.3,2.9-2.9C53.5,28,52.1,24.9,49.8,22.6z"/>
                                </g>
                            </g>
                            <g>
                                <circle class="st0" cx="23.3" cy="8.5" r="8.2"/>
                                <path class="st0" d="M23.3,19.6L23.3,19.6c-8.1,0-14.7,6.6-14.7,14.7l0,0c0,1.9,1.5,3.4,3.4,3.4h22.7c1.9,0,3.4-1.5,3.4-3.4l0,0
                                    C38,26.2,31.4,19.6,23.3,19.6z"/>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <span>CONNECT</span>
                </div>
            </a>
            @if ($isNewRequests)
                <div class="notification-section">
                    <span class="notify-status blinking"><i class="fa-solid fa-circle"></i></span>
                </div>
            @endif
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('friends.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <g id="left_button_00000082337108467601752200000017410468244133317515_">
                                <g id="icon_00000021120286525318288150000002191206607432189608_">
                                    <circle class="st0" cx="48.8" cy="9.6" r="6.9"/>
                                    <path class="st0" d="M57.6,22.6c-2.2-2.2-5.3-3.6-8.8-3.6c-2.3,0-4.5,0.6-6.4,1.8c3.7,3.3,6.1,8.1,6.2,13.5h9.7
                                        c1.6,0,2.9-1.3,2.9-2.9C61.2,28,59.8,24.9,57.6,22.6z"/>
                                </g>
                            </g>
                            <g>
                                <circle class="st0" cx="31" cy="8.5" r="8.2"/>
                                <path class="st0" d="M31,19.6L31,19.6c-8.1,0-14.7,6.6-14.7,14.7l0,0c0,1.9,1.5,3.4,3.4,3.4h22.7c1.9,0,3.4-1.5,3.4-3.4l0,0
                                    C45.7,26.2,39.1,19.6,31,19.6z"/>
                            </g>
                            <g id="left_button_00000030455210373299929200000005330015995518236298_">
                                <g id="icon_00000132056687395686944220000013899247032932467862_">
                                    <circle class="st0" cx="13.2" cy="9.6" r="6.9"/>
                                    <path class="st0" d="M4.4,22.6c2.2-2.2,5.3-3.6,8.8-3.6c2.3,0,4.5,0.6,6.4,1.8c-3.7,3.3-6.1,8.1-6.2,13.5H3.6
                                        c-1.6,0-2.9-1.3-2.9-2.9C0.8,28,2.2,24.9,4.4,22.6z"/>
                                </g>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <span>FRIENDS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem" id="app">
            <a class="navItem-wrp" href="{{ route('chat.chatting', [ 'ids' => auth()->user()->id . '_' ])}}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <path class="st0" d="M39,0.2H23c-8.6,0-15.6,7-15.6,15.6v0.3c0,7.3,5,13.4,11.8,15.1l-2.3,5.5c-0.2,0.6,0.4,1.1,0.9,0.9l11.3-5.9H39
                            c8.6,0,15.6-7,15.6-15.6v-0.3C54.6,7.1,47.6,0.2,39,0.2z M32.5,21.4H20.6c-0.9,0-1.7-0.8-1.7-1.7c0-0.9,0.8-1.7,1.7-1.7h11.9
                            c0.9,0,1.7,0.8,1.7,1.7C34.2,20.7,33.5,21.4,32.5,21.4z M41.4,14.2H20.6c-0.9,0-1.7-0.8-1.7-1.7c0-0.9,0.8-1.7,1.7-1.7h20.7
                            c0.9,0,1.7,0.8,1.7,1.7C43.1,13.5,42.3,14.2,41.4,14.2z"/>
                        </svg>
                    </div>
                    <span>CHAT</span>
                </div>
            </a>
            @if (count($channels))
                @foreach ($channels as $channel)
                <new-message-notify :auth-user="{{ auth()->user() }}" :channel-info="{{ $channel }}"></new-message-notify>
                @endforeach
            @endif
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('teams.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g id="right_button_00000163035016633754741370000007925284102725833857_">
                            <path id="icon_00000109741442339647772370000008059704231825491382_" class="st0" d="M47.9,0.5H25.4c-0.8,0-1.5,0.7-1.5,1.5v9.8
                                h-9.8c-0.8,0-1.5,0.7-1.5,1.5v22.7c0,0.8,0.7,1.5,1.5,1.5h22.6c0.8,0,1.5-0.7,1.5-1.5v-9.7h9.8c0.8,0,1.5-0.7,1.5-1.5V2.1
                                C49.5,1.2,48.8,0.5,47.9,0.5z M46.4,23.1h-8.2v-9.8c0-0.8-0.7-1.5-1.5-1.5h-9.9V3.7h19.6V23.1z"/>
                        </g>
                        </svg>
                    </div>
                    <span>ROOMS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('stories.index') }}">
                <div class="item">
                    <div class="item-icon">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g id="lists_icon">
                            <g id="right_button">
                                <path id="icon_00000068656261672076974480000012193293335651236748_" class="st0" d="M48.4,0.1H13.6c-3.2,0-5.8,2.6-5.8,5.8v26.2
                                    c0,3.2,2.6,5.8,5.8,5.8h34.8c3.2,0,5.8-2.6,5.8-5.8V5.9C54.1,2.7,51.6,0.1,48.4,0.1z M31.1,28H18.4c-0.9,0-1.7-0.8-1.7-1.7
                                    s0.8-1.7,1.7-1.7h12.8c0.9,0,1.7,0.8,1.7,1.7S32.1,28,31.1,28z M43.6,20.6H18.4c-0.9,0-1.7-0.8-1.7-1.7s0.8-1.7,1.7-1.7h25.2
                                    c0.9,0,1.7,0.8,1.7,1.7S44.6,20.6,43.6,20.6z M43.6,13.3H18.4c-0.9,0-1.7-0.8-1.7-1.7s0.8-1.7,1.7-1.7h25.2c0.9,0,1.7,0.8,1.7,1.7
                                    S44.6,13.3,43.6,13.3z"/>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <span>STORIES</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('companies.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M31,33.7h4.1V11.8c0-0.9,0.9-1.5,1.8-1.2l11.3,4.9c0.8,0.4,1.2,1.1,1.2,1.9v16.3h2c1.1,0,2,0.9,2,2v0
                                c0,1.1-0.9,2-2,2H10.6c-1.1,0-2-0.9-2-2v0c0-1.1,0.9-2,2-2h2V9.2c0-0.8,0.5-1.5,1.2-1.9l15.7-7c0.3-0.1,0.7-0.1,1,0.1
                                C30.8,0.6,31,0.9,31,1.3V33.7z"/>
                        </g>
                        </svg>
                    </div>
                    <span>COMPANIES</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('coaches.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M31,25L31,25c3.7,0,6.8-3.1,6.8-6.8V7.3c0-3.7-3.1-6.8-6.8-6.8l0,0c-3.7,0-6.8,3.1-6.8,6.8v10.8
                                C24.2,21.9,27.3,25,31,25z"/>
                            <path class="st0" d="M42.4,16.4c-0.9,0-1.7,0.8-1.7,1.7v0.5c0,1.3-0.3,2.6-0.8,3.7c-0.5,1.2-1.2,2.2-2.1,3.1
                                c-0.9,0.9-1.9,1.6-3.1,2.1c-1.2,0.5-2.4,0.8-3.7,0.8s-2.6-0.3-3.7-0.8c-1.2-0.5-2.2-1.2-3.1-2.1c-0.9-0.9-1.6-1.9-2.1-3.1
                                c-0.5-1.2-0.8-2.4-0.8-3.7v-0.5c0-0.9-0.8-1.7-1.7-1.7c-0.9,0-1.7,0.8-1.7,1.7v0.5c0,1.8,0.3,3.5,1,5.1s1.6,2.9,2.8,4.1
                                c1.2,1.2,2.6,2.1,4.1,2.8c1.1,0.5,2.2,0.8,3.4,0.9v2.7h-6c-0.9,0-1.7,0.8-1.7,1.7s0.8,1.7,1.7,1.7h15.4c0.9,0,1.7-0.8,1.7-1.7
                                s-0.8-1.7-1.7-1.7h-6v-2.7c1.2-0.2,2.3-0.5,3.4-0.9c1.6-0.7,2.9-1.6,4.1-2.8c1.2-1.2,2.1-2.6,2.8-4.1c0.7-1.6,1-3.3,1-5.1v-0.5
                                C44,17.1,43.3,16.4,42.4,16.4z"/>
                        </g>
                        </svg>
                    </div>
                    <span>COACHES</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('wisdom.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <g>
                                <path class="st0" d="M13.1,29.4v-7.4l-2.3-1.3v8.7C9.7,29.8,9,30.8,9,32c0,1.6,1.3,2.8,2.8,2.8s2.8-1.3,2.8-2.8
                                    C14.7,30.9,14,29.9,13.1,29.4z"/>
                                <path class="st0" d="M31,31.5c-0.9,0-1.8-0.2-2.5-0.7l-12.5-7.3v5.7c0.1,0,0.1,0.1,0.2,0.1l12.6,7.3c1.4,0.8,3.1,0.8,4.5,0
                                    l12.6-7.3c1.4-0.8,2.3-2.4,2.3-3.9v-3l-14.7,8.4C32.8,31.2,31.9,31.5,31,31.5z M53,12.4L33.3,1.2c-0.7-0.4-1.5-0.6-2.3-0.6
                                    s-1.6,0.2-2.3,0.6L8.9,12.4c-1.5,0.9-1.5,3,0,3.9l20.9,12c0.4,0.2,0.7,0.3,1.1,0.3c0.4,0,0.8-0.1,1.1-0.3l20.9-12
                                    C54.5,15.5,54.5,13.3,53,12.4z"/>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <span>WISDOM</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('trades.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M48,27.4c0,6.4-5.1,10.1-14.8,10.1H14v-37h18.1c9.3,0,14,3.9,14,9.6c0,3.7-1.9,6.6-4.9,8.1
                                C45.3,19.6,48,22.8,48,27.4z M22.5,6.9v8.7H31c4.2,0,6.4-1.5,6.4-4.4S35.1,6.9,31,6.9H22.5z M39.4,26.5c0-3.1-2.4-4.6-6.8-4.6h-10
                                V31h10C37,31.1,39.4,29.7,39.4,26.5z"/>
                        </g>
                        </svg>
                    </div>
                    <span>BRANDS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('news.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <path class="st0" d="M46.8,4.6H15.2c-2.7,0-5,2.3-5,5v18.8c0,2.7,2.3,5,5,5h31.7c2.7,0,5-2.3,5-5V9.7C51.8,6.9,49.6,4.6,46.8,4.6z
                            M46.5,13.3L31.8,24.6c-0.2,0.2-0.6,0.3-1,0.3c-0.3,0-0.7-0.1-1-0.3L15.4,13.3c-0.3-0.3-0.5-0.6-0.6-1c0-0.4,0.1-0.8,0.4-1.1
                            c0.3-0.4,0.7-0.6,1.2-0.6c0.4,0,0.7,0.1,0.9,0.4l13.5,10.4L44.6,11c0.3-0.2,0.6-0.3,1-0.3c0.5,0,0.9,0.2,1.1,0.5
                            C47.2,11.8,47.2,12.8,46.5,13.3z"/>
                        </svg>
                    </div>
                    <span>NEWS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('events.company') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <g>
                                <path class="st0" d="M19.8,0.8c-0.3-0.3-0.7-0.4-1-0.4c-0.8,0-1.5,0.7-1.5,1.5v0.7v5.9c0,0.4,0.2,0.8,0.4,1c0.3,0.3,0.7,0.4,1,0.4
                                    c0.8,0,1.5-0.7,1.5-1.5V2.5V1.8C20.3,1.4,20.1,1.1,19.8,0.8z"/>
                                <path class="st0" d="M44.4,0.8c-0.3-0.3-0.7-0.4-1-0.4c-0.8,0-1.5,0.7-1.5,1.5v0.7v5.9c0,0.4,0.2,0.8,0.4,1c0.3,0.3,0.7,0.4,1,0.4
                                    c0.8,0,1.5-0.7,1.5-1.5V2.5V1.8C44.8,1.4,44.7,1.1,44.4,0.8z"/>
                            </g>
                            <path class="st0" d="M47.5,4.5v4c0,2.3-1.9,4.2-4.2,4.2c-1.1,0-2.2-0.4-3-1.2c-0.8-0.8-1.2-1.9-1.2-3V4.2H23v4.3
                                c0,2.3-1.9,4.2-4.2,4.2c-1.1,0-2.2-0.4-3-1.2c-0.8-0.8-1.2-1.9-1.2-3v-4c-2.5,0.8-4.4,3.1-4.4,5.8v21.3c0,0.1,0,0.2,0,0.2
                                c0.1,3.3,2.8,5.9,6.1,5.9h29.5c3.4,0,6.1-2.7,6.1-6.1V10.3C51.9,7.6,50,5.3,47.5,4.5z M42.3,29.1H19.6c-0.9,0-1.5-0.7-1.5-1.5
                                c0-0.9,0.7-1.5,1.5-1.5h22.7c0.9,0,1.5,0.7,1.5,1.5C43.9,28.4,43.2,29.1,42.3,29.1z M42.3,22.5H19.6c-0.9,0-1.5-0.7-1.5-1.5
                                c0-0.9,0.7-1.5,1.5-1.5h22.7c0.9,0,1.5,0.7,1.5,1.5C43.9,21.8,43.2,22.5,42.3,22.5z"/>
                        </g>
                        </svg>
                    </div>
                    <span>EVENTS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('studio.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M27.2,35.1l-1.5-4.8h-10l-1.6,4.8H5.8L17.6,2.7h6.1l11.8,32.4H27.2z M20.9,14.9L18,23.6h5.6L20.9,14.9z"/>
                            <path class="st0" d="M51.7,35.1V33c-1.7,1.7-3.3,2.4-6.1,2.4s-4.8-0.7-6.2-2.1c-1.2-1.2-1.8-3-1.8-5c0-3.9,2.7-6.6,8-6.6h6.1V20
                                c0-3-1.4-4.3-5.1-4.3c-2.5,0-3.7,0.6-5.1,2.3l-3-2.9c2.1-2.6,4.4-3.4,8.2-3.4c6.4,0,9.5,2.7,9.5,7.9V35L51.7,35.1L51.7,35.1z
                                M51.6,24.9h-5.3c-2.8,0-4.2,1.2-4.2,3.3s1.3,3.3,4.4,3.3c1.6,0,3-0.2,4.2-1.3c0.7-0.7,1-1.8,1-3.4v-1.9H51.6z"/>
                        </g>
                        </svg>
                    </div>
                    <span>STUDIO</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('share.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <g id="XMLID_00000000197833897452555440000012312509289738045591_">
                                <path id="XMLID_00000100343628401219209360000003627037707874565285_" class="st0" d="M26.9,26c-2.3,2.3-2.3,5.9,0,8.2
                                    c2.3,2.3,5.9,2.3,8.2,0c2.3-2.3,2.3-5.9,0-8.2C32.8,23.7,29.2,23.7,26.9,26z"/>
                                <path class="st0" d="M41.2,22.7c-0.8,0-1.5-0.3-2-0.8c-2.2-2.2-5.1-3.4-8.2-3.4s-6,1.2-8.2,3.4c-0.5,0.5-1.3,0.8-2,0.8
                                    s-1.5-0.3-2-0.8c-0.5-0.5-0.8-1.3-0.8-2s0.3-1.5,0.8-2c3.3-3.3,7.6-5.1,12.2-5.1c4.6,0,9,1.8,12.2,5.1c0.5,0.5,0.8,1.3,0.8,2
                                    c0,0.8-0.3,1.5-0.8,2C42.7,22.4,42,22.7,41.2,22.7z"/>
                                <path class="st0" d="M12.9,14.9c-0.8,0-1.5-0.3-2-0.8c-1.1-1.1-1.1-3,0-4.1C16.3,4.6,23.4,1.6,31,1.6c7.6,0,14.7,3,20.1,8.3
                                    c1.1,1.1,1.1,3,0,4.1c-0.5,0.5-1.3,0.8-2,0.8s-1.5-0.3-2-0.8c-4.3-4.3-10-6.6-16-6.6c-6.1,0-11.8,2.4-16,6.6
                                    C14.4,14.6,13.7,14.9,12.9,14.9z"/>
                            </g>
                        </g>
                        </svg>
                    </div>
                    <span>SHARE</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('incentives.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M17.8,16.5c1.7,0,3.1,1.4,3.1,3.1v13.6c0,1.7-1.4,3.1-3.1,3.1s-3.1-1.4-3.1-3.1V19.6
                                C14.8,17.9,16.2,16.5,17.8,16.5z"/>
                            <path class="st0" d="M31,9.1c1.7,0,3.1,1.4,3.1,3.1v21c0,1.7-1.4,3.1-3.1,3.1s-3.1-1.4-3.1-3.1v-21C27.9,10.5,29.3,9.1,31,9.1z"/>
                            <path class="st0" d="M44.2,1.7c1.7,0,3.1,1.4,3.1,3.1v28.4c0,1.7-1.4,3.1-3.1,3.1c-1.7,0-3.1-1.4-3.1-3.1V4.8
                                C41.1,3.1,42.5,1.7,44.2,1.7z"/>
                        </g>
                        </svg>
                    </div>
                    <span>STATS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('wallet.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <path class="st0" d="M45.6,4H16.4c-3.4,0-6.2,2.8-6.2,6.2v17.7c0,3.4,2.8,6.2,6.2,6.2h29.2c3.4,0,6.2-2.8,6.2-6.2V10.2
                            C51.8,6.8,49,4,45.6,4z M48.4,26.3H13.6v-5.6h34.9L48.4,26.3L48.4,26.3z"/>
                        </svg>
                    </div>
                    <span>WALLET</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('files.marketing') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M47.9,7.7H30.8c-0.3,0-0.7-0.1-0.9-0.4l-3.7-3.7c-0.8-0.7-1.7-1.1-2.8-1.1h-9.3c-2.2,0-3.9,1.7-3.9,3.9v25.1
                                c0,2.2,1.7,3.9,3.9,3.9h33.8c2.2,0,3.9-1.7,3.9-3.9V11.6C51.8,9.5,50.1,7.7,47.9,7.7z"/>
                        </g>
                        </svg>
                    </div>
                    <span>FILES</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('info.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 38" style="enable-background:new 0 0 62 38;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M26.7,5c0-1.2,0.4-2.3,1.3-3.1c0.9-0.9,1.9-1.3,3.1-1.3c1.2,0,2.3,0.4,3.1,1.3c0.9,0.9,1.3,1.9,1.3,3.1
                                c0,1.2-0.4,2.3-1.3,3.1c-0.9,0.9-1.9,1.3-3.1,1.3c-1.2,0-2.2-0.4-3.1-1.3C27.2,7.2,26.7,6.2,26.7,5L26.7,5L26.7,5z M23.2,18v-5.8
                                h11.9v19.4h3.8v5.8H23.2v-5.8H27V18H23.2L23.2,18z"/>
                        </g>
                        </svg>
                    </div>
                    <span>INFO</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem d-none d-sm-block"><a class="navItem-wrp"></a></div>
        <div class="col-4 navItem d-none d-sm-block"><a class="navItem-wrp"></a></div>
    </div>
</div>
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script src="{{ asset('js/app.js') }}"></script>
@endsection