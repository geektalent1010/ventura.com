@extends('layouts.app', ['ACTIVE_TITLE' => 'SHARE', 'ROUTES' => [
  ['ROUTE' => 'share.index', 'ACTIVE' => 'share', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'share.link', 'ACTIVE' => 'link', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'share'])

@section('title', __('- Share'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('plugin/slick/slick.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('plugin/slick/slick-theme.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" rel="stylesheet" />
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')
<div class="main-bg d-flex">
  <div class="row m-0 p-0 w-100 share-section">
    <div class="row justify-content-center m-0 p-0 py-3 w-100">
      <div class="col-md-6 p-0">
        <p class="link-title mt-4">LET’S GO VIRAL</p>
        <p class="link-address">www.ventura.pro/{{ $user->customer_id }}</p>
        <div class="d-flex justify-content-center align-items-center btn-section w-100 p-0 m-0 mt-4 mb-5">
            <a class="btn btn-primary copy-btn" onclick="copyLink(this,event)" attr_href="{{ url('/') }}/{{ $user->customer_id }}/1">COPY LINK</a>
        </div>
				@if (isset($user->rank) && $user->rank->rank->level > 2)
        <div class="d-flex justify-content-center align-items-center btn-section w-100 p-0 m-0 mt-4 mb-5">
            <a class="btn btn-primary copy-btn" onclick="copyLink2(this,event)" attr_href="{{ url('/') }}/{{ $user->customer_id }}/2">COPY LINK2</a>
        </div>
				@endif
        <p class="share-title">SHARE ON SOCIAL MEDIA</p>
        <div class="d-flex align-items-center justify-content-center social-icon-section">
          <img class="social-icon" src="{{ asset('images/svg/Facebook.svg') }}" alt="facebook icon">
          <img class="social-icon" src="{{ asset('images/svg/LinkedIn.svg') }}" alt="LinkedIn icon">
          <img class="social-icon" src="{{ asset('images/svg/Insta.svg') }}" alt="facebook icon">
          <img class="social-icon" src="{{ asset('images/svg/Pinterest.svg') }}" alt="Pinterest icon">
          <img class="social-icon" src="{{ asset('images/svg/Twitter.svg') }}" alt="Twitter icon">
        </div>

        {{--@if (count($fileNames) > 0)
          @foreach ($fileNames as $filename)
            <div class="image-slider-wrapper mt-3">
              <div class="each-panel">
                <a data-fancybox href="{{ asset($filename['src']) }}">
                  <img src="{{ asset($filename['src']) }}">
                </a>
                <div class="mt-4 px-3 w-100 d-flex justify-content-center">
                  <a class="btn btn-primary download-button" href="{{ asset($filename['src']) }}" download attr-filename="{{ $filename['name'] }}">Download</a>
                </div>
              </div>
            </div>
          @endforeach
        @endif--}}
        <div class="d-flex align-items-center justify-content-center mt-4">
					<img class="logo-icon" src="{{ asset('images/Logos/Logo01.svg') }}" alt="Logo icon">
        </div>
				<p class="share-title mt-3">AD PACK 1</p>
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
				<p class="share-title mt-3">AD PACK 2</p>
				<div class="image-slider-wrapper">
					<div class="each-panel">
						<div class="mt-1 px-3 w-100 d-flex justify-content-center">
							<a class="btn btn-primary download-button" href="{{ asset('files/AdPack2.zip') }}" download>Download</a>
						</div>
					</div>
				</div>
        <div class="d-flex align-items-center justify-content-center mt-4">
					<img class="logo-icon" src="{{ asset('images/Logos/Logo01.svg') }}" alt="Logo icon">
        </div>
				<p class="share-title mt-3">VIDEO PACK 1</p>
				<div class="image-slider-wrapper">
					<div class="each-panel">
						<div class="mt-1 px-3 w-100 d-flex justify-content-center">
							<a class="btn btn-primary download-button" href="{{ asset('files/VideoPack1.zip') }}" download>Download</a>
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
<script src="{{ asset('plugin/slick/slick.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $('.image-slider-wrapper').slick({
		  infinite: true,
		  slidesToShow: 1,
      draggable: true,
      arrows: false,
		  dots: false,
		  focusOnSelect: true,
		  responsive: [
		    // {
		    //   breakpoint: 1200,
		    //   settings: {
		    //     slidesToShow: 3
		    //   }
		    // },
		    // {
		    //   breakpoint: 968,
		    //   settings: {
		    //     slidesToShow: 3
		    //   }
		    // },
		    // {
		    //   breakpoint: 768,
		    //   settings: {
		    //     slidesToShow: 1
		    //   }
		    // },
		    // {
		    //   breakpoint: 480,
		    //   settings: {
		    //     slidesToShow: 1,
		    //   }
		    // }
		  ]
    });
		Fancybox.bind('[data-fancybox]', {
		  Toolbar: {
		    display: [
		      "close",
		    ],
		  },
		});
  });

  $(".download-action").click(function() {
    window.location.href = '{{ route('share.download') }}?filename=' + $(this).attr('attr-filename');
  });

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
