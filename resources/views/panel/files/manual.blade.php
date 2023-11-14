@extends('layouts.app', ['ACTIVE_TITLE' => 'FILES', 'MANUAL_ROUTE' => 'files.manual', 'VIDEO_ROUTE' => 'files.video', 'RECEIPT_ROUTE' => 'files.receipt', 'ACTIVE_PAGE' => 'manual'])

@section('title', __('- Files'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

<div class="main-bg d-flex">
    <div class="row m-0 p-0 w-100 files-section">
        <div class="row justify-content-center m-0 py-3 w-100">
            <div class="col-md-6 p-0">
                <p class="link-title mt-4">YOUR LINK TO PROMOTE</p>
                <p class="link-address">www.brandfields.social/{{ $user->customer_id ?? '1234567'}}</p>
                <div class="d-flex justify-content-center align-items-center btn-section w-100 p-0 m-0 mt-4 mb-5">
                    <a class="btn btn-primary copy-btn" onclick="copyLink(this,event)" attr_href="{{url('/')}}/{{ $user->customer_id }}">COPY LINK</a>
                </div>
                <p class="link-title my-4">BUSINESS MATERIALS</p>
                <div class="d-flex w-100">
                    <div class="packs-wrp">
                        <p class="packs-title">PRODUCT MANUAL</p>
                        <div class="packs"></div>
                    </div>
                    <div class="packs-wrp">
                        <p class="packs-title">SALES MANUAL</p>
                        <div class="packs"></div>
                    </div>
                    <div class="packs-wrp">
                        <p class="packs-title">VIDEO PACK 1</p>
                        <div class="packs"></div>
                    </div>
                </div>
                <p class="share-title mt-5">SHARE ON SOCIAL MEDIA</p>
                <div class="d-flex align-items-center justify-content-center social-icon-section mb-4">
                    <img class="social-icon" src="{{ asset('images/svg/Facebook.svg') }}" alt="facebook icon">
                    <img class="social-icon" src="{{ asset('images/svg/LinkedIn.svg') }}" alt="LinkedIn icon">
                    <img class="social-icon" src="{{ asset('images/svg/Insta.svg') }}" alt="facebook icon">
                    <img class="social-icon" src="{{ asset('images/svg/Pinterest.svg') }}" alt="Pinterest icon">
                    <img class="social-icon" src="{{ asset('images/svg/Twitter.svg') }}" alt="Twitter icon">
                </div>
                <div class="d-flex w-100">
                    <div class="packs-wrp">
                        <p class="packs-title">AD PACK 1</p>
                        <div class="packs"></div>
                    </div>
                    <div class="packs-wrp">
                        <p class="packs-title">AD PACK 2</p>
                        <div class="packs"></div>
                    </div>
                    <div class="packs-wrp">
                        <p class="packs-title">AD PACK 3</p>
                        <div class="packs"></div>
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
<script src="{{ asset('plugin/slick/slick.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
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
</script>
@endsection