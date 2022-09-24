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
     <section class="blog__area pt-120 pb-60">
        <div class="container">
           <div class="row">
            @foreach ($posts as $post)
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                  <div class="blog__item-5 mb-50">
                     <div class="blog__thumb-5 fix w-img">
                        <a href="/{{ $post->slug }}">
                           <img class="lazyload" data-src="{{ asset('storage/thumb') }}/{{ $post->image }}" alt="">
                        </a>
                     </div>
                     <div class="blog__content-5">
                        <div class="blog__meta-5">
                           <span class="date">{{ $post->created_at }}</span>
                           <span class="tag"><a href="/{{ $post->slug }}">{{ $post->category->name }}</a></span>
                        </div>
                        <h3 class="blog__title-5"><a href="/{{ $post->slug }}">{{ $post->title }}</a></h3>
                     </div>
                  </div>
            </div>
            @endforeach
           </div>
           <div class="text-center  wow fadeInUp" data-wow-delay=".3s">
            <a href="{{ route('posts.list') }}" class="w-btn w-btn-blue"> Lihat Semua</a>
         </div>
        </div>
     </section>
     <!-- blog area end -->
  </main>
@endsection
@push('js')
@endpush