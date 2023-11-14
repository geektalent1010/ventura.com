@extends('layouts.app', ['ACTIVE_TITLE' => 'ROOMS', 'ACTIVE_TEAM_ROUTES' => true, 'ACTIVE_PAGE' => 'teams'])

@section('title', __('- Rooms'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
  <div class="row m-0 p-0 w-100 groups-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="text-center py-3 top-title">FIND ROOMS</div>
        <div class="search-input-section">
          <input type="text" class="form-control" name="searchKey" placeholder="Search Room">
          <div class="search-icon-section">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
        </div>
        @if (is_null($teams) || !count($teams))
          <div class="col no-members mt-5">
            No Rooms
          </div>
        @else
          @include('_sections.teams')
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

  $('.leave-team').on('click', function() {
    var send_data = {};
    send_data['teamId'] =  $(this).attr('attr-teamId');
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