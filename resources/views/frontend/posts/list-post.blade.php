@extends('layouts.frontend.app')
@section('content')
<main>

    <!-- page title area start -->
    @component('components.frontend.breadcrumb')
        @slot('breadcrumb')
        <div class="page__title-wrapper text-center">
         <h3>Berita/Artikel</h3>
      </div>
      @endslot
    @endcomponent
    <!-- page title area end -->

     <!-- blog area start -->
     <section class="blog__area pt-120 pb-120">
           <div class="container">
              <div class="row">
                 <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="blog__wrapper">
                       <div class="postbox__item mb-70 wow fadeInUp" data-wow-delay=".3s">
                          <div class="postbox__content x-postbox">
                            <div class="sidebar__widget mb-60 wow fadeInUp" data-wow-delay=".7s">
                              <div class="portfolio__menu d-flex mb-30">
                                 <div class="masonary-menu filter-button-group">
                                    <h3>Semua Berita</h3>
                                </div>
                              </div>
                              <div class="sidebar__widget-body">
                                @if ($posts->count())
                                @foreach ($posts as $post)
                                <div class="rc__post">
                                  <ul>
                                     <li class="d-flex mb-30 x-mb-3">
                                        <div class="x-blog__thumb-5 mr-30">
                                           <a href="/{{ $post->slug }}">
                                              <img data-src="{{ asset('storage/thumb/'. $post->image) }}" alt="{{ $post->title }}" class="lazyload">
                                           </a>
                                        </div>
                                        <div class="rc__content">
                                           <div class="rc__meta">
                                              <span>{{ $post->created_at }}</span>
                                           </div>
                                           <h3 class="rc__title"><a href="/{{ $post->slug }}">{{ $post->title }}</a></h3>
                                           <p>{{ $post->excerpt }}</p>
                                        </div>
                                     </li>
                                  </ul>
                               </div>
                                @endforeach
                                @else
                                <p>Halaman tidak ditemukan</p>
                                @endif
                              </div>
                           </div>
                          </div>
                       </div>
                       <div class="basic-pagination wow fadeInUp" data-wow-delay=".9s">
                        <ul>
                           <li>
                            {{ $posts->links() }}
                           </li>
                        </ul>
                     </div>

                     <div class="postbox__author grey-bg-13 d-sm-flex mt-50 wow fadeInUp" data-wow-delay="1.2s">
                      <div class="postbox__author-thumb mr-20">
                         <img class="lazyload" data-src="{{ asset('frontend') }}/img/logo/logo-kobi.png" alt="">
                      </div>
                      <div class="postbox__author-content">
                        <h4>{{ $settings['nama_web'] }}</h4>
                        <p>{{ $settings['alamat'] }}</p>
                        <br>
                        <a href="mailto:{{ $settings['email'] }}"><p>Email: {{ $settings['email'] }}</p></a>
                        <a href="https://api.whatsapp.com/send?phone={{ $settings['no_tlp'] }}" target="_blank"><p>No HP: +{{ $settings['no_tlp'] }}</p></a>
                     </div>
                   </div>
                    </div>
                 </div>
                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8">
                    <div class="blog__sidebar pl-30">
                       <div class="sidebar__widget mb-60 wow fadeInUp" data-wow-delay=".3s">
                          <div class="sidebar__search">
                             <form action="/posts/list">
                                <input type="text" placeholder="Cari..." name="search" value="{{ request('search') }}">
                                <button type="submit"><i class="far fa-search"></i></button>
                             </form>
                          </div>
                       </div>
                       <div class="sidebar__widget mb-60 wow fadeInUp" data-wow-delay=".7s">
                        <div class="sidebar__widget-head">
                           <h3 class="sidebar__widget-title">Postingan Populer</h3>
                        </div>
                        <div id="lastPost"></div>
                     </div>
                       <div class="sidebar__widget mb-60 wow fadeInUp" data-wow-delay=".5s">
                          <div class="sidebar__widget-head">
                             <h3 class="sidebar__widget-title">Semua Kategori</h3>
                          </div>
                          <div class="sidebar__widget-body">
                             <div class="sidebar__tags">
                                <ul>
                                  @foreach ($categories as $category)
                                  <li><a href="/posts/category/{{ $category->slug }}">{{ $category->name }}</a></li>
                                  @endforeach
                                </ul>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </section>
     <!-- blog area end -->
  </main>
@endsection
@push('js')
<script>
   $(() => {
      $.ajax({
         url: BaseUrl+'/api/user/populer-post',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         method: 'POST',
         complete: (response) => {
            if(response.status == 200) {
               let data = response.responseJSON.data.lastpost;
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
                  content += '<span>'+ v.created_at +'</span>';
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
   })
</script>
@endpush