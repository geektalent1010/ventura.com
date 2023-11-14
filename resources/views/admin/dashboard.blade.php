@extends('layouts.admin', ['ACTIVE_TITLE' => 'DASHBOARD', 'ACTIVE_LOGOUT' => 'LOGOUT'])

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
@endsection

@section('PAGE_CONTENT')
<div class="admin-main-bg d-flex align-items-center justify-content-center">
    <div class="row m-0 px-0 admin-dashboard-section">
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('tickets.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M10.3,11c-3,0-5.6,2.5-5.6,5.6v3.6c3.8,0,6.9,3.1,6.9,6.9s-3.1,6.9-6.9,6.9v3.6c0,3,2.5,5.6,5.6,5.6h26.9V11
                                H10.3z"/>
                            <path class="st0" d="M43.6,11h-3.7v32h3.8c3,0,5.6-2.5,5.6-5.6V16.6C49.2,13.5,46.7,11,43.6,11z"/>
                        </g>
                        </svg>
                    </div>
                    <span>TICKETS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('members.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                        <path class="st0" d="M27,6.6C15.7,6.6,6.6,15.7,6.6,27S15.7,47.4,27,47.4S47.4,38.3,47.4,27S38.3,6.6,27,6.6z M19.2,18.8
                            c1.8,0,3.2,1.7,3.2,3.7s-1.4,3.7-3.2,3.7S16,24.5,16,22.5S17.4,18.8,19.2,18.8z M37.3,33.7c-2.2,3.3-6,5.4-10.3,5.4
                            s-8.1-2.1-10.3-5.4c-0.7-1.1,0.6-2.3,1.6-1.5c2.3,1.8,5.3,2.9,8.7,2.9s6.4-1.1,8.7-2.9C36.6,31.5,37.9,32.7,37.3,33.7z M34.8,26.2
                            c-1.8,0-3.2-1.7-3.2-3.7s1.4-3.7,3.2-3.7s3.2,1.7,3.2,3.7S36.5,26.2,34.8,26.2z"/>
                        </svg>
                    </div>
                    <span>MEMBERS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('joining.reports.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                        <path class="st0" d="M45.2,12.1H23.5l-3.7-2.7c-0.7-0.5-1.5-0.8-2.4-0.8H8.8c-2.2,0-4,1.8-4,4v6.2v0.3v22.4c0,2.2,1.8,4,4,4h36.4
                            c2.2,0,4-1.8,4-4V19.1v-0.3v-2.7C49.2,13.9,47.4,12.1,45.2,12.1z"/>
                        </svg>
                    </div>
                    <span>REPORTS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('products.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                        <path class="st0" d="M29.5,9.8c-6.6,0-12.2,4.6-13.6,10.8c-1.1-0.3-2.2-0.5-3.4-0.5c-6.6,0-12,5.4-12,12c0,6.6,5.4,12,12,12h0h31.8
                            v0c5.2,0,9.3-4.2,9.3-9.4c0-5.2-4.2-9.4-9.4-9.4c-0.3,0-0.5,0-0.8,0c0.1-0.5,0.1-1,0.1-1.6C43.5,16.1,37.2,9.8,29.5,9.8z"/>
                        </svg>
                    </div>
                    <span>PRODUCTS</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('emails.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                        <path id="Mail_00000036248836378590132620000015090154141710420629_" class="st0" d="M43.6,11H10.3c-3,0-5.6,2.5-5.6,5.6v20.9
                            c0,3,2.5,5.6,5.6,5.6h33.4c3,0,5.6-2.5,5.6-5.6V16.6C49.2,13.5,46.7,11,43.6,11z M43.2,20.5L27.8,33c-0.2,0.2-0.6,0.3-0.9,0.3
                            s-0.6-0.1-0.9-0.3L10.8,20.5c-0.6-0.5-0.7-1.3-0.2-1.9c0.5-0.6,1.3-0.7,1.9-0.2L27,30.1l14.4-11.8c0.6-0.5,1.5-0.4,1.9,0.2
                            C43.8,19.1,43.7,20,43.2,20.5z"/>
                        </svg>
                    </div>
                    <span>E-MAIL</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('finance.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 54 54" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                        <path class="st0" d="M27,6.6C15.7,6.6,6.6,15.7,6.6,27c0,11.3,9.1,20.4,20.4,20.4c11.3,0,20.4-9.1,20.4-20.4
                            C47.4,15.7,38.3,6.6,27,6.6z M29.3,23.8V26H20c0,0.3-0.1,0.7-0.1,1c0,0.4,0,0.7,0.1,1h9.4v2.1h-8.8c1.2,2.7,3.8,4.3,7,4.3
                            c2.2,0,4.2-0.8,5.7-2.5l2.5,2.4c-2,2.3-5,3.6-8.5,3.6c-5.4,0-9.7-3.2-11-7.8h-3.5V28H16c0-0.3,0-0.7,0-1c0-0.4,0-0.7,0-1h-3.1v-2.1
                            h3.5c1.3-4.7,5.6-7.8,11-7.8c3.5,0,6.5,1.3,8.5,3.6L33.3,22c-1.6-1.7-3.5-2.5-5.7-2.5c-3.3,0-5.9,1.7-7,4.3H29.3z"/>
                        </svg>
                    </div>
                    <span>FINANCE</span>
                </div>
            </a>
        </div>
        <div class="col-4 navItem">
            <a class="navItem-wrp" href="{{ route('news.index') }}">
                <div class="item">
                    <div class="item-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 80 70" style="enable-background:new 0 0 80 70;" xml:space="preserve">
                        <path id="Mail_00000034805142091730622730000015747733887613171853_" class="st0" d="M68.5,7.6h-57C6.3,7.6,2,11.9,2,17.1v35.7
                            c0,5.2,4.3,9.5,9.5,9.5h57.1c5.2,0,9.5-4.3,9.5-9.5V17.2C78.1,11.9,73.8,7.6,68.5,7.6z M67.7,23.8L41.5,45.2c-0.4,0.4-1,0.5-1.5,0.5
                            s-1.1-0.2-1.5-0.5L12.3,23.8c-1-0.8-1.2-2.3-0.3-3.3c0.8-1,2.3-1.2,3.3-0.3L40,40.3l24.7-20.2c1-0.8,2.5-0.7,3.3,0.3
                            C68.8,21.4,68.7,22.9,67.7,23.8z"/>
                        </svg>
                    </div>
                    <span>NEWS</span>
                </div>
            </a>
            @if ($isNews)
                <div class="notification-section">
                    <span class="notify-status blinking"><i class="fa-solid fa-circle"></i></span>
                </div>
            @endif
        </div>
        <div class="col-4 navItem"></div>
        <div class="col-4 navItem"></div>
    </div>
</div>
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection