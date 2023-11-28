<div class="accordion" id="trades">
  @foreach ($trades as $index => $trade)
    <div class="w-100 post-item mb-3">
      <div class="text-right p-2 pr-md-0 created-at-label">{{ date_format($trade->created_at, "d/m/Y" ) }}</div>
      <div class="member-body">
        <div class="member-item">
          <div class="member-link">
            <div class="member-avatar-wrp">
              <div class="member-avatar">
                @if ($trade->user->profile->main_avatar_url)
                <img src="{{ asset('uploads/'.$trade->user->username.'/'.$trade->user->profile->main_avatar_url.'?'.time()) }}">
                @else
                <p class="first_letter">{{ $trade->user->getMono() }}</p>
                @endif
              </div>
            </div>
            <div class="member-name">
              <a class="member-name-wrp" href="{{ route('profile', [ 'userID' => $trade->created_by ]) }}">
                <p>{{ $trade->user->getFullname() }}</p>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="post-top-content" id="posthead{{ $index + 1 }}">
        <div class="title">
          @if (isset($trade->title))
              @php
                  echo $trade->title;
              @endphp
          @endif
        </div>
        <div class="optional-section">
            <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#post{{ $index + 1 }}" aria-expanded="true" aria-controls="post{{ $index + 1 }}"></a>
        </div>
      </div>
      <div id="post{{ $index + 1 }}" class="collapse" aria-labelledby="posthead{{ $index + 1 }}" data-parent="#trades">
        @if (isset($trade->small_featured_image_url1) || isset($trade->small_featured_image_url2) || isset($trade->small_featured_image_url3))
        <div class="row justify-content-center m-0 p-0 w-100 gap">
          <div class="col-4 col-sm-4 col-md-4 contentItem right-border-trans">
              @if (isset($trade->small_featured_image_url1))
                  <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/posts/'.$trade->small_featured_image_url1.'?'.time()) }}">
                      <img src="{{ asset('uploads/posts/'.$trade->small_featured_image_url1.'?'.time()) }}">
                  </a>
              @else
                  <div class="contentItem-wrp">
                      <div class="thumbnail-card">

                      </div>
                  </div>
              @endif
          </div>
          <div class="col-4 col-sm-4 col-md-4 contentItem both-border-trans">
              @if (isset($trade->small_featured_image_url2))
                  <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/posts/'.$trade->small_featured_image_url2.'?'.time()) }}">
                      <img src="{{ asset('uploads/posts/'.$trade->small_featured_image_url2.'?'.time()) }}">
                  </a>
              @else
                  <div class="contentItem-wrp">
                      <div class="thumbnail-card">

                      </div>
                  </div>
              @endif
          </div>
          <div class="col-4 col-sm-4 col-md-4 contentItem left-border-trans">
              @if (isset($trade->small_featured_image_url3))
                  <a class="contentItem-wrp" data-fancybox href="{{ asset('uploads/posts/'.$trade->small_featured_image_url3.'?'.time()) }}">
                      <img src="{{ asset('uploads/posts/'.$trade->small_featured_image_url3.'?'.time()) }}">
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
            @if (isset($trade->subject))
                @php
                    echo $trade->subject;
                @endphp
            @endif
          </div>
          <div class="content">
            @if (isset($trade->description))
                @php
                    echo $trade->description;
                @endphp
            @endif
          </div>
        </div>
      </div>
      <div class="like-section">
        <span class="heart-icon {{ in_array($authUser->id, explode(',', $trade->followers)) ? 'like' : '' }} post{{ $trade->id }}" attr-data="{{ $trade->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
        <span class="likes-count{{ $trade->id }}">{{ $trade->followers && count(explode(',', $trade->followers)) > 0 ? count(explode(',', $trade->followers)) : 0 }}</span>
        @if ($trade->created_by === $authUser->id)
          <div class="option-icon-section">
            <a class="option-icon-btn" href="{{ route('trades.mine.edit', [ 'id' => $trade->id ]) }}">
              <span class="option-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
            </a>
            <div class="option-icon-btn">
              <span class="option-icon trash-icon" attr-data="{{ $trade->id }}"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
          </div>
        @endif
      </div>
    </div>
  @endforeach
</div>