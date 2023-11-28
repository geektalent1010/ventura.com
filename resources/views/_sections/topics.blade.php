<div class="member-body flat-scroll">
  <div class="accordion" id="faq">
    <div class="card">
      <div class="card-header" id="faqhead1">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1" attr-fullname="DASHBOARD">DASHBOARD</a>
      </div>

      <div id="faq1" class="collapse" aria-labelledby="faqhead1" data-parent="#faq">
        <div class="card-body">
          <div class="">Dashboard is your easy access to anything in Ventura Pro. Just click or tap on one of the dashboard icons and you will be forwarded to the requested page.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section">
              <div class="new-message-icon"></div>
            </div>
            <div>You have new messages</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('dashboard') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead2">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2" attr-fullname="PROFILE">MY PAGE</a>
      </div>

      <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
        <div class="card-body">
          <div class="">My Page is developed to expose yourself to other marketers, companies and coaches. Tell us about yourself, your brand and upload brand images.</div>
          <div class="action-title my-3">Actions</div>
          <div class="mb-3">Click or tap EDIT to go into edit mode.</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>My Page</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>My Page Settings</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon active">Abc</span>
            </div>
            <div>Edit content</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex">
              <img class="img-fluid w-50" src="{{ asset('images/svg/ImageGreen.svg') }}">
            </div>
            <div>Upload image</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon active"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete image</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span>
            </div>
            <div>Dashboard</div>
          </div>
          <div class="mb-3">Click or tap SAVE to store your page.</div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('profile') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead3">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq3" attr-fullname="CONNECT">CONNECT</a>
      </div>

      <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Connect with other marketers and build your friends list. Simply type a name, company name, city or country. The search engine will display any match found in the Ventura Pro data base.</div>
          <div class="">To connect with someone, you are obliged to write and send a message first to introduce yourself. If someone reads your message and clicks accept, you will be connected. Your new connection will now be visible on your friends list.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
            </div>
            <div>Accept request</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
            </div>
            <div>Send message</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('connect.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead5">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq5" aria-expanded="true" aria-controls="faq5" attr-fullname="BUDDIES">FRIENDS</a>
      </div>

      <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
        <div class="card-body">
          <div class="">See new friend requests and all connected friends in alphabetical order. Simply type any name in the search field to quickly find one of your friends.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
            </div>
            <div>Accept</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
            </div>
            <div>Chat</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('friends.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead4">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq4" attr-fullname="CHAT">CHAT</a>
      </div>

      <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Chat with someone from any device you want. View the active chat list, or simply type any name to find an active chat.</div>
          <div class="">To start a first or new chat with a friend not visible on the chat list, go to your friends list, find the friend and click the chat icon.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Chat list</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Chat page</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon blue small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Online / Offline</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon offline small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon blue small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>New message</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <img src="{{ asset('images/svg/IconCHAT.svg') }}" class="img-fluid h-50" style="width:60%; margin-left:-3px;"/>
            </div>
            <div>Chat</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
            </div>
            <div>Send message</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('chat.chatting', [ 'ids' => auth()->user()->id . '_' ]) }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead6">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq6" aria-expanded="true" aria-controls="faq6" attr-fullname="GROUPS">ROOMS</a>
      </div>

      <div id="faq6" class="collapse" aria-labelledby="faqhead6" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Build a deeper sense of community. Open up your own room as a dedicated space for you and your team to flourish. Rooms are mostly an incubator for ideas and feedback through authentic conversations.</div>
          <div class="">Rooms are only visible and accessible for invited members. Only the creator of a room is obliged to add or remove members.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>My rooms</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Rooms from friends</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Room chat</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
            </div>
            <div>Accept request</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
            </div>
            <div>Send message</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete room or member</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section tripple-icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('own.teams.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead8">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq8" aria-expanded="true" aria-controls="faq8" attr-fullname="STORIES">STORIES</a>
      </div>

      <div id="faq8" class="collapse" aria-labelledby="faqhead8" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Everyone has a success story. On the stories channel, you can read success stories from others and write your own. Add a nice picture and let us know where it’s taken. Stories is a great way to introduce yourself to the Ventura Pro business platform which might lead to new connections. If you like a post, just click the heart.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>All stories</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Stories from friends</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>My stories</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
            </div>
            <div>Edit</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section tripple-icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('stories.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead7">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq7" aria-expanded="true" aria-controls="faq7" attr-fullname="COMPANIES">COMPANIES</a>
      </div>

      <div id="faq7" class="collapse" aria-labelledby="faqhead7" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Find market related companies in this constantly growing list. If you find your favorite company, give them a like. If you don’t find your favorite company, send us a request so we can add it to the list.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('companies.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead12">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq12" aria-expanded="true" aria-controls="faq12" attr-fullname="COMPANIES">COACHES</a>
      </div>

      <div id="faq12" class="collapse" aria-labelledby="faqhead12" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Find market related coaches in this constantly growing list. Coaches can be added as a friend as soon as they accept your request. Find your favorite coach and give them a like. If your favorite coach is not on the list, send us a request so we can add them.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('coaches.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead13">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq13" aria-expanded="true" aria-controls="faq13" attr-fullname="WISDOM">WISDOM</a>
      </div>

      <div id="faq13" class="collapse" aria-labelledby="faqhead13" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">The wisdom channel will be filled with inspiration, tips and insights to create better performance. Active coaches might post their words of wisdom, to help you grow as a person and in business. If you like a post, just click the heart.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('wisdom.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead11">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq11" aria-expanded="true" aria-controls="faq11" attr-fullname="TRADE">BRANDS</a>
      </div>

      <div id="faq11" class="collapse" aria-labelledby="faqhead11" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Everyone loves to promote their favorite brand. On the brands channel, you can read brand stories from others and write your own. Crystal clear brand stories and stunning brand images will trigger others to take a closer look.</div>
          <div class="mb-3">The brands channel is a great way to introduce and promote your brand to the Ventura Pro business platform which might lead to new connections and new business. If you like a post, just click the heart.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>All brands</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Brands from friends</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>My brands</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
            </div>
            <div>Edit</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section tripple-icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('trades.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead9">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq9" aria-expanded="true" aria-controls="faq9" attr-fullname="NEWS">NEWS</a>
      </div>

      <div id="faq9" class="collapse" aria-labelledby="faqhead9" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Any news or updates related to technical development and maintenance will be shared by the Ventura Pro support team in the news channel.</div>
          <div class="">Stay Tuned!</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('news.mine') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead10">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq10" aria-expanded="true" aria-controls="faq10" attr-fullname="EVENTS">EVENTS</a>
      </div>

      <div id="faq10" class="collapse" aria-labelledby="faqhead10" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Brand events are at the heart of any business and a crucial part in building brand awareness. The event channel allows anyone to publish a local, regional, international or online brand event, no matter what brand you represent.</div>
          <div class="mb-3">Feel free to contact the event publisher when you see an event you would like to attend. If you like a post, just click the heart.</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>All events</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Events from friends</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>My events</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
            </div>
            <div>Edit</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section tripple-icon-section">
              <span class="nav-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
            </div>
            <div>Delete</div>
          </div>
          <div class="d-flex align-items-center">
            <div class="icon-section tripple-icon-section"><span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span></div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('events.company') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead16">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq16" aria-expanded="true" aria-controls="faq16" attr-fullname="STUDIO">STUDIO</a>
      </div>

      <div id="faq16" class="collapse" aria-labelledby="faqhead16" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Are you a creative mind or shall we offer you a helping hand?</div>
          <div class="mb-3">As Ventura Pro we constantly try to imagine how we can make life easier for all connected parties. Studio is a very basic and simple-to-use creative solution to let you create brand campaigns within a few clicks.</div>
          <div class="mb-3">Be creative and surprise followers with your brand-new brand campaign!</div>
          <div class="action-title my-3">Actions</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon"><i class="fa fa-heart" aria-hidden="true"></i></span>
            </div>
            <div>Like</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('studio.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead18">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq18" aria-expanded="true" aria-controls="faq18" attr-fullname="BE MORE">SHARE</a>
      </div>

      <div id="faq18" class="collapse" aria-labelledby="faqhead18" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">Feel free to download a nice collection of social media ads and movies that can be shared on any social platform or in any form of communication. This way, Ventura Pro develops the right brand awareness.</div>
          <div class="mb-3">Use your personal referral link on any post so you will be incentivised. Let’s make some money together.</div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('share.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead15">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq15" aria-expanded="true" aria-controls="faq15" attr-fullname="StATS">STATS</a>
      </div>

      <div id="faq15" class="collapse" aria-labelledby="faqhead15" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">No serious business survives without real-time statistics. Stats is for marketers that actively market Ventura Pro software licenses and shows the process of financial growth in detail.</div>
          <div class="mb-3">View the status of personal sales, channel sales, sales floors and qualifications.</div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon d-flex align-items-center"><img src="{{ asset('images/svg/Logout.svg') }}" class="img-fluid w-50" alt="Logout" title="Logout" /></span>
            </div>
            <div>Logout</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex align-items-center">
              <span class="nav-icon active small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Sales status</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section d-flex align-items-center">
              <span class="nav-icon small"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
              <span class="nav-icon active small ml-1"><i class="fa-solid fa-circle" aria-hidden="true"></i></span>
            </div>
            <div>Sales tracker</div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <div class="icon-section">
              <span class="nav-icon active d-flex"><img src="{{ asset('images/Logos/Logo01.svg') }}" class="img-fluid w-50" alt="Buddies.zone" title="Buddies.zone" /></span>
            </div>
            <div>Dashboard</div>
          </div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('incentives.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead17">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq17" aria-expanded="true" aria-controls="faq17" attr-fullname="WALLET">WALLET</a>
      </div>

      <div id="faq17" class="collapse" aria-labelledby="faqhead17" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">What’s in your wallet?</div>
          <div class="mb-3">Don’t worry, that wasn’t a real question to you directly. :)<br>Your wallet will store all earnings and gives a clear overview of your earnings.</div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('wallet.index') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="faqhead14">
        <a href="#" class="btn btn-header-link member-item collapsed" data-toggle="collapse" data-target="#faq14" aria-expanded="true" aria-controls="faq14" attr-fullname="BE MORE">FILES</a>
      </div>

      <div id="faq14" class="collapse" aria-labelledby="faqhead14" data-parent="#faq">
        <div class="card-body">
          <div class="mb-3">All invoices for your accountancy are stored in one place. Files stores your invoices for your Ventura Pro software license or renewals, as well as all documentation related to commission pay outs. Simply download and include them in your future tax returns.</div>
          <div class="mt-4">
            <a class="btn btn-primary go-to-button" href="{{ route('files.marketing') }}">
              {{ __('VISIT') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>