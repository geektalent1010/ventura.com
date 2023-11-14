<div class="member-body flat-scroll">
    <div class="accordion" id="companies">
    @foreach ($companies as $index => $company)
        <div class="member-item" attr-fullname="{{ $company->getFullname() }}">
            <a class="member-link" href="{{ route('profile', [ 'userID' => $company->id ]) }}">
                <div class="member-avatar-wrp">
                    @if (isset($company->profile->main_avatar_url))
                        <img class="member-avatar" src="{{ asset('uploads/'.$company->username.'/'.$company->profile->main_avatar_url.'?'.time()) }}" alt="{{ $company->getFullname() }}'s main_avatar">
                    @else
                        <div class="member-avatar">
                            <p class="first_letter">{{ $company->getMono() }}</p>
                        </div>
                    @endif
                </div>
                <div class="member-name">{{ $company->getFullname() }}</div>
            </a>
            <div class="option-icons-section">
                <div class="option-icon-btn heart-icon-btn d-flex justify-content-center align-items-center"  id="companyhead{{ $index + 1 }}">
                    <span class="option-icon heart-icon {{ in_array($authUser->id, explode(',', $company->profile->followers)) ? 'like' : '' }} company{{ $company->profile->id }}" attr-data="{{ $company->profile->id }}"><i class="fa fa-heart" aria-hidden="true"></i></span>
                    <p class="followers likes-count{{ $company->id }}">{{ !empty($company->profile->followers) ? $company->profile->followers : '0' }}</p> 
                    <a href="#" class="collapsed" data-toggle="collapse" data-target="#company{{ $index + 1 }}" aria-expanded="true" aria-controls="company{{ $index + 1 }}"></a> 
                </div>
            </div>
        </div>
        <div id="company{{ $index + 1 }}" class="collapse" aria-labelledby="companyhead{{ $index + 1 }}" data-parent="#companies">
            <div class="company-detail">
                <p>{{ $company->profile->main_interests }}</p>
                <p class="mb-0">{{ $company->profile->house_number }} {{ $company->profile->street }}</p>
                <p class="mb-0">{{ $company->profile->getCity() }} {{ $company->profile->postal_code }}</p>
                <p>{{ $company->profile->getCountry() }}</p>
                <p><span>Phone:</span>{{ $company->profile->phone }}</p>
                <p class="mb-0">{{ $company->email }}</p>
                <p>{{ $company->profile->site_url }}</p>
            </div>
        </div>
    @endforeach
    </div>
</div>