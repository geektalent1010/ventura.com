@extends('layouts.app', ['ACTIVE_TITLE' => 'STORIES', 'ROUTES' => [
  ['ROUTE' => 'stories.index', 'ACTIVE' => 'all', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'stories.friends', 'ACTIVE' => 'friends', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'stories.mine', 'ACTIVE' => 'mine', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'mine'])

@section('title', __('- Stories'))

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
        <div class="text-center pb-3 create-title">CREATE A STORY</div>
        <div class="member-body">
          <div class="member-item">
            <div class="member-link">
              <div class="member-avatar-wrp">
                <div class="member-avatar">
                  @if($user->profile->main_avatar_url)
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
          <div class="title story-title editable" contenteditable="true">Story Title</div>
        </div>
        <div class="w-100">
          <div class="contentItem-wrp">
            <div class="optional-section">
              <img class="option-icon avatar-upload plus-post-image" attr-data="thumbnail1" src="{{ asset('images/svg/ImageGreen.svg') }}" >
              <span class="option-icon trash-avatar post-image d-none" attr-data="thumbnail1"><i class="fa fa-trash" aria-hidden="true"></i></span>
              <input type="file" id="post-featured-image" style="display: none;" accept=".jpg,.jpeg,.png" onchange="avatar_upload()" />
            </div>
            <img class="post-image w-100"/>
            <div class="thumbnail-card">
            </div>
          </div>
        </div>
        <div class="post-content">
          <div class="title story-subject editable" contenteditable="true">Story Title</div>
          <div class="content story-content editable" contenteditable="true">Write a positive story.</div>
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

  var file_data = null;
  var title = $('.story-title').html();
  var subject = $('.story-subject').html();
  var description = $('.story-content').html();

  $(".avatar-upload").click(function() {
    $("input[id='post-featured-image']").click();
  });

  function avatar_upload() {
    const file = $('#post-featured-image').prop('files')[0]; // get the file
    if (!file || file == undefined) {
      toastr['error']('You must upload image file', 'Error');
      return;
    }
    if (file.size > 2097152) {
      toastr['error']('File too large. File must be less than 2MB.', 'Error');
      return;
    }
    $('.post-image').attr('src', URL.createObjectURL(file));
    $('.plus-post-image').addClass('d-none');
    $('.thumbnail-card').addClass('image-container');
    if ($('.post-image').hasClass('d-none')) {
      $('.post-image').removeClass('d-none')
    }
    
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
          file_data = blob;
        },
        "image/jpeg",
        quality
      );
    };
  }

  $(".trash-avatar").click(function() {
    file_data = null;
    $("input[id='post-featured-image']").val('')
    $('.post-image').addClass('d-none');
    $('.thumbnail-card').removeClass('image-container');
    if ($('.plus-post-image').hasClass('d-none')) {
      $('.plus-post-image').removeClass('d-none')
    }
  });

  $('.story-title').blur(function() {
    if (title != $(this).html()) {
      title = $(this).html();
    }
  });

  $('.story-subject').blur(function() {
    if (subject != $(this).html()) {
      subject = $(this).html();
    }
  });

  $('.story-content').blur(function() {
    if (description != $(this).html()) {
      description = $(this).html();
    }
  });

  $('.post-button').on('click', function() {
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('title', title);
    form_data.append('subject', subject);
    form_data.append('description', description);
    form_data.append('type', 1);
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
            window.location.href = '{{ route('stories.mine') }}';
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