<!-- footer area start -->
<footer class="footer__area footer-bg-3 pt-120 p-relative fix">
    <div class="footer__top pb-65">
       <div class="container">
          <div class="row x-footer">
             <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="footer__widget mb-50">
                   <div class="footer__widget-title mb-25">
                      <div class="footer__logo">
                         <a href="#">
                            <img class="lazyload" data-src="{{ asset('frontend') }}/img/logo/kobi-logi-footer.png" alt="logo" width="70">
                         </a>
                      </div>
                   </div>
                   <div class="footer__widget-content footer__widget-content-3">
                      <p>{{ __('Hadir untuk berkontribusi membangun negeri.') }}</p>
                   </div>
                </div>
             </div>
             <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="footer__widget mb-50 footer__pl-70">
                   <div class="footer__widget-title footer__widget-title-3 mb-25">
                      <h3>{{ __('Ringkasan :') }}</h3>
                   </div>
                   <div class="footer__widget-content">
                      <div class="footer__link footer__link-3">
                         <ul>
                            <li><a href="{{ route('about') }}">{{ __('Sejarah') }}</a></li>
                            <li><a href="#">{{ __('Visi Misi dan Tujuan') }}</a></li>
                            <li><a href="{{ route('struktur-orgnanisasi') }}">{{ __('Organisasi') }}</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="footer__widget mb-50 footer__pl-90">
                   <div class="footer__widget-title footer__widget-title-3 mb-25">
                      <h3>{{ __('Dokumen :') }}</h3>
                   </div>
                   <div class="footer__widget-content">
                      <div class="footer__link footer__link-3">
                         <ul>
                            <li><a href="{{ route('publikasi') }}">{{ __('Publikasi') }}</a></li>
                            <li><a href="{{ route('naskah-akademik') }}">{{ __('Naskah Akademik') }}</a></li>
                            <li><a href="{{ asset('adart-kobi') }}">{{ __('AD/ART') }}</a></li>
                            <li><a href="#">{{ __('Kurikulum') }}</a></li>
                            <li><a href="{{ route('laporan') }}">{{ __('Laporan Kegiatan') }}</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xxl-2 col-xl-3 col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".9s">
                <div class="footer__widget mb-50">
                   <div class="footer__widget-title footer__widget-title-3 mb-25">
                      <h3>{{ __('Layanan :') }}</h3>
                   </div>
                   <div class="footer__widget-content">
                      <div class="footer__link footer__link-3">
                         <ul>
                            <li><a href="{{ route('str') }}">{{ __('Persayaratan') }}</a></li>
                            <li><a href="{{ route('pendaftaran') }}">{{ __('Pendaftaran Anggota Baru') }}</a></li>
                            <li><a href="{{ route('pendaftaran-anggota-baru') }}">{{ __('Pendaftaran Anggota Lama') }}</a></li>
                            <li><a href="{{ route('str') }}">{{ __('Pengajuan STR') }}</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="1.2s">
                <div class="footer__widget mb-50 float-md-end fix">
                   <div class="footer__widget-title footer__widget-title-3 mb-25">
                      <h3>{{ __('Ikuti Kami') }}</h3>
                   </div>
                   <div class="footer__widget-content">
                      <div class="footer__social footer__social-5">
                         <ul>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="footer__bottom">
       <div class="container">
          <div class="footer__copyright footer__copyright-2">
             <div class="row">
                <div class="col-xxl-12 wow fadeInUp" data-wow-delay=".5s">
                   <div class="footer__copyright-wrapper footer__copyright-wrapper-3 text-center">
                      <p>{{ __('Copyright © 2022 Konsorsium Biologi Indonesia. All rights reserved') }}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </footer>
 <!-- footer area end -->