@extends('layouts.app', ['ACTIVE_TITLE' => 'STUDIO', 'ROUTES' => [
  ['ROUTE' => 'studio.index', 'ACTIVE' => 'all', 'ACTIVE_ROUTE' => true]], 'ACTIVE_PAGE' => 'all'])

@section('title', __('- Studio'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')
<div class="main-bg">
    <div class="menu">
        <div class="m-0 p-0 tab left-menu menuItem">
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div class="thumbnail-card portfolio-image tablinks active" onclick="openTab(event, 'studio1')">
                        <p>1</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div class="thumbnail-card portfolio-image tablinks" onclick="openTab(event, 'studio2')">
                        <p>2</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div class="thumbnail-card portfolio-image tablinks" onclick="openTab(event, 'studio3')">
                        <p>3</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div class="thumbnail-card portfolio-image tablinks" onclick="openTab(event, 'studio4')">
                        <p>4</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div class="thumbnail-card portfolio-image color-change-white {{ $user->profile->darken_mode_1 == 0 ? 'active' : '' }}" onclick="imgColorToWhite()">
                        <img src="{{ asset('images/svg/ImageIconWhite.svg') }}">
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div class="thumbnail-card portfolio-image color-change-black {{ $user->profile->darken_mode_1 == 1 ? 'active' : '' }}" onclick="imgColorToBlack()">
                        <img src="{{ asset('images/svg/ImageIconBlue.svg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center m-0 p-0 w-100 studio-section"> 
        <div class="col-lg-6 p-0">
            <div class="row justify-content-center m-0 p-0 w-100">
                <div class="col-12 col-sm-12 studioItem" id="studio">
                    <div class="studioItem-wrp tabcontent" id="studio1">
                        @if(isset($user->profile->studio_image1))
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-1 {{ $user->profile->darken_mode_1 == 0 ? 'd-none' : '' }}"></div>
                            <img class="studio-image" alt="Studio image" src="{{ $user->profile->studio_image1 }}">
                        </div>
                        @else
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-1 {{ $user->profile->darken_mode_1 == 0 ? 'd-none' : '' }}"></div>
                        </div>
                        @endif
                        <div class="header-1">
                            @if(isset($user->profile->studio_header1) && strlen($user->profile->studio_header1) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_header1)) !!}
                            @else
                                <p class="studio-header">HEADER</p>
                            @endif
                        </div>

                        <div class="content-1">
                            @if(isset($user->profile->studio_content1) && strlen($user->profile->studio_content1) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_content1)) !!}
                            @else
                                <p class="studio-content">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-1">
                            @if(isset($user->profile->studio_footer1) && strlen($user->profile->studio_footer1) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_footer1)) !!}
                            @else
                                <p class="studio-footer">FOOTER</p>
                            @endif
                        </div>
                    </div>
                    <div class="studioItem-wrp tabcontent" id="studio2">
                        @if(isset($user->profile->studio_image2))
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-2 {{ $user->profile->darken_mode_2 == 0 ? 'd-none' : '' }}"></div>
                            <img class="studio-image" alt="Studio image" src="{{ $user->profile->studio_image2 }}">
                        </div>
                        @else
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-2 {{ $user->profile->darken_mode_2 == 0 ? 'd-none' : '' }}"></div>
                        </div>
                        @endif
                        <div class="header-2">
                            @if(isset($user->profile->studio_header2) && strlen($user->profile->studio_header2) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_header2)) !!}
                            @else
                                <p class="studio-header-2">HEADER</p>
                            @endif
                        </div>

                        <div class="content-2">
                            @if(isset($user->profile->studio_content2) && strlen($user->profile->studio_content2) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_content2)) !!}
                            @else
                                <p class="studio-content-2">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-2">
                            @if(isset($user->profile->studio_footer2) && strlen($user->profile->studio_footer2) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_footer2)) !!}
                            @else
                                <p class="studio-footer-2">FOOTER</p>
                            @endif
                        </div>
                    </div>
                    <div class="studioItem-wrp tabcontent small-image" id="studio3">
                        @if(isset($user->profile->studio_image3))
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-3 {{ $user->profile->darken_mode_3 == 0 ? 'd-none' : '' }}"></div>
                            <img class="studio-image" alt="Studio image" src="{{ $user->profile->studio_image3 }}">
                        </div>
                        @else
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-3 {{ $user->profile->darken_mode_3 == 0 ? 'd-none' : '' }}"></div>
                        </div>
                        @endif
                        <div class="header-3">
                            @if(isset($user->profile->studio_header3) && strlen($user->profile->studio_header3) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_header3)) !!}
                            @else
                                <p class="studio-header">HEADER</p>
                            @endif
                        </div>

                        <div class="content-3">
                            @if(isset($user->profile->studio_content3) && strlen($user->profile->studio_content3) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_content3)) !!}
                            @else
                                <p class="studio-content">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-3">
                            @if(isset($user->profile->studio_footer3) && strlen($user->profile->studio_footer3) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_footer3)) !!}
                            @else
                                <p class="studio-footer">FOOTER</p>
                            @endif
                        </div>
                    </div>
                    <div class="studioItem-wrp tabcontent small-image" id="studio4">
                        @if(isset($user->profile->studio_image4))
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-4 {{ $user->profile->darken_mode_4 == 0 ? 'd-none' : '' }}"></div>
                            <img class="studio-image" alt="Studio image" src="{{ $user->profile->studio_image4 }}">
                        </div>
                        @else
                        <div class="thumbnail-card portfolio-image">
                            <div class="image-container blur-image-4 {{ $user->profile->darken_mode_4 == 0 ? 'd-none' : '' }}"></div>
                        </div>
                        @endif
                        <div class="header-4 header-2">
                            @if(isset($user->profile->studio_header4) && strlen($user->profile->studio_header4) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_header4)) !!}
                            @else
                                <p class="studio-header-2">HEADER</p>
                            @endif
                        </div>

                        <div class="content-4 content-2">
                            @if(isset($user->profile->studio_content4) && strlen($user->profile->studio_content4) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_content4)) !!}
                            @else
                                <p class="studio-content-2">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-4 footer-2">
                            @if(isset($user->profile->studio_footer4) && strlen($user->profile->studio_footer4) > 0)
                                {!! str_replace(' editable" contenteditable="true','',html_entity_decode($user->profile->studio_footer4)) !!}
                            @else
                                <p class="studio-footer-2">FOOTER</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="m-0 p-0 row right-menu menuItem">
            <div class="d-flex menuSubItem">
                <div class="child">
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/T1.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/plus.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/ArrowUp.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/DotWhite.svg') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="child">
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/T2.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/minus.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/ArrowDown.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/DotBlue.svg') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menuBtnItem">
                <div class="w-100">
                    <div class="contentItem w-100">
                        <div class="contentItem-wrp btn-section w-100">
                            <div class="text-card portfolio-image edit-btn">
                                <p class="my-0">EDIT</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="contentItem w-100">
                        <div class="contentItem-wrp btn-section w-100">
                            <div class="text-card portfolio-image download-btn">
                                <p class="my-0">DOWNLOAD</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    document.getElementById("studio1").style.display = "block";
    var currentTab = "studio1";

    function openTab(evt, studio) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(studio).style.display = "block";
        evt.currentTarget.className += " active";
        currentTab = studio;
        switch(studio) {
            case "studio1":
                if ($('.blur-image-1').hasClass('d-none')) {
                    $('.color-change-white').addClass('active');
                    $('.color-change-black').removeClass('active');
                }
                else {
                    $('.color-change-white').removeClass('active');
                    $('.color-change-black').addClass('active');
                }
                break;
            case "studio2":
                if ($('.blur-image-2').hasClass('d-none')) {
                    $('.color-change-white').addClass('active');
                    $('.color-change-black').removeClass('active');
                }
                else {
                    $('.color-change-white').removeClass('active');
                    $('.color-change-black').addClass('active');
                }
                break;
            case "studio3":
                if ($('.blur-image-3').hasClass('d-none')) {
                    $('.color-change-white').addClass('active');
                    $('.color-change-black').removeClass('active');
                }
                else {
                    $('.color-change-white').removeClass('active');
                    $('.color-change-black').addClass('active');
                }
                break;
            case "studio4":
                if ($('.blur-image-4').hasClass('d-none')) {
                    $('.color-change-white').addClass('active');
                    $('.color-change-black').removeClass('active');
                }
                else {
                    $('.color-change-white').removeClass('active');
                    $('.color-change-black').addClass('active');
                }
                break;
        }
    }

    $(".edit-btn").click(function() {
        window.location.href = '{{ route('studio.edit') }}?option=' + currentTab;
    });

    $(".download-btn").click(function() {
        html2canvas(document.querySelector("#studio"), {scale: 1.6}).then(canvas => {
            const link = document.createElement('a');
            link.href = canvas.toDataURL("image/jpeg", 0.5);
            link.download = 'studio_image.png';
            link.click();
        });
    });

    function imgColorToWhite() {
        switch (currentTab) {
            case "studio1" : 
                $('.blur-image-1').addClass('d-none');
                break;
            case "studio2" : 
                $('.blur-image-2').addClass('d-none');
                break;
            case "studio3" : 
                $('.blur-image-3').addClass('d-none');
                break;
            case "studio4" : 
                $('.blur-image-4').addClass('d-none');
                break;
        }
        $('.color-change-white').addClass('active');
        $('.color-change-black').removeClass('active');
    }

    function imgColorToBlack() {
        switch (currentTab) {
            case "studio1" : 
                $('.blur-image-1').removeClass('d-none');
                break;
            case "studio2" : 
                $('.blur-image-2').removeClass('d-none');
                break;
            case "studio3" : 
                $('.blur-image-3').removeClass('d-none');
                break;
            case "studio4" : 
                $('.blur-image-4').removeClass('d-none');
                break;
        }
        $('.color-change-black').addClass('active');
        $('.color-change-white').removeClass('active');
    }
    
</script>
@endsection