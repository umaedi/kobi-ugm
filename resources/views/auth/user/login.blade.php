@extends('layouts.frontend.app')
@section('content')
<section class="signup__area po-rel-z1 pt-100 pb-145">
    <div class="sign__shape">
       <img class="man-1 lazyload" data-src="{{ asset('frontend') }}/img/icon/sign/man-1.png" alt="">
       <img class="man-2 lazyload" data-src="{{ asset('frontend') }}/img/icon/sign/man-2.png" alt="">
       <img class="bg lazyload" data-src="{{ asset('frontend') }}/img/icon/sign/sign-up.png" alt="">
    </div>
    <div class="container">
       <div class="row">
          <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
             <div class="page__title-wrapper text-center mb-55">
                <h2 class="page__title-2">{{ __('Login ke KOBI') }}</h2>
                <div class="text-center mb-3">
                    {{ __('Atau buat akun dengan mudah') }}
                </div>
             </div>
          </div>
       </div>
       <div class="row justify-content-center">
          @if (session()->has('active'))
            <div class="col-md-5">
               <div class="alert alert-danger" role="alert">
                  {{ session('active') }}
               </div>
            </div>
         @endif
         @if (session()->has('success'))
         <div class="col-md-5">
            <div class="alert alert-success" role="alert">
               {{ session('success') }}
            </div>
         </div>
         @endif
       </div>
       <div class="row">
          <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
             <div class="sign__wrapper white-bg">
                {{-- <div class="sign__header mb-20">
                   <div class="sign__in text-center">
                      <a href="{{ url('/auth/redirect/google') }}" class="sign__social text-start mb-15"><i class="fab fa-google"></i>{{ __('Masuk dengan akun Google') }}</a>
                      <p>{{ __('Atau') }}</p>
                   </div>
                </div> --}}
                <div class="sign__form">
                   <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                      <div class="sign__input-wrapper mb-25">
                         <h5>{{ __('Nomor Anggota') }}</h5>
                         <div class="sign__input">
                            <input type="text" placeholder="Nomor Anggota" name="no_anggota" required>
                            <i class="fal fa-lock"></i>
                         </div>
                      </div>
                      <div class="sign__input-wrapper mb-10">
                         <h5>{{ __('Password') }}</h5>
                         <div class="sign__input">
                            <input type="password" placeholder="Password" name="password" required>
                            <i class="fal fa-lock"></i>
                         </div>
                      </div>
                      <button class="w-btn w-btn-11 w-100 mt-3"> <span></span> {{ __('Masuk') }}</button>
                      <div class="sign__new text-center mt-20">
                         {{ __('Belum punya akun ?') }} <a href="{{ route('user.register') }}" style="color: blue">{{ __("buat akun") }}</a>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection