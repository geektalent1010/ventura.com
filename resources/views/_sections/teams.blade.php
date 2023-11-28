<div class="member-body flat-scroll">
    @foreach ($teams as $member)
        <div class="member-item" attr-fullname="{{ $member->team->name }}">
            <div class="member-link">
                <div class="member-avatar-wrp">
                    <div class="member-avatar">
                        @if ($member->team->team_logo)
                        <img src="{{ asset('uploads/teams/'.$member->team->team_logo.'?'.time()) }}">
                        @else
                        <p class="first_letter">{{ substr($member->team->name, 0, 1) }}</p>
                        @endif
                    </div>
                </div>
                <div class="member-name">{{ $member->team->name }}</div>
            </div>
            <div class="option-icons-section">
                <a class="option-icon-btn" href="{{ route('team.chat.index', [ 'id' => $member->team->id ]) }}">
                    <span class="option-icon"><i class="fa fa-comment" aria-hidden="true"></i></span>
                </a>
                <div class="option-icon-btn leave-team {{ $member->team->user_id == $authUser->id ? 'd-none' : '' }}" attr-teamId="{{ $member->team_id }}" attr-userId="{{ $member->user_id }}">
                    <span class="option-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    @endforeach
</div>