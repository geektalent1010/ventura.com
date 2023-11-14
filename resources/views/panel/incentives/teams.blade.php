@extends('layouts.app', ['ACTIVE_TITLE' => 'SALES', 'ROUTES' => [
  ['ROUTE' => 'incentives.index', 'ACTIVE' => 'incentives', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'incentives.teams', 'ACTIVE' => 'teams', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'teams'])

@section('title', __('- Stats'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('plugin/slick/slick.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('plugin/slick/slick-theme.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
    <div class="row m-0 mx-auto p-0 incentives-section trackView-section">
        <div class="row justify-content-center m-0 w-100">
            <div class="col-md-6 p-0">
                <div class="statusItem">
                    <div class="story-content-wrp">
                        <div class="my-story-card">
                            <p class="story-card-title">SALES TRACKER</p>
                        </div>
                    </div>
                </div>
                <div class="search-input-section">
                    <input id="trackerSearchKey" type="text" class="form-control" name="searchKey" placeholder="Search Name or click a Sales Floor">
                    <div class="search-icon-section">
                        <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="row w-100 p-0 m-0 poolitem-section">
                    @for ($index = 1; $index < 6; $index++)
                        <div class="poolItem" attr-data={{$index}}>
                            <div class="poolItem-wrp level-{{$index}}">
                                <div class="item">
                                    <img class="" src="{{ asset('images/svg/IconRANK.svg') }}">
                                    <p>{{$index}}</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="member-body flat-scroll mt-4">
                </div>
                <div class="statusItem">
                    <div class="story-content-wrp">
                        <div class="my-story-card">
                            <p class="story-card-title">SALES VIEWER</p>
                        </div>
                    </div>
                </div>
                
                @if (is_null($viewer))
                <div class="no-members text-center mt-5">
                    
                </div>
                @else
                <div class="row w-100 p-0 m-0">
                    <div class="col-4 col-sm-4 rowItem">
                        <div class="rowItem-wrp">
                            <div class="item">
                                <span class="item-icon text-center h1"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 rowItem">
                        <div class="rowItem-wrp active">
                            <div class="item">
                                <div class="item-icon mb-2">
                                    <p>{{ isset($viewer->rank) ? $viewer->rank->rank->level : '0'}}</p>
                                    <img src="{{ asset('images/svg/IconRANK.svg') }}">
                                </div>
                                <span class="name-label mb-1">{{ $viewer->getFullname() }}</span>
                                <span class="score-label mb-1">{{ $viewer->referrers->count() }}</span>
                                <div class="d-flex align-items-center">
                                    <span class="date-icon mr-2 {{ isset($viewer->rank) ? 'active' : '' }}"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                    <span class="date-label">{{ date_format($viewer->created_at, "d.m.Y" )}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 rowItem">
                        <div class="rowItem-wrp">
                            <div class="item">
                                <span class="item-icon text-center h1"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-slider-wrapper">
                    @foreach ($viewer->referrers as $user)
                        <a class="each-panel rowItem" href="{{ route('incentives.teams') }}?user_id={{ $user->id }}">
                            <div class="rowItem-wrp secondRow">
                                <div class="item">
                                    <div class="item-icon mb-2">
                                        <p>{{ isset($user->rank) ? $user->rank->rank->level : '0'}}</p>
                                        <img src="{{ asset('images/svg/IconRANK.svg') }}">
                                    </div>
                                    <span class="name-label mb-1">{{ $user->getFullname() }}</span>
                                    <span class="score-label mb-1">{{ $user->referrers->count() }}</span>
                                    <div class="d-flex align-items-center">
                                        <span class="date-icon mr-2 {{ isset($user->rank) ? 'active' : '' }}"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                        <span class="date-label">{{ date_format($user->created_at, "d.m.Y" )}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
				</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script src="{{ asset('plugin/slick/slick.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let timer = null;
    var levels = [];
    var keyword = '';

    $('.poolItem').on('click', function() {
        var level = $(this).attr('attr-data');
        var className = '.level-' + level;
        if (levels.indexOf(level) < 0) {
            levels.push(level);
            if (!$(className).hasClass('active')) {
                $(className).addClass('active');
            }
        } else {
            levels.splice(levels.indexOf(level), 1);
            if ($(className).hasClass('active')) {
                $(className).removeClass('active');
            }
        }
        if(keyword == '' && !levels.length) {
            $('.member-body').hide();
            return;
        } else {
            var options = {
                keyword: keyword,
                levels: level
            };
            $.ajax({
                url: '{{ route("incentives.teams.search") }}',
                method: "POST",
                data: options,
                success:function(res){
                    $('.member-body').html(res);
                    $('.member-body').show();
                },
                error:function(err){
                    toastr['error']('Error');
                }
            })
        }
    })
    

    $('#trackerSearchKey').on('keyup', function() {
        const key = $(this).val();
        if (timer) {
            clearTimeout(timer)
        }
        timer = setTimeout(function() {
            keyword = key;
            if(key == '' && !levels.length) {
                $('.member-body').hide();
            } else {
                var options = {
                    keyword: key,
                    levels: levels.join(',')
                };
                $.ajax({
                    url: '{{ route("incentives.teams.search") }}',
                    method: "POST",
                    data: options,
                    success:function(res){
                        $('.member-body').html(res);
                        $('.member-body').show();
                    },
                    error:function(err){
                        toastr['error']('Error');
                    }
                })
            }
        }, 1000);
    })

	$(document).ready(function(){
        $('.image-slider-wrapper').slick({
            infinite: false,
            slidesToShow: 3,
            draggable: true,
            arrows: true,
            dots: false,
            focusOnSelect: false,
        });
    });
</script>
@endsection