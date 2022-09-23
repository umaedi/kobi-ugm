@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Galeri</h3>
    @endslot
    @endcomponent
    <section class="portfolio__area pb-50 pt-40">
      <div class="portfolio__menu x-gallery-head justify-content-center d-flex mb-20 wow fadeInUp" data-wow-delay=".5s">
         <div class="masonary-menu filter-button-group">
            <h3>Galeri Kegiatan</h3>
        </div>
      </div>
        <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="input-group mb-4 sidebar__search">
                    <input type="text" name="q" class="form-control " placeholder="Cari foto disini...">
                </div>
            </div>
            <div class="col-md-2 x-galeri__button">
                <button type="submit" class="w-btn w-btn" onclick="search()">Cari</button>
            </div>
        </div>
            <div class="row"  id="galleries">

            </div>
            <div class="row " id="btnLoadMore">
               <div class="col-xxl-12 wow fadeInUp" data-wow-delay=".3s">
                  <div class="portfolio__more mt-30 text-center">
                     <button class="w-btn w-btn" id="loadMore" onclick="loadMore()" data-value="">Lihat lebih banyak</button>
                  </div>
               </div>
            </div>
        </div>
   </section>
@endsection
@push('js')
    <script>
        let data = {
            page: '1',
        };
        function getGalleries(data){
            $.ajax({
                url: BaseUrl+'/api/user/galleries',
                method: 'POST',
                data: data,
                complete: (response) => {
                if(response.status == 200) {
                    let data = response.responseJSON.data.data;
                    if(data.length < 12) {
                     $('#btnLoadMore').addClass('d-none');
                    }
                    let content = '';
                    $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat2 cat3 wow fadeInUp" data-wow-delay="1.5s">';
                     content += '<div class="portfolio__item mb-30">';
                     content += '<div class="portfolio__thumb w-img">';
                     content += '<img data-src="{{ asset('storage/galeri') }}/'+ v.photo +'" class="lazyload">';
                     content += '<div class="portfolio__content">';
                     content += '<span>'+ v.title +'</span>';
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                    });
                    $('#loadMore').data('value', response.responseJSON.data.current_page);
                    $('#galleries').append(content);
                  }
               }
            });
        }
        getGalleries(data);

        function loadMore(){
            $('button.btn-send').attr('style', 'display: none');
            $('#btnSending').removeAttr('style', 'display: none');
            var page = parseInt($('#loadMore').data('value')) + 1;
            var data = {
               page: page,
            }
           getGalleries(data);
         }

      function  search(){
         $('#galleries').html('');
         $('#btnLoadMore').addClass('d-none');
         let keyword = $('input[name=q]').val();
         var data = {
            search: keyword,
         }
         getGalleries(data);
      }
    </script>
@endpush