@extends('layouts.frontend.app')
@section('content')
<main>

    <!-- page title area start -->
    @component('components.frontend.breadcrumb')
        @slot('breadcrumb')
        <div class="page__title-wrapper text-center">
         <h3>Kegiatan</h3>
      </div>
      @endslot
    @endcomponent
    <!-- page title area end -->

     <!-- blog area start -->
     <section class="blog__area pt-120 pb-60">
        <div class="container">
           <div class="row" id="contentPost">
            
           </div>
           <div class="text-center  wow fadeInUp" data-wow-delay=".3s">
            <a href="{{ route('user.event.list')}}" class="w-btn w-btn"> Lihat Semua</a>
         </div>
        </div>
     </section>
     <!-- blog area end -->
  </main>
@endsection
@push('js')
<script>
   let pathname = window.location.pathname.split('/').pop();
   console.log(pathname);
   $.ajax({
      url: BaseUrl+'/api/user/event/list/allcategories/' + pathname,
      method: 'GET',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
         if(response.status == 200) {
            let data = response.responseJSON.data.eventlist;
            let content = '';
            $.each(data, (k, v) => {
               content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">';
               content += '<div class="blog__item-5 mb-30">';
               content += '<div class="blog__thumb-5 fix w-img">';
               content += '<a href=/event/show/'+ v.slug +'><img class="lazyload" data-src="{{ asset('storage/thumb') }}/'+ v.image +'">';
               content += '</a>';
               content += '</div>';
               content += '<div class="blog__content-5">';
               content += '<div class="blog__meta-5">';
               content += '<span class="date">'+ v.publish_at +'</span>';
               content += '<span class="tag"><a href="/event/category/'+ v.event_category.slug +'">'+  v.event_category.name +'</a></span>';
               content += '</div>';
               content += ' <h3 class="blog__title-5"><a href="/event/show/'+  v.slug +'">'+ v.title +'</a></h3>';
               content += '</div>';
               content += '</div>';
               content += '</div>';
            });
            $('#contentPost').html(content);
         }
      }
   });
</script> 
@endpush