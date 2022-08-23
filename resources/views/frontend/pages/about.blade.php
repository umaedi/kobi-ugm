@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3>Sejarah Berdirinya KOBI</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sejarah Berdirinya KOBI</li>
        </ol>
    </nav>
    </div>
    @endslot
    @endcomponent

    @component('components.frontend.page_content')
    @slot('page_content')
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="section__title-wrapper section__title-wrapper-4 mb-65 wow fadeInUp" data-wow-delay=".3s">
                <h2 class="text-center">Sejarah Berdirinya Konsorsium Biologi Indonesia</h2>
                <p>Berdirinya KOBI diawali adanya diskusi antara para dosen dan peneliti biologi yang tergabung dalam Perhimpunan Biologi Indonesia (PBI) tahun 2009 pada saat Seminar Nasional PBI di FMIPA UIN Malik Ibrahim Malang. Perkumpulan Konsorsium Biologi Indonesia (KOBI) kemudian mulai didirikan di Kota Malang pada 27 Juli 2016 berdasarkan Surat Keputusan Menteri Hukum dan Hak Asasi Manusia RI Nomor: AHU-00385.AH.02.02. Tanggal 05 Mei 2014 dan Surat Keputusan Kepala Badan Pertanahan Nasional RI Nomor: 223/KEP-17.3/X/2014 Tanggal 17 Oktober 2014. Latar belakang pendiriannya yaitu untuk menyepakati agar ada masalah penyusunan kurikulum dan penjaminan mutu/akreditasi prodi menjadi prioritas kerja. Selanjutnya pada hari Kamis, tanggal 22 September 2011 KOBI diresmikan di Fakultas Biologi UGM yang didirikan oleh Prof. Drs. Sutiman Bambang Sumitro, S.U., Ph.D. (Biologi Universitas Brawijaya), Dr. Dra. Retno Peni Sancayaningsih, M.Sc. (Biologi UGM) dan Drs. Adi Pancoro, M.Sc., Ph.D. (Biologi SITH ITB).</p>
                <p>Setelah berdiri, kemudian dibentuk Tim Task Force KOBI yang bertugas menyusun Naskah Akademik Kurikulum Nasional Biologi yang mengacu KKNI (Kerangka Kualifikasi Nasional Indonesia) dan SNDIKTI (Standar Nasional Pendidikan Tinggi) dan berlaku di seluruh Prodi Biologi/Pendidikan Biologi/Bioteknologi/Mikrobiologi dan Biologi Terapan di Indonesia. Selanjutnya disusun juga Naskah Akademik Kurikulum Program Magister Biologi dan Doktor Biologi (Pascasarjana). Dilanjutkan Kongres KOBI I tahun 2016 di Biologi UIN Alauddin Makassar (UINAM), Kongres KOBI 2 di Bioteknologi Universitas Surabaya (Ubaya) tahun 2018, dan Kongres KOBI 3 di Biologi Universitas Bengkulu (UNIB).</p>
            </div>
        </div>
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="section__title-wrapper section__title-wrapper-4 mb-65 wow fadeInUp" data-wow-delay=".3s">
                <h2 class="text-center">Pendiri Konsorsium Biologi Indonesia</h2>
            </div>    
        </div>
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-1.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Prof. Drs. Sutiman Bambang Sumitro, SU., D.Sc</a></h3>
                     <span class="team__position">Biologi UGM</span>
                  </div>
               </div>
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-3.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Drs. Adi Pancoro, M.Sc., Ph.D.</a></h3>
                     <span class="team__position">Biologi SITH ITB</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".9s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-4.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Dr. Hadi Suwono, M.Si.</a></h3>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-2.jpeg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="">Dr. Dra. Retno Peni Sancayaningsih, M.Sc.</a></h3>
                     <span class="team__position">Biologi UGM</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.2s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-5.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Rodiyati Azrianingsih, S.Si.,M.Sc.,Ph.D</a></h3>
                  </div>
               </div>
            </div>
         </div>
    @endslot
    @endcomponent
@endsection