<meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>KOBI | {{ $title }}</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Place favicon.ico in the root directory -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/img/favicon.png">
      <!-- CSS here -->
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/preloader.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/meanmenu.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.min.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/backToTop.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/jquery.fancybox.min.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/fontAwesome5Pro.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/elegantFont.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/default.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
      <link rel="stylesheet" href="{{ asset('frontend') }}/css/app-responsive.css">
      <script>
            let BaseUrl = "{{ url('/') }}"
      </script>
@stack('css')