@extends('layouts.landing')

@section('PAGE_LEVEL_STYLES')
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')
   @include('_sections.landing.main')
   @include('_sections.landing.welcome')
   @include('_sections.landing.mission')
   @include('_sections.landing.social')
   @include('_sections.landing.smart')
   @include('_sections.landing.business')
   @include('_sections.landing.footer')
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">

   const play_icon = document.querySelector('.play-icon');
   const stop_icon = document.querySelector('.stop-icon');

   play_icon.addEventListener('mouseover', function() {
      play_icon.src = '/images/svg/PlayButtonBlue.svg';
   });
   play_icon.addEventListener('mouseout', function() {
      play_icon.src = '/images/svg/PlayButtonWhite.svg';
   });

   stop_icon.addEventListener('mouseover', function() {
      stop_icon.src = '/images/svg/StopButtonBlue.svg';
   });
   stop_icon.addEventListener('mouseout', function() {
      stop_icon.src = '/images/svg/StopButtonWhite.svg';
   });

   let video = document.querySelector('.video-section');
   let video_mobile = document.querySelector('.video-section-mobile');

   $('.play-icon').click(function() {
      if (window.innerWidth > 769) {
         video.querySelector('source').src = '/Video/VenturaH.mp4';
         video.load();
         video.muted = false;
      }
      else {
         video_mobile.querySelector('source').src = '/Video/VenturaV.mp4';
         video_mobile.load();
         video_mobile.muted = false;
      }
      $('.play-icon').addClass('d-none');
      $('.stop-icon').removeClass('d-none');
      $('.title-section').removeClass('d-flex');
      $('.title-section').addClass('d-none');
      $('.content-section').removeClass('d-flex');
      $('.content-section').addClass('d-none');
      $('.content-section2').removeClass('d-flex');
      $('.content-section2').addClass('d-none');
      $('.landing-footer-section').removeClass('d-flex');
      $('.landing-footer-section').addClass('d-none');
      $('.bubble').addClass('d-none');
   });

   $('.stop-icon').click(function() {
      if (window.innerWidth > 769) {
         video.querySelector('source').src = '/Video/VenturaGlobeH.mp4';
         video.load();
         video.muted = true;
      }
      else {
         video_mobile.querySelector('source').src = '/Video/VenturaGlobeV.mp4';
         video_mobile.load();
         video_mobile.muted = true;
      }
      $('.stop-icon').addClass('d-none');
      $('.play-icon').removeClass('d-none');
      $('.title-section').addClass('d-flex');
      $('.title-section').removeClass('d-none');
      $('.content-section').addClass('d-flex');
      $('.content-section').removeClass('d-none');
      $('.content-section2').addClass('d-flex');
      $('.content-section2').removeClass('d-none');
      $('.landing-footer-section').addClass('d-flex');
      $('.landing-footer-section').removeClass('d-none');
      $('.bubble').removeClass('d-none');
   });

</script>
@endsection
