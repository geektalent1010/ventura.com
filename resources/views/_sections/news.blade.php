<div class="accordion" id="news">
  @foreach ($posts as $index => $post)
    <div class="w-100 post-item mb-3">
      <div class="text-right p-2 pr-md-0 created-at-label">{{ date_format($post->created_at, "d/m/Y" )}}</div>
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
      <div class="post-top-content" id="posthead{{ $index + 1 }}">
        <div class="title">
          @if (isset($post->title))
              @php
                  echo $post->title;
              @endphp
          @endif
        </div>
        <div class="optional-section">
            <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#post{{ $index + 1 }}" aria-expanded="true" aria-controls="post{{ $index + 1 }}"></a>
        </div>
      </div>
      <div id="post{{ $index + 1 }}" class="collapse" aria-labelledby="posthead{{ $index + 1 }}" data-parent="#news">
        @if (isset($post->main_featured_image_url))
        <a class="w-100" data-fancybox href="{{ asset('uploads/posts/'.$post->main_featured_image_url.'?'.time()) }}">
          <img class="w-100 h-auto" src="{{ asset('uploads/posts/'.$post->main_featured_image_url.'?'.time()) }}" alt="featured image">
        </a>
        @endif
        @if (isset($post->small_featured_image_url1) || isset($post->small_featured_image_url2) || isset($post->small_featured_image_url3))
        <div class="row justify-content-center m-0 p-0 w-100 gap">
          <div class="col-4 col-sm-4 col-md-4 contentItem right-border-trans">
              @if(isset($post->small_featured_image_url1))
                  <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/posts/'.$post->small_featured_image_url1.'?'.time()) }}">
                      <img src="{{ asset('uploads/posts/'.$post->small_featured_image_url1.'?'.time()) }}">
                  </a>
              @else
                  <div class="contentItem-wrp">
                      <div class="thumbnail-card">
                          
                      </div>
                  </div>
              @endif
          </div>
          <div class="col-4 col-sm-4 col-md-4 contentItem both-border-trans">
              @if(isset($post->small_featured_image_url2))
                  <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/posts/'.$post->small_featured_image_url2.'?'.time()) }}">
                      <img src="{{ asset('uploads/posts/'.$post->small_featured_image_url2.'?'.time()) }}">
                  </a>
              @else
                  <div class="contentItem-wrp">
                      <div class="thumbnail-card">
                          
                      </div>
                  </div>
              @endif
          </div>
          <div class="col-4 col-sm-4 col-md-4 contentItem left-border-trans">
              @if(isset($post->small_featured_image_url3))
                  <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/posts/'.$post->small_featured_image_url3.'?'.time()) }}">
                      <img src="{{ asset('uploads/posts/'.$post->small_featured_image_url3.'?'.time()) }}">
                  </a>
              @else
                  <div class="contentItem-wrp">
                      <div class="thumbnail-card">
                          
                      </div>
                  </div>
              @endif
          </div>
        </div>
        @endif
        <div class="post-content">
          <div class="title">
            @if (isset($post->subject))
                @php
                    echo $post->subject;
                @endphp
            @endif
          </div>
          <div class="content">
            @if (isset($post->description))
                @php
                    echo $post->description;
                @endphp
            @endif
          </div>
        </div>
      </div>
      <div class="like-section">
        <span class="heart-icon {{ in_array($authUser->id, explode(',', $post->followers)) ? 'like' : '' }} post{{ $post->id }}" attr-data="{{ $post->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
        <span class="likes-count{{ $post->id }}">{{ $post->followers && count(explode(',', $post->followers)) > 0 ? count(explode(',', $post->followers)) : 0 }}</span>
        @if ($post->created_by === $authUser->id)
          <div class="option-icon-section">
            <a class="option-icon-btn" href="{{ route('news.edit', [ 'id' => $post->id ]) }}">
              <span class="option-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
            </a>
            <div class="option-icon-btn">
              <span class="option-icon trash-icon" attr-data="{{ $post->id }}"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
          </div>
        @endif
      </div>
    </div>
  @endforeach
</div>