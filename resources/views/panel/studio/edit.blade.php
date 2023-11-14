@extends('layouts.app', ['ACTIVE_TITLE' => 'STUDIO', 'ROUTES' => [
  ['ROUTE' => 'studio.edit', 'ACTIVE' => 'all', 'ACTIVE_ROUTE' => true]], 'ACTIVE_PAGE' => 'all'])

@section('title', __('- Studio'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.Jcrop.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/crop_style.css') }}" />
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')
<div class="main-bg">
    <div class="menu">
        <div class="m-0 p-0 tab left-menu menuItem">
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div id="studio1-tab" class="thumbnail-card portfolio-image tablinks active" onclick="openTab(event, 'studio1')">
                        <p>1</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div id="studio2-tab" class="thumbnail-card portfolio-image tablinks" onclick="openTab(event, 'studio2')">
                        <p>2</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div id="studio3-tab" class="thumbnail-card portfolio-image tablinks" onclick="openTab(event, 'studio3')">
                        <p>3</p>
                    </div>
                </div>
            </div>
            <div class="contentItem">
                <div class="contentItem-wrp">
                    <div id="studio4-tab" class="thumbnail-card portfolio-image tablinks" onclick="openTab(event, 'studio4')">
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
                <div class="col-12 col-sm-12 studioItem">
                    <div class="studioItem-wrp tabcontent" id="studio1">
                        <div class="thumbnail-card portfolio-image" attr-data="studio-image-1">
                            <img class="option-icon image-upload plus-studio-image-1 {{ $user->profile->studio_image1 ? 'd-none' : '' }}" attr-data="studio-image-1" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                            <span class="option-icon image-remove remove-studio-image-1 {{ $user->profile->studio_image1 ? '' : 'd-none' }}" attr-data="studio-image-1"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            <div class="image-container blur-image-1 {{ $user->profile->darken_mode_1 == 0 ? 'd-none' : '' }}"></div>
                            <div class="cropme" attr-data="studio-image-1"></div>
                            <img src="{{ $user->profile->studio_image1 }}" class="studio-image remove-studio-image-1 {{ $user->profile->studio_image1 ? '' : 'd-none' }}" />
                        </div>
                        
                        <div class="header-1">
                            @if(isset($user->profile->studio_header1) && strlen($user->profile->studio_header1) > 0)
                                {!! html_entity_decode($user->profile->studio_header1) !!}
                            @else
                                <p class="studio-header editable" contenteditable="true">HEADER</p>
                            @endif
                        </div>

                        <div class="content-1">
                            @if(isset($user->profile->studio_content1) && strlen($user->profile->studio_content1) > 0)
                                {!! html_entity_decode($user->profile->studio_content1) !!}
                            @else
                                <p class="studio-content editable" contenteditable="true">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-1">
                            @if(isset($user->profile->studio_footer1) && strlen($user->profile->studio_footer1) > 0)
                                {!! html_entity_decode($user->profile->studio_footer1) !!}
                            @else
                                <p class="studio-footer editable" contenteditable="true">FOOTER</p>
                            @endif
                        </div>
                    </div>
                    <div class="studioItem-wrp tabcontent" id="studio2">
                        <div class="thumbnail-card portfolio-image" attr-data="studio-image-2">
                            <img class="option-icon image-upload plus-studio-image-2 {{ $user->profile->studio_image2 ? 'd-none' : '' }}" attr-data="studio-image-2" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                            <span class="option-icon image-remove remove-studio-image-2 {{ $user->profile->studio_image2 ? '' : 'd-none' }}" attr-data="studio-image-2"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            <div class="image-container blur-image-2 {{ $user->profile->darken_mode_2 == 0 ? 'd-none' : '' }}"></div>
                            <div class="cropme" attr-data="studio-image-2"></div>
                            <img src="{{ $user->profile->studio_image2 }}" class="studio-image remove-studio-image-2 {{ $user->profile->studio_image2 ? '' : 'd-none' }}" />
                        </div>
                        
                        <div class="header-2">
                            @if(isset($user->profile->studio_header2) && strlen($user->profile->studio_header2) > 0)
                                {!! html_entity_decode($user->profile->studio_header2) !!}
                            @else
                                <p class="studio-header-2 editable" contenteditable="true">HEADER</p>
                            @endif
                        </div>

                        <div class="content-2">
                            @if(isset($user->profile->studio_content2) && strlen($user->profile->studio_content2) > 0)
                                {!! html_entity_decode($user->profile->studio_content2) !!}
                            @else
                                <p class="studio-content-2 editable" contenteditable="true">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-2">
                            @if(isset($user->profile->studio_footer2) && strlen($user->profile->studio_footer2) > 0)
                                {!! html_entity_decode($user->profile->studio_footer2) !!}
                            @else
                                <p class="studio-footer-2 editable" contenteditable="true">FOOTER</p>
                            @endif
                        </div>
                    </div>
                    <div class="studioItem-wrp tabcontent small-image" id="studio3">
                        <div class="thumbnail-card portfolio-image" attr-data="studio-image-3">
                            <img class="option-icon image-upload plus-studio-image-3 {{ $user->profile->studio_image3 ? 'd-none' : '' }}" attr-data="studio-image-3" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                            <span class="option-icon image-remove remove-studio-image-3 {{ $user->profile->studio_image3 ? '' : 'd-none' }}" attr-data="studio-image-3"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            <div class="image-container blur-image-3 {{ $user->profile->darken_mode_3 == 0 ? 'd-none' : '' }}"></div>
                            <div class="cropme" attr-data="studio-image-3"></div>
                            <img src="{{ $user->profile->studio_image3 }}" class="studio-image remove-studio-image-3 {{ $user->profile->studio_image3 ? '' : 'd-none' }}" />
                        </div>
                        
                        <div class="header-3">
                            @if(isset($user->profile->studio_header3) && strlen($user->profile->studio_header3) > 0)
                                {!! html_entity_decode($user->profile->studio_header3) !!}
                            @else
                                <p class="studio-header editable" contenteditable="true">HEADER</p>
                            @endif
                        </div>

                        <div class="content-3">
                            @if(isset($user->profile->studio_content3) && strlen($user->profile->studio_content3) > 0)
                                {!! html_entity_decode($user->profile->studio_content3) !!}
                            @else
                                <p class="studio-content editable" contenteditable="true">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-3">
                            @if(isset($user->profile->studio_footer3) && strlen($user->profile->studio_footer3) > 0)
                                {!! html_entity_decode($user->profile->studio_footer3) !!}
                            @else
                                <p class="studio-footer editable" contenteditable="true">FOOTER</p>
                            @endif
                        </div>
                    </div>
                    <div class="studioItem-wrp tabcontent small-image" id="studio4">
                        <div class="thumbnail-card portfolio-image" attr-data="studio-image-4">
                            <img class="option-icon image-upload plus-studio-image-4 {{ $user->profile->studio_image4 ? 'd-none' : '' }}" attr-data="studio-image-4" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                            <span class="option-icon image-remove remove-studio-image-4 {{ $user->profile->studio_image4 ? '' : 'd-none' }}" attr-data="studio-image-4"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            <div class="image-container blur-image-4 {{ $user->profile->darken_mode_4 == 0 ? 'd-none' : '' }}"></div>
                            <div class="cropme" attr-data="studio-image-4"></div>
                            <img src="{{ $user->profile->studio_image4 }}" class="studio-image remove-studio-image-4 {{ $user->profile->studio_image4 ? '' : 'd-none' }}" />
                        </div>
                        
                        <div class="header-4 header-2">
                            @if(isset($user->profile->studio_header4) && strlen($user->profile->studio_header4) > 0)
                                {!! html_entity_decode($user->profile->studio_header4) !!}
                            @else
                                <p class="studio-header-2 editable" contenteditable="true">HEADER</p>
                            @endif
                        </div>

                        <div class="content-4 content-2">
                            @if(isset($user->profile->studio_content4) && strlen($user->profile->studio_content4) > 0)
                                {!! html_entity_decode($user->profile->studio_content4) !!}
                            @else
                                <p class="studio-content-2 editable" contenteditable="true">Content</p>
                            @endif
                        </div>                        

                        <div class="footer-4 footer-2">
                            @if(isset($user->profile->studio_footer4) && strlen($user->profile->studio_footer4) > 0)
                                {!! html_entity_decode($user->profile->studio_footer4) !!}
                            @else
                                <p class="studio-footer-2 editable" contenteditable="true">FOOTER</p>
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
                                <img src="{{ asset('images/svg/T1.svg') }}" onclick="increaseFontWeight()">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/plus.svg') }}" onclick="increaseFontSize()">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/ArrowUp.svg') }}" onclick = "ChangePositionUp()">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/DotWhite.svg') }}" onclick="changeFontColorWhite()">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="child">
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/T2.svg') }}" onclick="decreaseFontWeight()">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/minus.svg') }}" onclick="decreaseFontSize()">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/ArrowDown.svg') }}" onclick = "ChangePositionDown()">
                            </div>
                        </div>
                    </div>
                    <div class="contentItem">
                        <div class="contentItem-wrp">
                            <div class="text-card portfolio-image">
                                <img src="{{ asset('images/svg/DotBlue.svg') }}" onclick="changeFontColorBlack()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menuBtnItem">
                <div class="w-100">
                    <div class="contentItem w-100">
                        <div class="contentItem-wrp btn-section w-100">
                            <div class="text-card portfolio-image save-btn">
                                <p class="my-0">SAVE</p>
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
<script src="{{ asset('js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('js/jquery.SimpleCropper.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    document.getElementById("studio1").style.display = "block";
    var currentTab = "studio1";
    var darken_mode_1 = 0;
    var darken_mode_2 = 0;
    var darken_mode_3 = 0;
    var darken_mode_4 = 0;

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

    var image_url = '';
    var file = null;

    $('.cropme').simpleCropper();

    $(".cropme").click(function() {
        image_url = $(this).attr('attr-data');
    });

    function image_upload(file_data) {
        var img_src = $(".cropme").find("img").attr("src");
        var form_data = new FormData();
        form_data.append('img_src', img_src);
        form_data.append('field', image_url);
        $.ajax({
            type: 'POST',
            url: '{{ route('studio.image.upload') }}',
            processData: false,
            contentType: false,
            cache: false,
            data : form_data,
            success:function(data){
                if (data.error) {
                    toastr['error'](data.error, 'Error');
                } else {
                    toastr['success'](data.success, 'Success');
                    
                }
            },
            error:function(data){
                console.log(data);
            }
        }); 

        if (image_url == 'studio-image-1') {
            $('.remove-studio-image-1').attr('src', URL.createObjectURL(file_data));
            $('.plus-studio-image-1').addClass('d-none');
            if ($('.remove-studio-image-1').hasClass('d-none')) {
                $('.remove-studio-image-1').removeClass('d-none')
            }
        }
        else if (image_url == 'studio-image-2') {
            $('.remove-studio-image-2').attr('src', URL.createObjectURL(file_data));
            $('.plus-studio-image-2').addClass('d-none');
            if ($('.remove-studio-image-2').hasClass('d-none')) {
                $('.remove-studio-image-2').removeClass('d-none')
            }
        }
        else if (image_url == 'studio-image-3') {
            $('.remove-studio-image-3').attr('src', URL.createObjectURL(file_data));
            $('.plus-studio-image-3').addClass('d-none');
            if ($('.remove-studio-image-3').hasClass('d-none')) {
                $('.remove-studio-image-3').removeClass('d-none')
            }
        }
        else if (image_url == 'studio-image-4') {
            $('.remove-studio-image-4').attr('src', URL.createObjectURL(file_data));
            $('.plus-studio-image-4').addClass('d-none');
            if ($('.remove-studio-image-4').hasClass('d-none')) {
                $('.remove-studio-image-4').removeClass('d-none')
            }
        }
        
        const blobURL = URL.createObjectURL(file_data);
        const img = new Image();
        img.src = blobURL;
        
        img.onload = function () {
            const MAX_WIDTH = 1080;
            const MAX_HEIGHT = 675;
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            canvas.toBlob(
                (blob) => {
                // Handle the compressed image.
                file = blob;
                },
                "image/jpeg",
                quality
            );
        };
    }

    $(".image-remove").click(function() {
        var send_data = {};
        send_data['id'] = '{{$user->profile->id}}';
        send_data['field'] = $(this).attr('attr-data');
        $.ajax({
          type: 'PUT',
          url: '{{ route('studio.remove.image') }}',
          data: send_data,
          success: function(data) {
            toastr['success'](data.success, 'Success');
            
          }
        })
        $("input[id='studio-image-file']").val('');

        image_url = $(this).attr('attr-data');
        $(".cropme").find("img").addClass('d-none');
        if (image_url == 'studio-image-1') {
            $('.remove-studio-image-1').addClass('d-none');
            if ($('.plus-studio-image-1').hasClass('d-none')) {
                $('.plus-studio-image-1').removeClass('d-none')
            }
        }
        else if (image_url == 'studio-image-2') {
            $('.remove-studio-image-2').addClass('d-none');
            if ($('.plus-studio-image-2').hasClass('d-none')) {
                $('.plus-studio-image-2').removeClass('d-none')
            }
        }
        else if (image_url == 'studio-image-3') {
            $('.remove-studio-image-3').addClass('d-none');
            if ($('.plus-studio-image-3').hasClass('d-none')) {
                $('.plus-studio-image-3').removeClass('d-none')
            }
        }
        else if (image_url == 'studio-image-4') {
            $('.remove-studio-image-4').addClass('d-none');
            if ($('.plus-studio-image-4').hasClass('d-none')) {
                $('.plus-studio-image-4').removeClass('d-none')
            }
        }        
    });

    function increaseFontSize() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            if (range.startContainer.nodeName !== 'DIV') {
                var span = document.createElement('span');
                span.style.fontSize = 'larger';
                range.surroundContents(span);
            }
            
        }
    }

    function decreaseFontSize() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            if (range.startContainer.nodeName !== 'DIV') {
                var span = document.createElement('span');
                span.style.fontSize = 'smaller';
                range.surroundContents(span);
            }
        }
    }

    function increaseFontWeight() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            if (range.startContainer.nodeName !== 'DIV') {
                var span = document.createElement('span');
                span.classList.add('montserrat');
                range.surroundContents(span);
            }
        }
    }

    function decreaseFontWeight() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            if (range.startContainer.nodeName !== 'DIV') {
                var span = document.createElement('span');
                span.classList.add('times-new-roman');
                // span.style.fontFamily = 'Times New Roman';
                range.surroundContents(span);
            }
        }
    }

    function changeFontColorWhite() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            if (range.startContainer.nodeName !== 'DIV') {
                var span = document.createElement('span');
                span.style.color = 'white';
                range.surroundContents(span);
            }
        }
    }

    function changeFontColorBlack() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            if (range.startContainer.nodeName !== 'DIV') {
                var span = document.createElement('span');
                span.style.color = 'black';
                range.surroundContents(span);
            }
        }
    }

    function ChangePositionUp() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            var parentElement = range.commonAncestorContainer;
            while (parentElement && parentElement.tagName !== 'P') {
                parentElement = parentElement.parentNode;
            }
            if (parentElement) { // Add null check
                if (parentElement.className.includes("footer")) {
                    var currentBottom = parseInt(window.getComputedStyle(parentElement).bottom) || 0;
                    var newBottom = currentBottom + 5;
                    parentElement.style.bottom = newBottom + 'px';
                } else {
                    var currentTop = parseInt(window.getComputedStyle(parentElement).top) || 0;
                    var newTop = currentTop - 5;
                    parentElement.style.top = newTop + 'px';
                }
            }
        }
    }

    function ChangePositionDown() {
        var selection = window.getSelection();
        if (selection.rangeCount > 0) {
            var range = selection.getRangeAt(0);
            var parentElement = range.commonAncestorContainer;
            while (parentElement && parentElement.tagName !== 'P') {
                parentElement = parentElement.parentNode;
            }
            if (parentElement) { // Add null check
                if (parentElement.className.includes("footer")) {
                    var currentBottom = parseInt(window.getComputedStyle(parentElement).bottom) || 0;
                    var newBottom = currentBottom - 5;
                    parentElement.style.bottom = newBottom + 'px';
                }
                else {
                    var currentTop = parseInt(window.getComputedStyle(parentElement).top) || 0;
                    var newTop = currentTop + 5;
                    parentElement.style.top = newTop + 'px';
                }
            }
        }
    }

    $('.save-btn').on('click', function() {
        var form_data = new FormData();
        var header1 = $('.header-1').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var content1 = $('.content-1').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var footer1 = $('.footer-1').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var header2 = $('.header-2').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var content2 = $('.content-2').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var footer2 = $('.footer-2').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var header3 = $('.header-3').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var content3 = $('.content-3').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var footer3 = $('.footer-3').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var header4 = $('.header-4').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var content4 = $('.content-4').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        var footer4 = $('.footer-4').html().replace(/<div>/g, '<br>').replace(/<\/div>/g, '');
        form_data.append('id', '{{ $user->profile->id}}');
        form_data.append('header1', header1);
        form_data.append('content1', content1);
        form_data.append('footer1', footer1);
        form_data.append('header2', header2);
        form_data.append('content2', content2);
        form_data.append('footer2', footer2);
        form_data.append('header3', header3);
        form_data.append('content3', content3);
        form_data.append('footer3', footer3);
        form_data.append('header4', header4);
        form_data.append('content4', content4);
        form_data.append('footer4', footer4);

        $.ajax({
            type: 'POST',
            url: '{{ route('studio.update') }}',
            processData: false,
            contentType: false,
            cache: false,
            data : form_data,
            success:function(data){
                if (data.error) {
                toastr['error'](data.error, 'Error');
                } else {
                toastr['success'](data.success, 'Success');
                setTimeout(function() {
                    window.location.href = '{{ route('studio.index') }}';
                }, 1000);
                }
            },
            error:function(data){
                console.log(data);
            }
        });
    })

    function imgColorToWhite() {
        switch (currentTab) {
            case "studio1" : 
                $('.blur-image-1').addClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_1'] = 0;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode1') }}',
                    data: send_data,
                    success: function(data) {
                        
                    }
                });
                break;
            case "studio2" : 
                $('.blur-image-2').addClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_2'] = 0;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode2') }}',
                    data: send_data,
                    success: function(data) {
                        
                    }
                });
                break;
            case "studio3" : 
                $('.blur-image-3').addClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_3'] = 0;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode3') }}',
                    data: send_data,
                    success: function(data) {
                        
                    }
                });
                break;
            case "studio4" : 
                $('.blur-image-4').addClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_4'] = 0;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode4') }}',
                    data: send_data,
                    success: function(data) {
                        
                    }
                });
                break;
        }
        $('.color-change-white').addClass('active');
        $('.color-change-black').removeClass('active');
    }

    function imgColorToBlack() {
        switch (currentTab) {
            case "studio1" : 
                $('.blur-image-1').removeClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_1'] = 1;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode1') }}',
                    data: send_data,
                    success: function(data) {
                        
                    }
                });
                break;
            case "studio2" : 
                $('.blur-image-2').removeClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_2'] = 1;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode2') }}',
                    data: send_data,
                    success: function(data) {
                    }
                });
                break;
            case "studio3" : 
                $('.blur-image-3').removeClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_3'] = 1;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode3') }}',
                    data: send_data,
                    success: function(data) {
                        
                    }
                });
                break;
            case "studio4" : 
                $('.blur-image-4').removeClass('d-none');
                var send_data = {};
                send_data['id'] = '{{$user->profile->id}}';
                send_data['darken_mode_4'] = 1;
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('studio.update.mode4') }}',
                    data: send_data,
                    success: function(data) {
                    
                    }
                });
                break;
        }
        $('.color-change-black').addClass('active');
        $('.color-change-white').removeClass('active');
    }


    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('option');
        if (myParam) {
            openTab({currentTarget: document.getElementById(myParam + '-tab')}, myParam)
        }
    });
</script>
@endsection