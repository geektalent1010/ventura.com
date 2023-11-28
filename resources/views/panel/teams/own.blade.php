@extends('layouts.app', ['ACTIVE_TITLE' => 'ROOMS', 'ACTIVE_GROUP_ROUTES' => true, 'ACTIVE_PAGE' => 'own'])

@section('title', __('- Rooms'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
  <div class="row m-0 p-0 w-100 groups-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="text-center pt-3 top-title">MY ROOMS</div>
          <div class="row justify-content-center align-items-center my-4 save-btn-section w-100 p-0 m-0">
            <a class="btn btn-primary create-btn d-flex justify-content-center align-items-center" href="{{ route('team.create.index') }}">CREATE</a>
          </div>
          @if (is_null($teams) || !count($teams))
            <div class="text-center col no-members mt-5">
              NO ROOM FOUND
            </div>
          @else
          <div class="search-input-section">
            <input id="searchKey" type="text" class="form-control" name="searchKey" placeholder="Find a Room">
            <div class="search-icon-section">
              <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
          </div>
          <div class="member-body flat-scroll">
            @foreach ($teams as $team)
            <div class="search-item" attr-fullname="{{ $team->name }}">
              <div class="member-item" attr-fullname="{{ $team->name }}">
                <div class="member-link">
                  <div class="member-avatar-wrp">
                    <div class="member-avatar">
                      @if ($team->team_logo)
                      <img src="{{ asset('uploads/teams/'.$team->team_logo.'?'.time()) }}">
                      @else
                      <p class="first_letter">{{ substr($team->name, 0, 1) }}</p>
                      @endif
                    </div>
                  </div>
                  <div class="member-name">{{ $team->name }}</div>
                </div>
                <div class="option-icons-section">
                  <a class="option-icon-btn ml-2" href="{{ route('team.edit.index', [ 'id' => $team->id ]) }}">
                    <span class="option-icon"><i class="fa fa-pen" aria-hidden="true"></i></span>
                  </a>
                  <a class="option-icon-btn" href="{{ route('team.chat.index', [ 'id' => $team->id ]) }}">
                    <img class="message-icon" src="{{ asset('images/svg/IconCHAT.svg') }}">
                  </a>
                  <div class="option-icon-btn delete-team-chat" attr-data="{{ $team->id }}">
                    <span class="option-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
              <div class="description-input-section">
                <input id="teamDescription" type="text" class="form-control desc-body" name="description" value="{{ $team->description }}" readonly>
              </div>
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

  $('.delete-team-chat').on('click', function() {
    var send_data = {};
    send_data['id'] = $(this).attr('attr-data');
    $.ajax({
      type: 'DELETE',
      url: '{{ route('team.delete') }}',
      data: send_data,
      success: function(data) {
        toastr['success'](data.success, 'Success');
        setTimeout(function() {
          window.location.reload();
        }, 1000);
      },
      error: function(data){
        console.log(data);
      }
    })
  })
</script>
@endsection