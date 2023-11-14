@extends('layouts.app', ['ACTIVE_TITLE' => 'ROOMS', 'ACTIVE_GROUP_ROUTES' => true, 'ACTIVE_PAGE' => 'own'])

@section('title', __('- Rooms'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
  <div class="row flex-column m-0 p-0 w-100 groups-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="text-center py-3 top-title">CREATE OR EDIT MY ROOM</div>        
        <div class="name-input-section">
          <div class="image-icon-section">
            <span class="image-icon"><i class="fa fa-image" aria-hidden="true"></i></span>
          </div>
          <input id="teamName" type="text" class="form-control" name="name" placeholder="Room Name">
        </div>
        <div class="description-input-section">
          <input id="teamDescription" type="text" class="form-control" name="description" placeholder="Description">
        </div>
      </div>
    </div>

    <div class="row justify-content-center align-items-center py-5 mx-0">
      <div class="col-md-6 d-flex justify-content-center">
        <button class="btn btn-primary publish-button">
          {{ __('PUBLISH') }}
        </button>
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

  $('.publish-button').on('click', function() {
    var name = $('#teamName').val();
    var description = $('#teamDescription').val();
    var send_data = {};
    send_data['name'] = name;
    send_data['description'] = description;
    if (!name || !description) {
      toastr['error']('Please Input the Team Info', 'Error');
      return;
    }
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: '{{ route('team.create.chatroom') }}',
      data : send_data,
      success:function(data){
        if (data.status) {
          window.location.href = '{{ route('own.teams.index') }}';
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