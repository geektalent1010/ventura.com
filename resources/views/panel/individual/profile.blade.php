@extends('layouts.app', ['ACTIVE_TITLE' => 'MY PAGE', 'ROUTES' => [
  ['ROUTE' => 'profile', 'ACTIVE' => 'profile', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'profile.detail', 'ACTIVE' => 'detail', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'profile'])

@section('title', __('- Individual Profile'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

@php
    $birthday = date_create($user->profile->birthday);
@endphp
<div class="main-bg">
    <div class="row m-0 mx-auto p-0 profile-section">
        <div class="row justify-content-center m-0 p-0 w-100">
            <div class="col-md-6 p-0">
                <div class="row p-0 m-0">
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 contentItem">
                        @if(isset($user->profile->main_avatar_url))
                            <a class="contentItem-wrp profile-avartar-wrp face" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->main_avatar_url.'?'.time()) }}">
                                <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->main_avatar_url.'?'.time()) }}">
                            </a>
                        @else
                            <div class="contentItem-wrp profile-avartar-wrp face">
                                <div class="thumbnail-card main_avatar_card_bg profile-avatar" attr-data="main_avatar">
                                    <p class="first_letter">{{ $user->getMono() }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-9 col-sm-9 col-md-9 col-lg-9 contentItem profile-person-section">
                        <div class="person-info-section h-100">
                            <div class="profile-card d-flex align-items-center h-100 flat-scroll">
                                <div class="profile-content pl-3">
                                    <p class="profile-card-title">{{ $user->getFullname() }}</p>
                                    <p class="profile-card-context">{{ $user->profile->company_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-12 contentItem">
                    @if(isset($user->profile->banner_img_url))
                        <a class="contentItem-wrp main-avatar" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->banner_img_url.'?'.time()) }}">
                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->banner_img_url.'?'.time()) }}">
                        </a>
                    @else
                        <div class="contentItem-wrp main-avatar">
                            <div class="thumbnail-card main_avatar_card_bg" attr-data="main_avatar">
                                
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-sm-12 contentItem">
                    <div class="story-content-wrp">
                        <div class="my-story-card">
                            <div class="d-flex">
                                <div class="about">
                                    <p class="story-card-title">About Me</p>
                                </div>
                                <div class="d-flex buddies-icon justify-content-end">
                                    <div>
                                        <img src="{{ asset('images/svg/IconFRIENDS.svg') }}" class="position-relative" />
                                    </div> 
                                    <p class="profile-card-context buddies-count">{{ $friends->count() ?? 0 }}</p>
                                </div>
                            </div>
                            @if (isset($user->profile->story_content))
                            <div class="story-card-context mr-2">
                                @php
                                    echo $user->profile->story_content;
                                @endphp
                            </div>
                            @endif
                        </div>                                         
                    </div>
                </div>
                <div class="col-12 contentItem interests-section">
                    <div class="profile-card profile-card-bg d-flex flat-scroll">
                        <div class="profile-content">
                            <p class="profile-card-title">{{ empty($country) ? isset($user->profile->country) ? $user->profile->country : '' : $country }}</p>
                            <p class="profile-card-context">{{ empty($city) ? isset($user->profile->city) ? $user->profile->city : '' : $city }}</p>
                            @if(!$is_me)
                            <div class="connect-btn-section">
                                <a href="{{ route('connect.request', ['userID' => $user->id ]) }}" class="btn btn-primary profile-connect-btn">CONNECT</a>
                            </div>
                            @endif
                        </div>  
                        <div class="profile-content">
                            <p class="profile-card-title">Contact</p>
                            <div class="d-flex align-items-center profile-card-context">
                                <span class="contact-info-icon mr-2"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <span class="profile-card-context mb-0">{{ (str_contains($user->profile->display_options, 'p')) ? $user->profile->phone : 'Phone' }}</span>
                            </div>
                            <div class="d-flex align-items-center profile-card-context my-1">
                                <span class="contact-info-icon mr-2"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                <span class="profile-card-context mb-0">{{ (str_contains($user->profile->display_options, 'e')) ? $user->email : 'Email' }}</span>
                            </div>
                            <div class="d-flex align-items-center profile-card-context">
                                <span class="contact-info-icon mr-2 arrow"><i class="fa fa-mouse-pointer" aria-hidden="true"></i></span>
                                <span class="profile-card-context mb-0">{{ (str_contains($user->profile->display_options, 'w')) ? $user->profile->site_url : 'Website' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-12 p-0">
                    <div class="row justify-content-center m-0 p-0 w-100 card-border-wrp">
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url1))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url1.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url1.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url2))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url2.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url2.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url3))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url3.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url3.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url4))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url4.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url4.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url5))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url5.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url5.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url6))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url6.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url6.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url7))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url7.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url7.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                            @if(isset($user->profile->other_avatar_url8))
                                <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url8.'?'.time()) }}">
                                    <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url8.'?'.time()) }}">
                                </a>
                            @else
                                <div class="contentItem-wrp">
                                    <div class="thumbnail-card">
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if($is_me)
                    <div class="row justify-content-center align-items-center mt-4 mb-5 btn-section w-100 p-0 m-0">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary profile-edit-btn">EDIT</a>
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
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        Fancybox.bind('[data-fancybox]', {
          Toolbar: {
            display: [
              "close",
            ],
          },
        });
    });
</script>
@endsection