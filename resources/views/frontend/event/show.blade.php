@extends('layouts.frontend.app')
@section('content')
    <main>
        @component('components.frontend.breadcrumb')
        @slot('breadcrumb')
        <div class="page__title-wrapper text-center">
         <h3>Kegiatan</h3>
      </div>
      @endslot
    @endcomponent

    <section class="blog__area pt-120 pb-120">
        <div class="container">
           <div class="row">
              <div class="col-xxl-8 col-xl-8 col-lg-8">
                 <div class="blog__wrapper">
                    <div class="postbox__item">
                        <div class="postbox__thumb w-img wow fadeInUp" data-wow-delay=".3s">
                            <img src="{{ asset('storage/thumb') }}/{{ $post->image }}" alt="">
                         </div>
                         <div class="postbox__content wow fadeInUp" data-wow-delay=".5s">
                            <div class="postbox__meta mb-20">
                              <span class="tag"><a href="/event/category/{{ $post->eventCategory->slug }}">{{ $post->eventCategory->name }}</a></span>
                               <span><a href="#"> <i class="fal fa-user"></i> {{ $post->user->name }}</a></span>
                            </div>
                         </div>
                       <div class="postbox__content wow fadeInUp" data-wow-delay=".5s">
                           <h3 class="postbox__title">{{ $post->title }}</h3>
                           <p>{!! $post->body !!}</p>
                       </div>

                       <div class="postbox__share d-flex justify-content-between align-items-center mb-75 wow fadeInUp" data-wow-delay=".9s">
                          <h3>Bagikan :</h3>
                          <ul>
                             <li><a href="https://www.facebook.com/sharer.php?u={{ url('/event/show/'.$post->slug) }}"><i class="fab fa-facebook-f"></i></a></li>
                             <li><a href="https://twitter.com/intent/tweet?text={{ url('/event/show/'.$post->slug) }}"><i class="fab fa-twitter"></i></a></li>
                             <li><a href="https://api.whatsapp.com/send?phone=&amp;text={{ url('/event/show/'.$post->slug) }}"><i class="fab fa-whatsapp"></i></a></li>
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
              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8">
                 <div class="blog__sidebar pl-30">
                    <div class="sidebar__widget wow fadeInUp" data-wow-delay=".3s">
              
                    </div>
                    <div class="sidebar__widget wow fadeInUp" data-wow-delay=".7s">
                       <div class="sidebar__widget-head">
                          <h3 class="sidebar__widget-title">Postingan Terakhir</h3>
                       </div>
                       <div id="lastPost"></div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
    </main>
@endsection
@push('js')
    <script>
      function getPost()
      {
         $.ajax({
         url: BaseUrl+'/api/user/event/last-event',
         method: 'GET',
         processData: false,
         contentType: false,
         cache: false,
         complete: (response) => {
            if(response.status == 200) {
               let data = response.responseJSON.data.lastevent;
               let content = '';
               $.each(data, (k,v) => {
                  content += '<div class="sidebar__widget-body">';
                  content += '<div class="rc__post">';
                  content += '<ul>';
                  content += '<li class="d-flex align-items-center mb-30">';
                  content += ' <div class="rc__thumb mr-30">';
                  content += '<a href=/'+ v.slug +'><img class="lazyload" data-src="{{ asset('storage/thumb') }}/'+ v.image +'">';
                  content += '</a>';
                  content += '</div>';
                  content += '<div class="rc__content">';
                  content += '<div class="rc__meta">';
                  content += '<span>'+ v.publish_at +'</span>';
                  content += ' </div>';
                  content += '<h3 class="rc__title"><a href=/'+  v.slug +'>'+ v.title +'</a></h3>';
                  content += '</div>';
                  content += '</li>';
                  content += '</ul>';
                  content +='</div>';
                  content +='</div>';
               });
               $('#lastPost').html(content);
            }
         }
      });
      }
      getPost()
    </script>
@endpush