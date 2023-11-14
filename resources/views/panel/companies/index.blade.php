@extends('layouts.app', ['ACTIVE_TITLE' => 'COMPANIES', 'ROUTES' => [
  ['ROUTE' => 'companies.index', 'ACTIVE' => 'companies', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'companies.add', 'ACTIVE' => 'add', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'companies'])

@section('title', __('- companies'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex pb-0">
  <div class="row m-0 p-0 w-100 companies-section">
    <div class="row justify-content-center m-0 p-0 w-100">
      <div class="col-md-6 p-0">
        <div class="search-input-section">
          <input id="searchKey" type="text" class="form-control" name="searchKey" placeholder="Search Company">
          <div id="companiesSearchIcon" class="search-icon-section">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
        </div>
        @include('_sections.companies')
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

    $('.heart-icon').click(function() {
        var send_data = {}; var company_id = 0;
        send_data['id'] = company_id = $(this).attr('attr-data');
        $.ajax({
          type: 'PUT',
          url: '{{ route('company.likes') }}',
          data: send_data,
          success: function(data) {
            if (data.like) {
              $('.company' + company_id).addClass('like');
            } else {
              $('.company' + company_id).removeClass('like');
            }
            $('.likes-count' + company_id).html(data.followers);
          }
        })
    });
</script>
@endsection