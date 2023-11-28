<div class="member-body flat-scroll">
  @if (is_null($users) || !count($users))
  <div class="col no-members text-center my-5">
    No Connect Users
  </div>
  @else
    @foreach ($users as $user)
      <div class="member-item flex-column" attr-fullname="{{ $user->first_name }} {{ $user->last_name }}">
        <a class="member-link" href="{{ route('profile', [ 'userID' => $user->user_id ]) }}">
          <div class="member-avatar-wrp">
            <div class="member-avatar">
              @if ($user->main_avatar_url)
              <img src="{{ asset('uploads/'.$user->user->username.'/'.$user->main_avatar_url.'?'.time()) }}">
              @else
              <p class="first_letter">{{ $user->user->getMono() }}</p>
              @endif
            </div>
          </div>
          <div class="member-name">{{ $user->user->getFullname() }}</div>
        </a>

        <div class="request-input-section w-100">
          <input type="text" class="form-control request-message{{ $user->user_id }}" name="message" placeholder="Type message">
          <div class="send-icon-section" attr-userId="{{ $user->user_id }}">
            <span class="send-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>