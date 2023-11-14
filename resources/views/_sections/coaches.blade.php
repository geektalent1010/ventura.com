<div class="member-body flat-scroll">
    <div class="accordion" id="coaches">
    @foreach ($coaches as $index => $coach)
        <div class="member-item" attr-fullname="{{ $coach->getFullname() }}">
            <a class="member-link" href="{{ route('profile', [ 'userID' => $coach->id ]) }}">
                <div class="member-avatar-wrp">
                    @if (isset($coach->profile->main_avatar_url))
                        <img class="member-avatar" src="{{ asset('uploads/'.$coach->username.'/'.$coach->profile->main_avatar_url.'?'.time()) }}" alt="{{ $coach->getFullname() }}'s main_avatar">
                    @else
                        <div class="member-avatar">
                            <p class="first_letter">{{ $coach->getMono() }}</p>
                        </div>
                    @endif
                </div>
                <div class="member-name">{{ $coach->getFullname() }}</div>
            </a>
            <div class="option-icons-section">
                <div class="option-icon-btn heart-icon-btn d-flex justify-content-center align-items-center"  id="coachhead{{ $index + 1 }}">
                    <span class="option-icon heart-icon {{ in_array($authUser->id, explode(',', $coach->profile->followers)) ? 'like' : '' }} coach{{ $coach->profile->id }}" attr-data="{{ $coach->profile->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
                    <p class="followers likes-count{{ $coach->id }}">{{ !empty($coach->profile->followers) ? $coach->profile->followers : '0' }}</p> 
                    <a href="#" class="collapsed" data-toggle="collapse" data-target="#coach{{ $index + 1 }}" aria-expanded="true" aria-controls="coach{{ $index + 1 }}"></a> 
                </div>
            </div>
        </div>
        <div id="coach{{ $index + 1 }}" class="collapse" aria-labelledby="coachhead{{ $index + 1 }}" data-parent="#coaches">
            <div class="coach-detail">
                <p class="mb-0">{{ $coach->profile->house_number }} {{ $coach->profile->street }}</p>
                <p class="mb-0">{{ $coach->profile->getCity() }} {{ $coach->profile->postal_code }}</p>
                <p>{{ $coach->profile->getCountry() }}</p>
                <p><span>Phone:</span>{{ $coach->profile->phone }}</p>
                <p class="mb-0">{{ $coach->email }}</p>
                <p>{{ $coach->profile->site_url }}</p>
                @if ($coach->status)
                <div class="connect-btn-section">
                    <a href="{{ route('connect.request', ['userID' => $coach->id ]) }}" class="btn btn-primary profile-connect-btn">CONNECT</a>
                </div>
                @endif
            </div>
        </div>
    @endforeach
    </div>
</div>