@extends('layouts.app', ['ACTIVE_TITLE' => 'CHAT', 'ACTIVE_CHAT_ROUTES' => true, 'ACTIVE_PAGE' => 'search', 'CHATTING_ROUTE' => url('') . '/chat/' . auth()->user()->id . '_'])

@section('title', __('- Chat'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex pb-0">
  <div class="row m-0 p-0 w-100 chat-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="search-input-section">
          <input id="userSearchKey" type="text" class="form-control" name="searchKey" placeholder="Search Name">
          <div id="userSearchIcon" class="search-icon-section">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
        </div>
        <div class="member-body flat-scroll">
          <div class="d-flex justify-content-center align-items-center no-members">
            <div class="text-center"><div>NO CHAT FOUND</div>
            <div>Add a friend to start chat</div></div>
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
  $('#userSearchIcon').click(function () {
    if($("#userSearchKey").val() == '') {
      $('.member-body').hide();
    }
    else {
      var options = {
        keyword: $("#userSearchKey").val(),
      };
      $.ajax({
        url: '{{ route("chat.search.filter") }}',
        method: "POST",
        data: options,
        success: function(res) {
          if (res.length) {
            var html = '';
            for(var resIndex = 0; resIndex < res.length; resIndex++) {
              html +=
                '<div class="member-item">' +
                '  <div class="member-link">' +
                '    <div class="member-avatar-wrp">' +
                '      <div class="member-avatar">';

              if (res[resIndex].main_avatar_url) {
                html += '<img class="svg-avatar" src="{{ asset('uploads') }}/' + res[resIndex].user.username + '/' + res[resIndex].main_avatar_url + '" alt="member default avatar">';
              } else {
                html += '<p class="first_letter">' + res[resIndex].first_name[0] + '</p>';
              }

              html +=
                '      </div>' +
                '    </div>' +
                '    <div class="member-name">' + res[resIndex].first_name + ' ' + res[resIndex].last_name + '</div>' +
                '  </div>' +
                '  <div class="option-icons-section">' +
                '    <div class="option-icon-btn" attr-connectUserId="' + res[resIndex].user_id + '">' +
                '      <span class="option-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>' +
                '    </div>' +
                '  </div>' +
                '</div>';
            }
            $('.member-body').html(html);
            $('.member-body').show();
          } else {
            var html = '<div class="d-flex justify-content-center align-items-center no-members">' +
              '<div class="text-center"><div>NO CHAT FOUND</div>' +
              '<div>Add a friend to start chat</div></div>' +
              '</div>';
            $('.member-body').html(html);
            $('.member-body').show();
          }
        },
        error:function(err){
            toastr['error']('Error');
        }
      })
    }
  });

  $(document).on('click', '.option-icon-btn', function() {
    var otherUserId = $(this).attr('attr-connectUserId');
    var send_data = {};
    send_data['otherUserId'] = otherUserId;
    $.ajax({
      type: 'POST',
      url: '{{ route('chat.create.room') }}',
      data : send_data,
      success:function(data){
        if (data.status) {
          window.location.href = '{{ url('') }}/chat/{{ auth()->user()->id }}_' + otherUserId;
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