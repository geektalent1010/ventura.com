@extends('layouts.app', ['ACTIVE_TITLE' => 'FILES', 'ROUTES' => [
  ['ROUTE' => 'files.marketing', 'ACTIVE' => 'marketing', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'files.invoices', 'ACTIVE' => 'invoices', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'invoices'])

@section('title', __('- Files'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex pb-0">
    <div class="row flex-column m-0 p-0 w-100 files-section">
        <div class="col-md-6 p-0 d-flex flex-column justify-content-center align-items-center">
            <div class="share-title pt-2 pb-4">INVOICES</div>
        </div>
    </div>
</div>