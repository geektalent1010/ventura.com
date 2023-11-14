@extends('layouts.app', ['ACTIVE_TITLE' => 'PROFILE', 'ROUTES' => [
  ['ROUTE' => 'profile', 'ACTIVE' => 'edit', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'edit'])

@section('title', __('- Edit'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.Jcrop.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/crop_style.css') }}" />
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

@php
    $main_interests = explode(",", $user->profile->main_interests);
    $categories = array(
        'Automotive' => 'Automotive',
        'Business_Support' => 'Business Support',
        'Computers_Electronics' => 'Computers & Electronics',
        'Construction_Contractors' => 'Construction & Contractors',
        'Education' => 'Education',
        'Entertainment' => 'Entertainment',
        'Food_Dining' => 'Food & Dining',
        'Health_Medicine' => 'Health & Medicine',
        'Home_Garden' => 'Home & Garden',
        'Legal_Financial' => 'Legal & Financial',
        'Manufacturing_Wholesale_Distribution' => 'Manufacturing, Wholesale, Distribution',
        'Merchants_Retail' => 'Merchants, Retail',
        'Miscellaneous' => 'Miscellaneous',
        'Personal_Care_Services' => 'Personal Care & Services',
        'Real_Estate' => 'Real Estate',
        'Travel_Transportation' => 'Travel & Transportation',
    );
@endphp
<div class="main-bg">
    <div class="row m-0 mx-auto p-0 setting-section">
        <input type="file" id="profile-avatar-file" style="display: none;" accept=".jpg,.jpeg,.png" onchange="image_upload()" />
        <div class="row justify-content-center m-0 p-0 w-100">
            <div class="col-md-6 p-0">
            <div class="row p-0 m-0">
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 contentItem">
                        @if(isset($user->profile->main_avatar_url))
                            <div class="contentItem-wrp">
                                <div class="optional-section">
                                    <span class="option-icon trash-avatar" attr-data="main_avatar"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                                <div class="image-container"></div>
                                <img class="avatar" alt="main avatar" src="{{ asset('uploads/'.$user->username.'/'.$user->profile->main_avatar_url.'?'.time()) }}">
                            </div>
                        @else
                            <div class="cropme contentItem-wrp profile-avatar-wrp">
                                <div class="thumbnail-card profile-avatar" attr-data="main_avatar">
                                    <input id="selectedFile" class="file-selector__input" type='file' accept=".png, .jpg, .jpeg, .svg">
                                    <img id='crop__result' src=''>
                                    <img class="option-icon" attr-data="main_avatar" src="{{ asset('images/svg/ImageGreen.svg') }}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-9 col-sm-9 col-md-9 col-lg-9 contentItem profile-person-section">
                        <div class="person-info-section h-100">
                            <div class="profile-card d-flex align-items-center h-100 flat-scroll">
                                <div class="profile-content pl-3">
                                    <p class="profile-card-title">{{ $user->profile->company_name ?? 'Company Name' }}</p>
                                    <p class="profile-card-context job-title-edit">
                                        @if (count($main_interests) > 0)
                                            @foreach($main_interests as $tag)
                                                {{ isset($categories[$tag]) ? $categories[$tag] : '' }}
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 contentItem">
                    @if(isset($user->profile->banner_img_url))
                        <div class="contentItem-wrp main-avatar">
                            <div class="optional-section banner-section">
                                <span class="option-icon trash-avatar" attr-data="banner_img"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            </div>
                            <div class="image-container"></div>
                            <img class="" alt="main avatar" src="{{ asset('uploads/'.$user->username.'/'.$user->profile->banner_img_url.'?'.time()) }}">
                        </div>
                    @else
                        <div class="contentItem-wrp main-avatar">
                            <div class="optional-section banner-section">
                                <img class="option-icon avatar-upload" attr-data="banner_img" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                            </div>
                            <div class="thumbnail-card main_avatar_card_bg">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-sm-12 contentItem story-content-border">
                    <div class="story-content-wrp">
                        <div class="my-story-card flat-scroll">
                            <p class="story-card-title">About Us</p>
                            @if (isset($user->profile->story_content))
                            <div class="story-card-context changeable story-edit" contenteditable="true">
                                @php
                                    echo $user->profile->story_content;
                                @endphp
                            </div>
                            @else
                            <div class="story-card-context changeable story-edit" contenteditable="true">
                                Type here ...
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 p-0">
                    <div class="row justify-content-center m-0 p-0 w-100">
                        <div class="company-info contentItem">
                            <div class="profile-card profile-card-bg h-100 flat-scroll">
                                <p class="profile-card-title">Address</p>
                                <p class="profile-card-context street-edit">{{ $user->profile->street }} {{ $user->profile->house_number }}</p>
                                <p class="profile-card-context code-edit">{{ $user->profile->postal_code }}</p>
                                <p class="profile-card-context city-edit">{{ empty($city) ? isset($user->profile->city) ? $user->profile->city : 'City' : $city }}</p>
                                <p class="profile-card-context country-edit">{{ empty($state) ? isset($user->profile->state) ? $user->profile->state : 'Area' : $state }}</p>
                                <p class="profile-card-context country-edit">{{ empty($country) ? isset($user->profile->country) ? $user->profile->country : 'Country' : $country }}</p>
                            </div>
                        </div>
                        <div class="contact-info contentItem">
                            <div class="profile-card profile-card-bg h-100 d-flex flex-column flat-scroll">
                                <p class="profile-card-title">Contact</p>
                                <div class="d-flex align-items-center profile-card-context">
                                    <span class="contact-info-icon mr-2"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <span class="profile-card-context mb-0 phone-edit">{{ $user->phone ?? 'Phone Number' }}</span>
                                </div>
                                <div class="d-flex align-items-center profile-card-context">
                                    <span class="contact-info-icon mr-2"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <span class="profile-card-context mb-0 email-edit">{{ $user->email ?? 'main@yourwebsite.com' }}</span>
                                </div>
                                <div class="d-flex align-items-center profile-card-context">
                                    <span class="contact-info-icon mr-2"><i class="fa fa-mouse-pointer" aria-hidden="true"></i></span>
                                    <span class="profile-card-context mb-0 site-edit">{{ $user->site_url ?? 'www.yourwebsite.com' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 p-0">
                            <div class="row justify-content-center m-0 p-0 w-100 card-border-wrp">
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->logo_url))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="company_logo"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->logo_url.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="company_logo" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url2))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail2"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url2.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail2" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url3))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail3"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url3.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail3" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url4))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail4"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url4.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail4" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url5))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail5"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url5.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail5" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url6))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail6"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url6.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail6" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url7))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail7"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url7.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail7" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 contentItem thumbnail-card-border">
                                    @if(isset($user->profile->other_avatar_url8))
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <span class="option-icon trash-avatar" attr-data="thumbnail8"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="image-container"></div>
                                            <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->other_avatar_url8.'?'.time()) }}">
                                        </div>
                                    @else
                                        <div class="contentItem-wrp">
                                            <div class="optional-section">
                                                <img class="option-icon avatar-upload" attr-data="thumbnail8" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                                            </div>
                                            <div class="thumbnail-card">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center mt-4 mb-5 btn-section w-100 p-0 m-0">
                    <a href="{{ route('profile') }}" class="btn btn-primary save-button">SAVE</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="imageModalContainer" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered crop__modal">
        <div class="modal-content crop__modal-content modal-content1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="arrow-left"></i></span>
                </button>
                <h5 class="modal-title" id="imageModal">Crop Image</h5>
            </div>
            <div class="modal-body" id="crop__modal-body">
                <img id='crop-image-container'>

                </img>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn crop__action" data-dismiss="modal"><i data-feather="x"></i></button>
                <button type="button" class="btn crop__action save-modal" onclick="cropImage()"><i data-feather="check"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.1/croppie.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="{{ asset('js/jquery.Jcrop.js') }}"></script>
<script src="{{ asset('js/jquery.SimpleCropper.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var business_categories = '{{ $user->profile->main_interests }}' ? '{{ $user->profile->main_interests }}'.split(',') : [];
    var avatar_url = '';
    var contents = $('.story-edit').html();
    var city = $('.city-edit').html();
    var country = $('.country-edit').html();
    var street = $('.street-edit').html();
    var code = $('.code-edit').html();
    var phone = $('.phone-edit').html();
    var email = $('.email-edit').html();
    var site = $('.site-edit').html();

    $('.business-category-checkbox').change(function() {
        if ($(this).prop('checked') == true) {
            if (business_categories.length > 0) {
                toastr['error']('You can select only one.', 'Alert');
                $(this).prop('checked', false);
                return;
            }
            business_categories.push($(this).val());
        } else {
            business_categories.splice(business_categories.indexOf($(this).val()), 1);
        }
    })

    $('.business-category-update').on('click', function() {
        var send_data = {};
        send_data['id'] = '{{$user->profile->id}}';
        send_data['main_interests'] = business_categories.join(',');
        $.ajax({
          type: 'PUT',
          url: '{{ route('setting.main.interested') }}',
          data: send_data,
          success: function(data) {
            toastr['success'](data.success, 'Success');
            setTimeout(function() {
              window.location.reload();
            }, 1000);
          }
        })
    })

    feather.replace();

    $('#selectedFile').change(function () {
        if (this.files[0] == undefined)
            return;
        $('#imageModalContainer').modal('show');
        let reader = new FileReader();
        reader.addEventListener("load", function () {
            $("#crop-image-container").attr("src", reader.result);
            window.src = reader.result;
        }, false);
        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });

    let croppi;
    $('#imageModalContainer').on('shown.bs.modal', function () {
        let width = document.getElementById('crop__modal-body').offsetHeight;
        $('#crop-image-container').height((width - 100) + 'px');
        croppi = $('#crop-image-container').croppie({
            viewport: {
            width: width - 100,
            height: width - 100
            },
        });
        $('.modal-body1').height(document.getElementById('crop-image-container').offsetHeight + 50 + 'px');
        croppi.croppie('bind', {
            url: window.src,
        }).then(function () {
            croppi.croppie('setZoom', 0.8);
        });
    });
    $('#imageModalContainer').on('hidden.bs.modal', function () {
        croppi.croppie('destroy');
    });
    function cropImage() {
        croppi.croppie('result', { type: 'base64', format: 'jpeg', size: 'original' })
            .then(function (resp) {
                $('#crop__result').attr('src', resp);
                $('.modal').modal('hide');
                $('#crop__result').show();
                
                $("input[id='selectedFile']").val('');
                var blobURL = resp;
                const img = new Image();
                img.src = blobURL;
                
                img.onload = function () {
                    const MAX_WIDTH = 640;
                    const MAX_HEIGHT = 640;
                    const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
                    const canvas = document.createElement("canvas");
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);
                    canvas.toBlob(
                        (blob) => {
                            // Handle the compressed image.
                            var form_data = new FormData();
                            form_data.append('file', blob);
                            form_data.append('field', 'main_avatar');
                            $.ajax({
                                type: 'POST',
                                url: '{{ route('setting.profile.avatar') }}',
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
                                            window.location.reload();
                                        }, 1000);
                                    }
                                },
                                error:function(data){
                                    console.log(data);
                                }
                            });
                        },
                        "image/jpeg",
                        quality
                    );
                };
            });
    }

    // $('.cropme').simpleCropper();

    // $(".cropme").click(function() {
    //     avatar_url = $(this).attr('attr-data');
    // });

    $(".avatar-upload").click(function() {
        avatar_url = $(this).attr('attr-data');
        $("input[id='profile-avatar-file']").click();
    });

    function image_upload(data) {
        var img_src = $(".cropme").find("img").attr("src");
        var file_data = $('#profile-avatar-file').prop('files')[0];
        if (file_data && file_data.size > 2097152) {
            toastr['error']('File too large. File must be less than 2MB.', 'Error');
            return;
        }
        
        $("input[id='profile-avatar-file']").val('')
        
        var blobURL;
        if (!file_data || file_data == undefined) {
            blobURL = img_src;
        }
        else {
            blobURL = URL.createObjectURL(file_data);
        }
        
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
                    var form_data = new FormData();
                    form_data.append('file', blob);
                    form_data.append('field', avatar_url);
                    form_data.append('img_src', img_src);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('setting.profile.avatar') }}',
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
                                    window.location.reload();
                                }, 1000);
                            }
                        },
                        error:function(data){
                            console.log(data);
                        }
                    });
                },
                "image/jpeg",
                quality
            );
        };
    }

    $(".trash-avatar").click(function() {
        var send_data = {};
        send_data['id'] = '{{$user->profile->id}}';
        send_data['field'] = $(this).attr('attr-data');
        $.ajax({
          type: 'PUT',
          url: '{{ route('setting.remove.avatar') }}',
          data: send_data,
          success: function(data) {
            toastr['success'](data.success, 'Success');
            setTimeout(function() {
              window.location.reload();
            }, 1000);
          }
        })
    });

    $('.story-edit').blur(function() {
        if (contents != $(this).html()) {
            contents = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['story_content'] = contents
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.story') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.city-edit').blur(function() {
        if (city != $(this).html()) {
            city = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['city'] = city
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.city') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.country-edit').blur(function() {
        if (country != $(this).html()) {
            country = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['country'] = country
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.country') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.street-edit').blur(function() {
        if (street != $(this).html()) {
            street = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['street'] = street
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.street') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.code-edit').blur(function() {
        if (code != $(this).html()) {
            code = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['code'] = code
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.code') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.email-edit').blur(function() {
        if (email != $(this).html()) {
            email = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->id}}';
            send_data['email'] = email
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.email') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.phone-edit').blur(function() {
        if (phone != $(this).html()) {
            phone = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['phone'] = phone
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.phone') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

    $('.site-edit').blur(function() {
        if (site != $(this).html()) {
            site = $(this).html();
            var send_data = {};
            send_data['id'] = '{{$user->profile->id}}';
            send_data['site'] = site
            $.ajax({
              type: 'PUT',
              url: '{{ route('setting.update.site') }}',
              data: send_data,
              success: function(data) {
                toastr['success'](data.success, 'Success');
              }
            })
        }
    });

</script>
@endsection