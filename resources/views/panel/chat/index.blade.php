@extends('layouts.app', ['ACTIVE_TITLE' => 'CHAT', 'ACTIVE_CHAT_ROUTES' => true, 'ACTIVE_PAGE' => 'chatting', 'CHATTING_ROUTE' => url('') . '/chat/' . auth()->user()->id . '_' . $channelInfo->otherUser->id])

@section('title', __('- Chat'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
<script src="https://media.twiliocdn.com/sdk/js/chat/v3.3/twilio-chat.min.js"></script>
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex pb-0">
  <div class="row m-0 p-0 w-100 chat-section" id="app">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0 messages-section">
        <div>
          <div class="member-body mb-0">
            <div class="member-item panel-bg">
              <div class="member-link">
                <div class="member-avatar-wrp">
                  <div class="member-avatar">
                    @if ($channelInfo->otherUser->profile->main_avatar_url)
                    <img src="{{ asset('uploads/'.$channelInfo->otherUser->username.'/'.$channelInfo->otherUser->profile->main_avatar_url.'?'.time()) }}">
                    @else
                    <p class="first_letter">{{ $channelInfo->otherUser->getMono() }}</p>
                    @endif
                  </div>
                </div>
                <div class="member-name">
                  {{ $channelInfo->otherUser->getFullname() }}
                  <div class="@if (Cache::has('is_online' . $channelInfo->otherUser->id)) online-status @else offline-status @endif"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <chat-component :auth-user="{{ auth()->user() }}"  :channel-info="{{ $channelInfo }}" :current-channel="@if (!is_null($channelInfo)) true @else false @endif"></chat-component>
      </div>
    </div>
  </div>
</div>
@endsection

@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.disconnect-icon-btn').on('click', function() {
    var send_data = {};
    send_data['channelId'] = $(this).attr('attr-channelId');
    send_data['status'] = 0;
    $.ajax({
      type: 'PUT',
      url: '{{ route('chat.connected.status') }}',
      data: send_data,
      success:function(data){
        if (data.status) {
            setTimeout(function() {
              window.location.href = '{{ route('connect.index') }}';
            }, 1000);
        } else {
          toastr['error'](data.message, 'Error');
        }
      },
      error:function(data){
        console.log(data);
      }
    });
  })
</script>
@endsection