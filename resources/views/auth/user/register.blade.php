@extends('layouts.frontend.app')
@section('content')
<section class="signup__area po-rel-z1 pt-100 pb-145">
    <div class="sign__shape">
       <img class="man-1" src="{{ asset('frontend') }}/img/icon/sign/man-1.png" alt="">
       <img class="man-2" src="{{ asset('frontend') }}/img/icon/sign/man-2.png" alt="">
       <img class="bg" src="{{ asset('frontend') }}/img/icon/sign/sign-up.png" alt="">
    </div>
    <div class="container">
       <div class="row">
          <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
             <div class="page__title-wrapper text-center mb-55">
                <h2 class="page__title-2">Buat akun KOBI</h2>
                <div class="text-center mb-3">
                    Atau buat akun dengan mudah
                </div>
             </div>
          </div>
       </div>
       @if (session()->has('msg'))
       <div class="row justify-content-center">
         <div class="col-md-5">
               <div class="alert alert-danger" role="alert">
                  {{ session('msg') }}
               </div>
         </div>
       </div>
       @endif
       <div class="row">
          <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
             <div class="sign__wrapper white-bg">
                {{-- <div class="sign__header mb-20">
                   <div class="sign__in text-center">
                      <a href="{{ url('/auth/redirect/google') }}" class="sign__social text-start mb-15"><i class="fab fa-google"></i>Buat daftar dengan akun Google</a>
                      <p>Atau</p>
                   </div>
                </div> --}}
                <div class="sign__form">
                   <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                      <div class="sign__input-wrapper mb-25">
                         <h5>Nama Jurusan</h5>
                         <div class="sign__input">
                            <i class="fa fa-user"></i>
                            <input class="form-control @error('nama_jurusan') is-invalid @enderror" type="text" placeholder="Nama jurusan" name="nama_jurusan" value="{{ old('nama_jurusan') }}" required>
                            @error('nama_jurusan')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                         </div>
                      </div>
                      <div class="sign__input-wrapper mb-25">
                         <h5>No Anggota</h5>
                         <div class="sign__input">
                            <input class="form-control @error('no_angota') is-invalid @enderror" type="text" placeholder="No anggota" name="no_anggota" value="{{ old('no_angota') }}" required>
                            <i class="fa fa-user"></i>
                            @error('no_angota')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                         </div>
                      </div>
                      <div class="sign__input-wrapper mb-25">
                         <h5>Email Anda</h5>
                         <div class="sign__input">
                            <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="e-mail" name="email" value="{{ old('email') }}" required>
                            <i class="fal fa-envelope"></i>
                            @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                         </div>
                      </div>
                      <div class="sign__input-wrapper mb-10">
                         <h5>Password</h5>
                         <div class="sign__input">
                            <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required>
                            <i class="fal fa-lock"></i>
                            @error('password')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                         </div>
                      </div>
                      <div class="sign__input-wrapper mt-25">
                         <h5>Konfirmasi password</h5>
                         <div class="sign__input">
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="Password" name="password_confirmation" required>
                            <i class="fal fa-lock"></i>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                         </div>
                      </div>
                      <button class="w-btn w-btn-11 w-100 mt-3"> <span></span> Daftar</button>
                      <div class="sign__new text-center mt-20">
                         Sudah punya akun ? <a href="{{ route('login') }}" style="color: blue">login</a>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection