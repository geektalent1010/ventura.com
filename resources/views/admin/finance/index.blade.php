@extends('layouts.admin', ['ACTIVE_TITLE' => 'FINANCE'])

@section('title', __('- Finance'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="admin-main-bg">
  <div class="container-fluid">
    <div class="row admin-finance-section pt-1">
      <div class="col-md-4">
        <div class="money-box">
          <div class="balance-title">Current Balance</div>
          <div class="balance-value">€ {{ $totalBalance }}</div>
        </div>
        <div class="navigator row mt-3 mx-0">
          <div class="col-md-6 p-0">
            <div class="eachNav overview">
              <span class="">Overview</span>
            </div>
          </div>
          <div class="col-md-6 p-0">
            <div class="eachNav deposit">
              <span>Deposit</span>
            </div>
          </div>
          <div class="col-md-6 p-0">
            <div class="eachNav send">
              <span>Send</span>
            </div>
          </div>
          <div class="col-md-6 p-0">
            <div class="eachNav deduct">
              <span>Deduct</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="transactions-list">
          <div class="transaction-title">Transactions</div>
          <div class="row">
            <div class="col-md-12 financeFilters">
              @include('admin.finance.partials.filter')
            </div>
            <div class="col-md-12 transactionListContainer"></div>
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
</script>
<script>
    "use strict";

    $(function () {
        loadTransactionFilters();
    });
    
    function loadTransactionFilters() {
        $.get('{{ route('finance.filters') }}', function (response) {
            $('.reportFilters').html(response);
            $('.filterRequest').trigger('click')
        });
    }

    function fetchTransactions(route) {
        route = route ? route : '{{ route('finance.transaction.fetch') }}';
        $.post(route, $('.filterForm').serialize(), function (response) {
            $('.transactionListContainer').html(response);
        })
    }
</script>
@endsection