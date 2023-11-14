@extends('layouts.app', ['ACTIVE_TITLE' => 'SHARE', 'ROUTES' => [
  ['ROUTE' => 'share.index', 'ACTIVE' => 'share', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'share.link', 'ACTIVE' => 'link', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'link'])

@section('title', __('- Share'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')
<div class="main-bg d-flex">
  <div class="row m-0 p-0 w-100 share-section">
    <div class="row justify-content-center m-0 p-0 py-3 w-100">
      <div class="col-md-6 p-0">
        <p class="link-title mt-4">COMPANY DOCUMENTS</p>
        <div class="d-flex align-items-center justify-content-center pt-4">
					<img class="logo-icon" src="{{ asset('images/Logos/Logo01.svg') }}" alt="Logo icon">
        </div>
				<p class="share-title mt-3">PRESENTATION</p>
				<div class="image-slider-wrapper">
					<div class="each-panel">
						<div class="mt-1 px-3 w-100 d-flex justify-content-center">
							<a class="btn btn-primary download-button" href="{{ asset('files/AdPack1.zip') }}" download>Download</a>
						</div>
					</div>
				</div>
        <div class="d-flex align-items-center justify-content-center mt-4">
					<img class="logo-icon" src="{{ asset('images/Logos/Logo01.svg') }}" alt="Logo icon">
        </div>
				<p class="share-title mt-3">INCENTIVES</p>
				<div class="image-slider-wrapper">
					<div class="each-panel">
						<div class="mt-1 px-3 w-100 d-flex justify-content-center">
							<a class="btn btn-primary download-button" href="{{ asset('files/AdPack2.zip') }}" download>Download</a>
						</div>
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
	function copyLink(element, event) {
		event.preventDefault();
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).attr('attr_href')).select();
		document.execCommand("copy");
		$temp.remove();
		alert('Copied to Clipboard');
	}
  
	function copyLink2(element, event) {
		event.preventDefault();
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).attr('attr_href')).select();
		document.execCommand("copy");
		$temp.remove();
		alert('Copied to Clipboard');
	}
</script>
@endsection
