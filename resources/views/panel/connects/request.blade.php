@extends('layouts.app', ['ACTIVE_TITLE' => 'PROFILE'])

@section('title', __('- Connect'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
  <div class="row m-0 px-0 w-100 connect-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="no-members text-center py-3">CONNECT</div>
        <div class="member-body flat-scroll">
          <div class="member-item">
          <div class="member-link">
            <div class="member-avatar-wrp">
              <div class="member-avatar">
                @if ($user->profile->main_avatar_url)
                  <img src="{{ asset('uploads/'.$user->username.'/'.$user->profile->main_avatar_url.'?'.time()) }}">
                  @else
                  <p class="first_letter">{{ $user->getMono() }}</p>
                @endif
              </div>
            </div>
            <div class="member-name">{{ $user->getFullname() }}</div>
          </div>
        </div>
        <div class="request-input-section">
          <input type="text" class="form-control request-message" name="message" placeholder="Type message">
          <div class="send-icon-section" attr-userId="{{ $user->id }}">
            <span class="send-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.send-icon-section').click(function () {
      if($(".request-message").val() == '') {
        toastr['error']('Please enter the message', 'Error');
        return;
      } else {
        var send_data = {};
        send_data['user_id'] = '{{ $user->id }}';
        send_data['message'] = $(".request-message").val();
        $.ajax({
          url: '{{ route("connect.request.send") }}',
          method: "POST",
          data: send_data,
          success: function(data) {
            if (data.error) {
              toastr['error'](data.error, 'Error');
            } else {
              toastr['success'](data.success, 'Success');
              setTimeout(function() {
                window.location.href = '{{ route('connect.index') }}';
              }, 1000);
            }
          },
          error:function(err){
              toastr['error']('Error');
          }
        })
      }
    });
  </script>
@endsection