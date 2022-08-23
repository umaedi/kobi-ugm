@extends('layouts.frontend.app')
@section('content')
    <main>
        @component('components.frontend.breadcrumb')
        @slot('breadcrumb')
        <div class="page__title-wrapper text-center">
         <h3>KOBI | Kurikulum</h3>
      </div>
      @endslot
    @endcomponent

    <section class="blog__area pt-120 pb-120">
        <div class="container">
           <div class="row justify-content-center">
              <div class="col-xxl-8 col-xl-8 col-lg-8">
                 <div class="blog__wrapper">
                    <div class="postbox__item">
                        <div class="postbox__thumb w-img wow fadeInUp" data-wow-delay=".3s">
                            <img src="{{ asset('storage/thumb') }}/" alt="">
                         </div>
                         <div class="postbox__content wow fadeInUp" data-wow-delay=".5s">
                            <div class="postbox__meta mb-20">
                               <span><a href="#"> <i class="icon_tag_alt"></i> Kurikulum</a></span>
                               <span><a href="#"> <i class="fal fa-user"></i> Admin</a></span>
                            </div>
                         </div>
                       <div class="postbox__content wow fadeInUp" data-wow-delay=".5s">
                           <h3 class="postbox__title">Kurikulum KOBI</h3>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                           <div class="postbox__img w-img mt-50">
                              <img class="lazyload" data-src="assets/img/blog/blog-big-2.jpg" alt="">
                           </div>
                       </div>

                       <div class="postbox__share d-flex justify-content-between align-items-center mb-75 wow fadeInUp" data-wow-delay=".9s">
                          <h3>Bagikan :</h3>
                          <ul>
                             <li><a href="https://www.facebook.com/sharer.php?u={{ url('') }}/post/show/"><i class="fab fa-facebook-f"></i></a></li>
                             <li><a href="https://twitter.com/intent/tweet?text={{ url('') }}/post/show/"><i class="fab fa-twitter"></i></a></li>
                             <li><a href="https://api.whatsapp.com/send?phone=&amp;text={{ url('') }}/post/show/"><i class="fab fa-whatsapp"></i></a></li>
                          </ul>
                       </div>
                       <div class="postbox__author grey-bg-13 d-sm-flex mb-65 wow fadeInUp" data-wow-delay="1.2s">
                          <div class="postbox__author-thumb mr-20">
                             <img class="lazyload" data-src="{{ asset('frontend') }}/img/logo/logo-kobi.png" alt="">
                          </div>
                          <div class="postbox__author-content">
                             <h4>Admin</h4>
                             <span>Tentang Penulis</span>
                             <p>Menuntut ilmu adalah taqwa. Menyampaikan ilmu adalah ibadah. Mengulang-ulang ilmu adalah zikir. Mencari ilmu adalah jihad. - Abu Hamid Al Ghazali</p>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
    </main>
@endsection