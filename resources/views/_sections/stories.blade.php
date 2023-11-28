<div class="accordion" id="stories">
  @foreach ($stories as $index => $story)
    <div class="w-100 post-item mb-3">
      <div class="text-right p-2 pr-md-0 created-at-label">{{ date_format($story->created_at, "d/m/Y" ) }}</div>
      <div class="member-body">
        <div class="member-item">
          <div class="member-link">
            <div class="member-avatar-wrp">
              <div class="member-avatar">
                @if ($story->user->profile->main_avatar_url)
                <img src="{{ asset('uploads/'.$story->user->username.'/'.$story->user->profile->main_avatar_url.'?'.time()) }}">
                @else
                <p class="first_letter">{{ $story->user->getMono() }}</p>
                @endif
              </div>
            </div>
            <div class="member-name">
              <a class="member-name-wrp" href="{{ route('profile', [ 'userID' => $story->created_by ]) }}">
                <p>{{ $story->user->getFullname() }}</p>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="post-top-content" id="posthead{{ $index + 1 }}">
        <div class="title">
          @if (isset($story->title))
              @php
                  echo $story->title;
              @endphp
          @endif
        </div>
        <div class="optional-section">
            <a href="#" class="option-icon collapsed" data-toggle="collapse" data-target="#post{{ $index + 1 }}" aria-expanded="true" aria-controls="post{{ $index + 1 }}"></a>
        </div>
      </div>
      <div id="post{{ $index + 1 }}" class="collapse" aria-labelledby="posthead{{ $index + 1 }}" data-parent="#stories">
        @if (isset($story->main_featured_image_url))
        <a class="w-100" data-fancybox href="{{ asset('uploads/posts/'.$story->main_featured_image_url.'?'.time()) }}">
          <img class="w-100 h-auto" src="{{ asset('uploads/posts/'.$story->main_featured_image_url.'?'.time()) }}" alt="featured image">
        </a>
        @endif
        <div class="post-content">
          <div class="title">
            @if (isset($story->subject))
                @php
                    echo $story->subject;
                @endphp
            @endif
          </div>
          <div class="content">
            @if (isset($story->description))
                @php
                    echo $story->description;
                @endphp
            @endif
          </div>
        </div>
      </div>
      <div class="like-section">
        <span class="heart-icon {{ in_array($authUser->id, explode(',', $story->followers)) ? 'like' : '' }} post{{ $story->id }}" attr-data="{{ $story->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
        <span class="likes-count{{ $story->id }}">{{ $story->followers && count(explode(',', $story->followers)) > 0 ? count(explode(',', $story->followers)) : 0 }}</span>
        @if ($story->created_by === $authUser->id)
          <div class="option-icon-section">
            <a class="option-icon-btn" href="{{ route('wisdom.mine.edit', [ 'id' => $story->id ]) }}">
              <span class="option-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
            </a>
            <div class="option-icon-btn">
              <span class="option-icon trash-icon" attr-data="{{ $story->id }}"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
          </div>
        @endif
      </div>
    </div>
  @endforeach
</div>