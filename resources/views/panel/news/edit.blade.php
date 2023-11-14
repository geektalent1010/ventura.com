@extends('layouts.app', ['ACTIVE_TITLE' => 'NEWS', 'ROUTES' => [
  ['ROUTE' => 'news.mine', 'ACTIVE' => 'mine', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'mine'])

@section('title', __('- News'))

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
        <div class="text-center pb-3 create-title">EDIT A NEWS</div>
        <div class="member-body">
          <div class="member-item">
            <div class="member-link">
              <div class="member-avatar-wrp">
                <div class="member-avatar">
                  <img class="social-logo" src="{{ asset('images/Logos/Logo01.svg') }}" alt="Logo">
                </div>
              </div>
              <div class="member-name">Ventura Support Team</div>
            </div>
          </div>
        </div>
        <div class="post-top-content">
          <div class="title news-title editable" contenteditable="true">
              @if (isset($post->title))
                  @php
                      echo $post->title;
                  @endphp
              @else
                  News Title
              @endif
          </div>
        </div>
        <input type="file" id="post-featured-image" style="display: none;" accept=".jpg,.jpeg,.png" onchange="avatar_upload()" />
        <div class="w-100">
          <div class="contentItem-wrp">
            <div class="optional-section">
              <img class="option-icon featured-image-upload plus-post-image {{ $post->main_featured_image_url ? 'd-none' : '' }}" attr-data="thumbnail" src="{{ asset('images/svg/ImageGreen.svg') }}" >
              <span class="option-icon trash-featured-image post-image {{ $post->main_featured_image_url ? '' : 'd-none' }}" attr-data="thumbnail"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div class="image-container post-image {{ $post->main_featured_image_url ? '' : 'd-none' }}"></div>
            <img src="{{ asset('uploads/posts/'.$post->main_featured_image_url.'?'.time()) }}" class="post-image w-100 {{ $post->main_featured_image_url ? '' : 'd-none' }} blur-img" />
          </div>
        </div>
        <div class="post-content">
          <div class="title news-subject editable" contenteditable="true">
              @if (isset($post->subscription))
                  @php
                      echo $post->subscription;
                  @endphp
              @else
                  News Title
              @endif
          </div>
          <div class="content news-content editable" contenteditable="true">
              @if (isset($post->description))
                  @php
                      echo $post->description;
                  @endphp
              @else
                  Write your news message.
              @endif
          </div>
        </div>
        <div class="like-section mb-3">
          <span class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
          <span>{{ $post->followers && count(explode(',', $post->followers)) > 0 ? count(explode(',', $post->followers)) : 0 }}</span>
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
  var isRemoveImage = false;
  var isRemoveImage1 = false;
  var isRemoveImage2 = false;
  var isRemoveImage3 = false;
  var title = $('.news-title').html();
  var subject = $('.news-subject').html();
  var description = $('.news-content').html();

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
      isRemoveImage = false;
      $('.post-image').attr('src', URL.createObjectURL(file));
      $('.plus-post-image').addClass('d-none');
      if ($('.post-image').hasClass('d-none')) {
        $('.post-image').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail1') {
      isRemoveImage1 = false;
      $('.post-image1').attr('src', URL.createObjectURL(file));
      $('.plus-post-image1').addClass('d-none');
      if ($('.post-image1').hasClass('d-none')) {
        $('.post-image1').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail2') {
      isRemoveImage2 = false;
      $('.post-image2').attr('src', URL.createObjectURL(file));
      $('.plus-post-image2').addClass('d-none');
      if ($('.post-image2').hasClass('d-none')) {
        $('.post-image2').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail3') {
      isRemoveImage3 = false;
      $('.post-image3').attr('src', URL.createObjectURL(file));
      $('.plus-post-image3').addClass('d-none');
      if ($('.post-image3').hasClass('d-none')) {
        $('.post-image3').removeClass('d-none')
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
      isRemoveImage = true;
      $('.post-image').addClass('d-none');
      if ($('.plus-post-image').hasClass('d-none')) {
        $('.plus-post-image').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail1') {
      file1_data = null;
      isRemoveImage1 = true;
      $('.post-image1').addClass('d-none');
      if ($('.plus-post-image1').hasClass('d-none')) {
        $('.plus-post-image1').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail2') {
      file2_data = null;
      isRemoveImage2 = true;
      $('.post-image2').addClass('d-none');
      if ($('.plus-post-image2').hasClass('d-none')) {
        $('.plus-post-image2').removeClass('d-none')
      }
    } else if (target_featured_image == 'thumbnail3') {
      file3_data = null;
      isRemoveImage3 = true;
      $('.post-image3').addClass('d-none');
      if ($('.plus-post-image3').hasClass('d-none')) {
        $('.plus-post-image3').removeClass('d-none')
      }
    }
    $("input[id='post-featured-image']").val('')
  });

  $('.news-title').blur(function() {
    if (title != $(this).html()) {
      title = $(this).html();
    }
  });

  $('.news-subject').blur(function() {
    if (subject != $(this).html()) {
      subject = $(this).html();
    }
  });

  $('.news-content').blur(function() {
    if (description != $(this).html()) {
      description = $(this).html();
    }
  });

  $('.post-button').on('click', function() {
    var form_data = new FormData();
    form_data.append('id', '{{ $post->id}}')
    form_data.append('file', file_data);
    form_data.append('file1', file1_data);
    form_data.append('file2', file2_data);
    form_data.append('file3', file3_data);
    form_data.append('removeImage', isRemoveImage);
    form_data.append('removeImage1', isRemoveImage1);
    form_data.append('removeImage2', isRemoveImage2);
    form_data.append('removeImage3', isRemoveImage3);
    form_data.append('title', title);
    form_data.append('subject', subject);
    form_data.append('description', description);
    $.ajax({
      type: 'POST',
      url: '{{ route('post.update') }}',
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
            window.location.href = '{{ route('news.mine') }}';
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