@extends('layouts.admin', ['ACTIVE_TITLE' => 'DOWNLINE REPORT', 'ROUTES' => [
  ['ROUTE' => 'joining.reports.index', 'ACTIVE' => 'joining', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'downline.reports.index', 'ACTIVE' => 'downline', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'sales.reports.index', 'ACTIVE' => 'sales', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'downline'])

@section('title', __('- Downline Report'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="admin-main-bg">
  <div class="container-fluid">
    <div class="row admin-reports-section pt-1">
      <div class="col-md-12 reportFilters">
        @include('admin.reports.partials.downlineReportFilter')
      </div>
      <div class="col-md-12 reportContainer"></div>
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
</script>
<script>
    "use strict";

    $(function () {
        loadreportFilters();
    });

    function loadreportFilters() {
        $.get('{{ route('downlineReport.filters') }}', function (response) {
            $('.reportFilters').html(response);
            $('.filterRequest').trigger('click')
        });
    }

    function fetchDownlineReport(route) {
        route = route ? route : '{{ route('downlineReport.fetch') }}';
        $.post(route, $('.filterForm').serialize(), function (response) {
            $('.reportContainer').html(response);
        })
    }
</script>
@endsection