@extends('layouts.frontend.app')
@section('content')
             <!-- hero area start -->
             <section class="hero__area hero__height-5 hero__bg p-relative d-flex align-items-center" data-background="{{ asset('frontend') }}/img/hero/home-5/hero-bg.jpg">
                <div class="hero__shape-5">
                   <img class="hero-5-triangle-1 lazyload" data-src="{{ asset('frontend') }}/img/icon/hero/home-5/hero-5-triangle.png" alt="">
                   <img class="hero-5-triangle-2 lazyload" data-src="{{ asset('frontend') }}/img/icon/hero/home-5/hero-5-triangle-2.png" alt="">
                   <img class="hero-5-line" src="{{ asset('frontend') }}/img/icon/hero/home-5/hero-line.png" alt="">
                </div>
                <div class="container">
                   <div class="row align-items-center">
                      <div class="col-xxl-6 col-xl-6 col-lg-6">
                         <div class="hero__content-5">
                            <h3 class="hero__title-5 wow fadeInUp" data-wow-delay=".3s">Konsorsium Biologi Indonesia</h3>
                            <p class="wow fadeInUp" data-wow-delay=".5s">Hadir untuk berkontribusi membangun negeri. </p>
    
                            <div class="hero__btn d-sm-flex align-items-center">
                               <a href="{{ route('about') }}" class="w-btn w-btn-6 w-btn-white w-btn-white-4 mr-30 wow fadeInUp" data-wow-delay=".7s">Tentang Kami</a>
                            </div>
                         </div>
                      </div>
                      <div class="col-xxl-5 col-xl-6 col-lg-6">
                         <div class="hero__thumb-5 p-relative wow fadeInRight" data-wow-delay=".5s">
                            <img class="hero-5-thumb lazyload" data-src="{{ asset('frontend') }}/img/hero/home-5/hero-thumb.jpg" alt="">
                            <img class="hero-5-shape lazyload" data-src="{{ asset('frontend') }}/img/hero/home-5/hero-shape.png" alt="">
                         </div>
                      </div>
                   </div>
                </div>
             </section>
             <!-- hero area end -->
    
             <!-- promotion area start -->
             <section class="promotion__area pt-110 pb-140">
                <div class="container">
                   <div class="row align-items-center">
                      <div class="col-xxl-5 offset-xxl-1 col-xl-5 offset-xl-1 col-lg-6 col-md-6 order-last order-md-first">
                         <div class="promotion__content-2 pr-70 mb-25">
                            <div class="section__title-wrapper section__title-wrapper-5 mb-25 wow fadeInUp" data-wow-delay=".3s">
                               <h2 class="section__title-5 mb-25 wow fadeInUp" data-wow-delay=".3s">Tentang Kami</h2>
                            </div>
                            <p class="promotion__sub wow fadeInUp" data-wow-delay=".5s">Konsorsium Biologi Indonesia</p>
                            <p class=" wow fadeInUp" data-wow-delay=".7s">KOBI merupakan organisasi yang berperan aktif dalam pengembangan pendidikan tinggi biologi dalam penguasaan keanekaragaman hayati dan pemanfaatan sumber daya alam hayati (bioresources) secara optimal dan berkelanjutan bagi kesejahteraan umat manusia.</p>
                            <a href="{{ route('about') }}" class="w-btn w-btn w-btn-6 w-btn-14 w-btn-1-5 wow fadeInUp" data-wow-delay=".9s">Selengkapnya</a>
                         </div>
                      </div>
                      <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-6">
                         <div class=" promotion__thumb w-img wow fadeInRight" data-wow-delay="1.2s">
                            <img class="lazyload" data-src="{{ asset('frontend') }}/img/promotion/home-5/ketua-umum-kobi.jpg" alt="">
                         </div>
                      </div>
                   </div>
                </div>
             </section>
             <!-- promotion area end -->
    
             <!-- services area start -->
             <section class="services__area dark-blue-bg pt-115 pb-110">
                <div class="container">
                   <div class="row">
                      <div class="col-xxl-6 offset-xxl-3">
                         <div class="section__title-wrapper section__title-wrapper-5 section__title-wrapper-5-p section__title-white text-center mb-55 wow fadeInUp" data-wow-delay=".3s">
                            <h2 class="section__title-5 mb-25">Layanan Konsorsium Biologi Indonesia</h2>
                            <p>Silahkan ikuti alur permohonan pendaftaran anggota dibawah ini:</p>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                    <div
                      class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"
                      data-wow-delay=".3s"
                    >
                      <div
                        class="services__item-3 white-bg transition-3 mb-30 text-center"
                      >
                        <div class="services__icon-3">
                          <img class="lazyload"
                            data-src="{{ asset('frontend') }}/img/icon/services/home-3/services-1.png"
                            alt=""
                          />
                        </div>
                        <div class="services__content-3">
                          <h3 class="services__title-3">
                            <a href="{{ route('str') }}">{{ __('PERSYARATAN') }}</a>
                          </h3>
                          <p>Baca persayaratan sebelum mendaftar</p>
                        </div>
                      </div>
                    </div>
                    <div
                      class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"
                      data-wow-delay=".5s"
                    >
                      <div
                        class="services__item-3 white-bg transition-3 mb-30 text-center"
                      >
                        <div class="services__icon-3">
                          <img class="lazyload"
                            data-src="{{ asset('frontend') }}/img/icon/services/home-3/services-2.png"
                            alt=""
                          />
                        </div>
                        <div class="services__content-3">
                          <h3 class="services__title-3">
                            <a href="{{ route('pendaftaran') }}">{{ __('PENDAFTARAN') }}</a>
                          </h3>
                          <p>Klik di sini untuk mendaftar anggota</p>
                        </div>
                      </div>
                    </div>
                    <div
                      class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"
                      data-wow-delay=".7s"
                    >
                      <div
                        class="services__item-3 white-bg transition-3 mb-30 text-center"
                      >
                        <div class="services__icon-3">
                          <img class="lazyload"
                            data-src="{{ asset('frontend') }}/img/icon/services/home-3/services-3.png"
                            alt=""
                          />
                        </div>
                        <div class="services__content-3">
                          <h3 class="services__title-3">
                            <a href="{{ route('str') }}">{{ __('PENGAJUAN') }}</a>
                          </h3>
                          <p>Klik di sini untuk pengajuan STR</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
             </section>
             <!-- services area end -->
    
             <!-- blog area start -->
             <section class="blog__area pt-130">
                <div class="container">
                   <div class="row">
                      <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-10 offset-md-1">
                         <div class="section__title-wrapper section__title-wrapper-5 text-center mb-55 wow fadeInUp" data-wow-delay=".3s">
                            <h2 class="section__title-5 section__title-5-p mb-15">Baca Berita Atau Artikel KOBI</h2>
                            <p>Semua berita atau artikel telah di verifikasi</p>
                         </div>
                      </div>
                   </div>
                   <div class="row" id="contentPost">
                     
                   </div>
                   <div class="text-center  wow fadeInUp" data-wow-delay=".3s">
                     <a href="{{ route('posts.list') }}" class="w-btn w-btn"> Berita selengkapnya</a>
                  </div>
                </div>
             </section>
             <!-- blog area end -->

             <section class="portfolio__area x-prtofolio__area pt-50">
               <div class="container">
                  <div class="portfolio__menu x-gallery-head d-flex mb-20 wow fadeInUp" data-wow-delay=".5s">
                     <div class="masonary-menu filter-button-group">
                        <h4>Galeri Kegiatan</h4>
                    </div>
                  </div>
                  <div class="row grid" id="xImages">
                     
                  </div>
                  <div class="row">
                     <div class="col-xxl-12 wow fadeInUp" data-wow-delay=".3s">
                        <div class="portfolio__more mt-30 x-protfolio__more text-center">
                           <a href="{{ route('galeri') }}" class="w-btn w-btn">Galeri selengkapnya</a>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
@endsection
@push('js')
<script>
   function getPost()
   {
      $.ajax({
      url: BaseUrl+'/api/user/post/postindex',
      method: 'GET',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
         if(response.status == 200) {
            let data = response.responseJSON.data.posts;
            let content = '';
            $.each(data, (k, v) => {
               content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">';
               content += '<div class="blog__item-5 mb-30">';
               content += '<div class="blog__thumb-5 fix w-img">';
               content += '<a href=/'+ v.slug +'><img class="lazyload" data-src="{{ asset('storage/thumb') }}/'+ v.image +'">';
               content += '</a>';
               content += '</div>';
               content += '<div class="blog__content-5">';
               content += '<div class="blog__meta-5">';
               content += '<span class="date">'+ v.publish_at +'</span>';
               content += '<span class="tag"><a href="/posts/category/'+ v.category.slug +'">'+  v.category.name +'</a></span>';
               content += '</div>';
               content += ' <h3 class="blog__title-5"><a href="/'+  v.slug +'">'+ v.title +'</a></h3>';
               content += '</div>';
               content += '</div>';
               content += '</div>';
            });
            $('#contentPost').html(content);
         }
      }
      });
   }
   getPost();
 
   function getImage()
   {
      $.ajax({
      url: BaseUrl+'/api/user/images',
      method: 'GET',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
         if(response.status == 200) {
            let data = response.responseJSON.data.photos;
            let content = '';
            $.each(data, (k, v) => {
               content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat1 cat2 cat4 wow fadeInUp" data-wow-delay=".3s">';
               content += '<div class="portfolio__item mb-30">';
               content += '<div class="portfolio__thumb w-img">'; 
               content += '<img data-src="{{ asset('storage/galeri') }}/'+ v.photo +'" class="lazyload">';   
               content += '<div class="portfolio__content">';   
               content += '<span>'+ v.title +'</span>';   
               content += '</div>';   
               content += '</div>';   
               content += '</div>';   
               content += '</div>'; 
            });
            $('#xImages').html(content);
         }
      }
      });
   }
   getImage();
 
</script> 
@endpush
