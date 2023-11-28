@extends('layouts.app', ['ACTIVE_TITLE' => 'ROOMS', 'ACTIVE_GROUP_ROUTES' => true, 'ACTIVE_PAGE' => 'friends'])

@section('title', __('- Rooms'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
  <div class="row m-0 p-0 w-100 groups-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="text-center my-4 top-title">NEW INVITES</div>
        @if (is_null($invites) || !count($invites))
          <div class="text-center col no-members text-blue">
            <b>NO</b>
          </div>
        @else
        <div class="member-body">
          @foreach ($invites as $invite)
            <div class="member-item">
                <div class="member-link">
                    <div class="member-avatar-wrp">
                        <div class="member-avatar">
                          @if ($invite->inviteMember->team->team_logo)
                          <img src="{{ asset('uploads/teams/'.$invite->inviteMember->team->team_logo.'?'.time()) }}">
                          @else
                          <p class="first_letter">{{ substr($invite->inviteMember->team->name, 0, 1) }}</p>
                          @endif
                        </div>
                    </div>
                    <div class="member-name">{{ $invite->inviteMember->team->name }}</div>
                </div>
                <div class="option-icons-section">
                    <div class="option-icon-btn accept-invite" attr-data="{{ $invite->id }}">
                      <span class="option-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="description-input-section">
              <input id="teamDescription" type="text" class="form-control desc-body" name="description" value="{{ $invite->inviteMember->team->description }}" readonly>
            </div>
          @endforeach
        </div>
        @endif
        <div class="text-center py-3 top-title">ROOMS FROM FRIENDS</div>
        @if (is_null($members) || !count($members))
          <div class="text-center col no-members mt-5">
              NO ROOM FOUND
          </div>
        @else
          <div class="member-body flat-scroll">
              @foreach ($members as $member)
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
                            <img class="message-icon" src="{{ asset('images/svg/IconCHAT.svg') }}">
                          </a>
                          <div class="option-icon-btn delete-team-chat" attr-data="{{ $member->team->id }}" attr-userId="{{ $authUser->id }}">
                              <span class="option-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
                          </div>
                      </div>
                  </div>
                  <div class="description-input-section">
                    <input id="teamDescription" type="text" class="form-control desc-body" name="description" value="{{ $member->team->description }}" readonly>
                  </div>
              @endforeach
          </div>
        @endif
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

  $('.accept-invite').click(function () {
    var send_data = {};
    send_data['request_id'] = $(this).attr('attr-data');
    $.ajax({
      url: '{{ route("team.invite.accept") }}',
      method: "POST",
      data: send_data,
      success: function(data) {
        if (data.status) {
          toastr['success'](data.message, 'Success');
          setTimeout(function() {
            window.location.reload();
          }, 1000);
        } else {
          toastr['error'](data.message, 'Error');
        }
      },
      error:function(err){
        toastr['error']('Error');
      }
    })
  });

  $('.delete-team-chat').on('click', function() {
    var send_data = {};
    send_data['teamId'] = $(this).attr('attr-data');
    send_data['userId'] = $(this).attr('attr-userId');
    $.ajax({
      type: 'POST',
      url: '{{ route('team.member.ban') }}',
      data : send_data,
      success:function(data){
        if (data.status) {
          toastr['success'](data.message, 'Success');
          setTimeout(function() {
            window.location.reload();
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
