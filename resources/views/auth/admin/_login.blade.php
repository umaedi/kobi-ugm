<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>KOBI | Konsorium Biologi Indonesia</title>
  <link href="{{ asset('backend') }}/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('backend') }}/css/style.css">
  <script>
	var BaseUrl = '{{url('/')}}'; 
	</script>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="{{ asset('frontend') }}/img/logo/logo-kobi.png" alt="logo" width="80"
              class="shadow-light mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">{{ __('Silahkan login') }}</h4>
            <p class="text-muted">{{ __('Login dengan email dan password Anda') }}</p>
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-group">
                @if (session()->has('msg'))
                <div class="alert alert-danger">{!! session('msg') !!}</div>
                @endif
                <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">{{ __('Password') }}</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
              </div>
              <div class="form-group ">
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
              </div>
            </form>
          </div>
        </div>
        <div
          class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
          data-background="{{ asset('backend') }}/img/kobi-login.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-3">
                <h1 class="mb-2 font-weight-bold">{{ __('Selamat datang Admin') }}</h1>
                <h5 class="font-weight-normal text-muted-transparent">{{ __('Apa fokus utama Anda hari ini ?') }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="{{ asset('backend') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('backend') }}/js/scripts.js"></script>
  <script src="{{ asset('backend') }}/js/stisla.js"></script>
</body>
</html>

