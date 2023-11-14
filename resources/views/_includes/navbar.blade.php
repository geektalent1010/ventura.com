<div class="headerSection fixed-header">
    <nav class="navbar">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbarItem">
                @if (isset($ACTIVE_TITLE) && $ACTIVE_TITLE != 'ventura')
                    <a class="navbar-brand pl-1" href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid"  alt="Ventura.pro" title="Ventura.pro" />
                    </a>
                @else
                    <a class="navbar-brand pl-1" href="{{ route('home') }}">
                        <img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid"  alt="Ventura.pro" title="Ventura.pro" />
                    </a>
                @endif
            </div>
            <div class="navbarItem text-center">
                @if (isset($ACTIVE_TITLE))
                    <span class="navbar-title">
                        {{ $ACTIVE_TITLE }}
                    </span>
                @else
                    <img src="{{ asset('images/Logos/Logo03.svg') }}" class="img-fluid ventura-svg" alt="landing ventura svg" />
                @endif
            </div>
            <div class="navbarItem d-flex align-items-center justify-content-end" style="gap: 12px">
            @guest
                <a href="{{ route('login') }}" class="py-3 pr-1">
                    <img class="login" src="{{ asset('images/svg/Login.svg') }}" alt="Login" />
                </a>
            @else
                <a href="{{ route('logout') }}" class="py-3 pr-1"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('images/svg/Logout.svg') }}" alt="Logout" />
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
            </div>
        </div>
    </nav>
</div>

<script type="text/javascript">
    const login_icon = document.querySelector('.login');
    const logout_icon = document.querySelector('.logout');

    if (login_icon) {
        login_icon.addEventListener('mouseover', function() {
            login_icon.src = '/images/svg/IconLOGIN2.svg';
        });
        login_icon.addEventListener('mouseout', function() {
            login_icon.src = '/images/svg/Login.svg';
        });
    }
    if (logout_icon) {
        logout_icon.addEventListener('mouseover', function() {
            logout_icon.src = '/images/svg/IconLOGOUT2.svg';
        });
        logout_icon.addEventListener('mouseout', function() {
            logout_icon.src = '/images/svg/Logout.svg';
        });
    }
</script>