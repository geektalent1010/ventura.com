<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#04246b"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ventura') }} @yield('title')</title>

    <!-- ================= Favicons ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{ asset('images/Favicon.png') }}">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/Favicon180x180.png') }}">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/Favicon96x96.png') }}">
    <!-- Standard iPad Touch Icon--> 
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/Favicon96x96.png') }}">
    <!-- Standard iPhone Touch Icon--> 
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/Favicon32x32.png') }}">

    <!--Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('images/Favicon16x16.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font.css') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap_4.1.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugin/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugin/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugin/datatables/Responsive-2.5.0/css/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('PAGE_LEVEL_STYLES')
    <!-- END PAGE LEVEL STYLES -->

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap_4.1.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap-toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugin/datatables/Responsive-2.5.0/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/compress_image.js') }}"></script>
</head>
<body>
    @include('_includes.navbar')

    <!-- BEGIN PAGE START SECTION -->
    @yield('PAGE_START')
    <!-- END PAGE START SECTION -->
    
    @yield('PAGE_CONTENT')

    <!-- BEGIN PAGE END SECTION -->
    @yield('PAGE_END')
    <!-- END PAGE END SECTION -->
    
    @include('_includes.footer')

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    @yield('PAGE_LEVEL_SCRIPTS')
    <!-- END PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
      $('#searchKey').on('keyup', function () {
        var searchKey = $(this).val().trim().toLowerCase();
        $('.member-item').each(function() {
          var fullName = $(this).attr('attr-fullname');
          if (fullName) {
            if (fullName.toLowerCase().includes(searchKey)) {
              $(this).removeClass('d-none');
            } else {
              if(!$(this).hasClass('d-none')) {
                  $(this).addClass('d-none');
              }
            }
          }
        })
      });

      $('.search-icon-section').on('click', function () {
        if ($('#searchKey').val() == undefined) {
          return;
        }
        var searchKey = $('#searchKey').val().trim().toLowerCase();
        $('.member-item').each(function() {
          var fullName = $(this).attr('attr-fullname');
          if (fullName) {
            if (fullName.toLowerCase().includes(searchKey)) {
              $(this).removeClass('d-none');
            } else {
              if(!$(this).hasClass('d-none')) {
                  $(this).addClass('d-none');
              }
            }
          }
        })
      });
    </script>

    @if ($message = Session::get('success'))
    <script>
      toastr['success']('{{ $message }}', 'Success');
    </script>
    @endif

    @if ($message = Session::get('error'))
    <script>toastr['error']('{{ $message }}', 'Error')</script>
    @endif
</body>
</html>
