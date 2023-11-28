@extends('layouts.app', ['ACTIVE_TITLE' => 'BRANDS', 'ROUTES' => [
  ['ROUTE' => 'trades.index', 'ACTIVE' => 'all', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'trades.friends', 'ACTIVE' => 'friends', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'trades.mine', 'ACTIVE' => 'mine', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'mine'])

@section('title', __('- Brands'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
  <div class="row m-0 p-0 w-100 posts-section">
    <div class="row justify-content-center m-0 py-3 w-100">
      <div class="col-md-6 p-0">
        <div class="text-center pb-3 create-title">CREATE A BRAND</div>
        <div class="member-body">
          <div class="member-item">
            <div class="member-link">
              <div class="member-avatar-wrp">
                <div class="member-avatar">
                  @if ($user->profile->main_avatar_url)
                  <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->main_avatar_url.'?'.time()) }}">
                  @else
                  <p class="first_letter">{{ $user->getMono() }}</p>
                  @endif
                </div>
              </div>
              <div class="member-name">{{ $user->getFullname() }}</div>
            </div>
          </div>
        </div>
        <div class="post-top-content">
          <div class="title trade-title editable" contenteditable="true">Brand Name</div>
        </div>
        <input type="file" id="post-featured-image" style="display: none;" accept=".jpg,.jpeg,.png" onchange="avatar_upload()" />
        <div class="row justify-content-center m-0 p-0 w-100 gap">
          <div class="col-4 col-sm-4 col-md-4 contentItem right-border-trans">
              <div class="contentItem-wrp">
                  <div class="optional-section">
                      <img class="option-icon featured-image-upload plus-post-image1" attr-data="thumbnail1" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                      <span class="option-icon trash-featured-image post-image1 d-none" attr-data="thumbnail1"><i class="fa fa-trash" aria-hidden="true"></i></span>
                  </div>
                  <img class="post-image1 w-100"/>
                  <div class="thumbnail-card1">
                  </div>
              </div>
          </div>
          <div class="col-4 col-sm-4 col-md-4 contentItem both-border-trans">
              <div class="contentItem-wrp">
                  <div class="optional-section">
                      <img class="option-icon featured-image-upload plus-post-image2" attr-data="thumbnail2" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                      <span class="option-icon trash-featured-image post-image2 d-none" attr-data="thumbnail2"><i class="fa fa-trash" aria-hidden="true"></i></span>
                  </div>
                  <img class="post-image2 w-100"/>
                  <div class="thumbnail-card2">
                  </div>
              </div>
          </div>
          <div class="col-4 col-sm-4 col-md-4 contentItem left-border-trans">
              <div class="contentItem-wrp">
                  <div class="optional-section">
                      <img class="option-icon featured-image-upload plus-post-image3" attr-data="thumbnail3" src="{{ asset('images/svg/ImageGreen.svg') }}" >
                      <span class="option-icon trash-featured-image post-image3 d-none" attr-data="thumbnail3"><i class="fa fa-trash" aria-hidden="true"></i></span>
                  </div>
                  <img class="post-image3 w-100"/>
                  <div class="thumbnail-card3">
                  </div>
              </div>
          </div>
        </div>
        <div class="post-content">
          <div class="title trade-subject editable" contenteditable="true">Brand Name</div>
          <div class="content trade-content editable" contenteditable="true">Write a crystal clear story about your brand.</div>
        </div>
        <div class="like-section mb-3">
          <span class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
          <span>0</span>
        </div>
      </div>
    </div>

    <div class="row justify-content-center align-items-center pb-5 mx-0">
      <button class="btn btn-primary post-button">
        {{ __('PUBLISH') }}
      </button>
    </div>
  </div>
</div>
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var target_featured_image = '';
  var file_data = null;
  var file1_data = null;
  var file2_data = null;
  var file3_data = null;
  var file4_data = null;
  var title = $('.trade-title').html();
  var address = $('.trade-address').html();
  var subject = $('.trade-subject').html();
  var description = $('.trade-content').html();

  $(".featured-image-upload").click(function() {
    target_featured_image = $(this).attr('attr-data');
    $("input[id='post-featured-image']").click();
  });

  function avatar_upload() {
    const file = $('#post-featured-image').prop('files')[0];
    if (!file || file == undefined) {
      toastr['error']('You must upload image file', 'Error');
      return;
    }
    if (file.size > 2097152) {
      toastr['error']('File too large. File must be less than 2MB.', 'Error');
      return;
    }
    if (target_featured_image == 'thumbnail') {
      $('.post-image').attr('src', URL.createObjectURL(file));
      if ($('.post-image').hasClass('d-none')) {
        $('.post-image').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail1') {
      $('.post-image1').attr('src', URL.createObjectURL(file));
      $('.plus-post-image1').addClass('d-none');
      $('.thumbnail-card1').addClass('image-container');
      if ($('.post-image1').hasClass('d-none')) {
        $('.post-image1').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail2') {
      $('.post-image2').attr('src', URL.createObjectURL(file));
      $('.plus-post-image2').addClass('d-none');
      $('.thumbnail-card2').addClass('image-container');
      if ($('.post-image2').hasClass('d-none')) {
        $('.post-image2').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail3') {
      $('.post-image3').attr('src', URL.createObjectURL(file));
      $('.plus-post-image3').addClass('d-none');
      $('.thumbnail-card3').addClass('image-container');
      if ($('.post-image3').hasClass('d-none')) {
        $('.post-image3').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail4') {
      $('.post-image4').attr('src', URL.createObjectURL(file));
      if ($('.post-image4').hasClass('d-none')) {
        $('.post-image4').removeClass('d-none')
      }
    }
    $("input[id='post-featured-image']").val('')

    const blobURL = URL.createObjectURL(file);
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
          if (target_featured_image == 'thumbnail') {
            file_data = blob;
          } else if (target_featured_image == 'thumbnail1') {
            file1_data = blob;
          } else if (target_featured_image == 'thumbnail2') {
            file2_data = blob;
          } else if (target_featured_image == 'thumbnail3') {
            file3_data = blob;
          } else if (target_featured_image == 'thumbnail4') {
            file4_data = blob;
          }
        },
        "image/jpeg",
        quality
      );
    };
  }

  $(".trash-featured-image").click(function() {
    target_featured_image = $(this).attr('attr-data');
    if (target_featured_image == 'thumbnail') {
      file_data = null;
      $('.post-image').addClass('d-none');
      if ($('.plus-post-image1').hasClass('d-none')) {
        $('.plus-post-image1').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail1') {
      file1_data = null;
      $('.post-image1').addClass('d-none');
      $('.thumbnail-card1').removeClass('image-container');
      if ($('.plus-post-image1').hasClass('d-none')) {
        $('.plus-post-image1').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail2') {
      file2_data = null;
      $('.post-image2').addClass('d-none');
      $('.thumbnail-card2').removeClass('image-container');
      if ($('.plus-post-image2').hasClass('d-none')) {
        $('.plus-post-image2').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail3') {
      file3_data = null;
      $('.post-image3').addClass('d-none');
      $('.thumbnail-card3').removeClass('image-container');
      if ($('.plus-post-image3').hasClass('d-none')) {
        $('.plus-post-image3').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail4') {
      file4_data = null;
      $('.post-image4').addClass('d-none');
    }
    $("input[id='post-featured-image']").val('')
  });

  $('.trade-title').blur(function() {
    if (title != $(this).html()) {
      title = $(this).html();
    }
  });

  $('.trade-address').blur(function() {
    if (address != $(this).html()) {
      address = $(this).html();
    }
  });

  $('.trade-subject').blur(function() {
    if (subject != $(this).html()) {
      subject = $(this).html();
    }
  });

  $('.trade-content').blur(function() {
    if (description != $(this).html()) {
      description = $(this).html();
    }
  });

  $('.post-button').on('click', function() {
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('file1', file1_data);
    form_data.append('file2', file2_data);
    form_data.append('file3', file3_data);
    form_data.append('file4', file4_data);
    form_data.append('title', title);
    form_data.append('address', address);
    form_data.append('subject', subject);
    form_data.append('description', description);
    form_data.append('type', 2);
    $.ajax({
      type: 'POST',
      url: '{{ route('post.store') }}',
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
            window.location.href = '{{ route('trades.mine') }}';
          }, 1000);
        }
      },
      error:function(data){
        console.log(data);
      }
    });
  })

</script>
@endsection