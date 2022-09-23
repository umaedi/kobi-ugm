<div class="header__area">
   <div class="header__top pt-5 pb-5 grey-bg-6">
      <div class="container">
         <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
               <div class="header__info text-center text-sm-start">
                  <a href="mailto:kobi.biologi@gmail.com"> <i class="icon_mail"></i> <span >kobi.biologi@gmail.com</span></a>
                  <a href="https://api.whatsapp.com/send?phone=6285600997890" target="_blank"> <i class="icon_phone w-phone"></i> +6285600997890</a>
               </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
               <div class="header__social fix float-end d-none d-sm-block">
                  <h5>Ikuti Kami</h5>
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
   <div  id="header-sticky" class="header__bottom header__padding">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xxl-1 col-xl-2 col-lg-2 col-md-6 col-6">
               <div class="logo">
                  <a href="{{ url('/') }}">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/logo/logo-kobi.png" alt="logo" width="70px">
                  </a>
               </div>
            </div>
            <div class="col-xxl-11 col-xl-10 col-lg-10 d-none d-lg-block">
               <div class="main-menu main-menu-5 ml-90">
                  <nav id="mobile-menu">
                     <ul>
                        <li class="has-dropdown">
                           <a href="#">TENTANG KAMI</a>
                           <ul class="submenu">
                              <li><a href="{{ route('about') }}">Sejarah</a></li>
                              <li><a href="{{ route('visi-misi') }}">Visi Misi dan Tujuan</a></li>
                              <li><a href="{{ route('struktur-orgnanisasi') }}">Struktur Organisasi</a></li>
                           </ul>
                        </li>
                        <li class="has-dropdown">
                           <a href="#">DOKUMEN</a>
                           <ul class="submenu">
                              <li><a href="{{ route('publikasi') }}">Publikasi</a></li>
                              <li><a href="{{ route('naskah-akademik') }}">Naskah Akademik</a></li>
                              <li><a id="adArt" target="_blank">AD/ART</a></li>
                              <li><a href="{{ route('kurikulum') }}">Kurikulum</a></li>
                              <li><a href="{{ route('laporan') }}">Laporan Kegiatan KOBI</a></li>
                           </ul>
                        </li>
                        <li class="has-dropdown">
                           <a href="#">KEANGGOTAAN</a>
                           <ul class="submenu">
                              <li><a href="{{ route('pendaftaran') }}">Pendaftaran Anggota Lama</a></li>
                              <li><a href="{{ route('pendaftaran-anggota-baru') }}">Pendaftaran Anggota Baru</a></li>
                              <li><a href="{{ route('list-anggota') }}">Daftar Anggota Aktif</a></li>
                           </ul>
                        </li>
                        <li class="has-dropdown">
                           <a href="#">STR</a>
                           <ul class="submenu">
                              <li><a href="{{ route('str') }}">Pengajuan STR</a></li>
                              <li><a href="{{ route('upload.str') }}">Struk Pembayaran STR</a></li>
                           </ul>
                        </li>
                        <li><a href="{{ route('posts') }}">BERITA/ARTIKEL</a></li>
                        <li class="has-dropdown">
                           <a href="#">KEGIATAN</a>
                           <ul class="submenu">
                              @foreach ($events as $event)
                              <li><a href="/event/{{ $event->slug }}">{{ $event->name }}</a></li>
                              @endforeach
                              <li><a href="{{ route('galeri') }}">Galeri</a></li>
                           </ul>
                        </li>
                        <li><a href="#">IBI</a></li>
                        @auth
                        <li><a href="{{ route('user.logout') }}"><i class="fa fs-user fa-user-check" onclick="return confirm('Keluar ?')"></i></a></li>
                        @else
                        <li><a href="{{ route('login') }}"><i class="fa fs-user fa-user-lock"></i></a></li>
                        @endauth
                        
                     </ul>
                  </nav>
               </div>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-6 col-6">
              <div class="header__action d-flex align-items-center justify-content-end">
                 <div class="sidebar__menu d-flex justify-content-end d-lg-none">
                    <div class="sidebar-toggle-btn sidebar-toggle-btn-5" id="sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
              </div>
           </div>
         </div>
      </div>
   </div>
</div>