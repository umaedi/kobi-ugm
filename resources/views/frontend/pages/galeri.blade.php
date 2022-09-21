@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Galeri</h3>
    @endslot
    @endcomponent
    <section class="portfolio__area pb-100 pt-100">
        <div class="container">
            <div class="portfolio__menu x-gallery-head justify-content-center d-flex mb-20 wow fadeInUp" data-wow-delay=".5s">
                <div class="masonary-menu filter-button-group">
                   <h3>Galeri Kegiatan</h3>
               </div>
             </div>
             <form action="{{ route('galeri') }}">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="input-group mb-4 sidebar__search">
                            <input type="text" name="search" class="form-control " placeholder="Cari foto disini...">
                        </div>
                    </div>
                    <div class="col-md-2 x-galeri__button">
                        <button class="w-btn w-btn">Cari</button>
                    </div>
                </div>
          
            </form>
           <div class="row grid">
            @foreach ($galleries as $gallery)
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat1 cat2 cat4 wow fadeInUp" data-wow-delay=".3s">
                <div class="portfolio__item mb-30">
                   <div class="portfolio__thumb w-img">
                      <img src="{{ asset('storage/galeri/' . $gallery->photo) }}" >
                      <div class="portfolio__content">
                         <h3 class="portfolio__title"><a href="portfolio-details.html">{{ $gallery->title }}</a></h3>
                      </div>
                   </div>
                </div>
             </div>
            @endforeach
           </div>
           <div class="row text-center wow fadeInUp" data-wow-delay=".3s">
               {{ $galleries->links() }}
           </div>
        </div>
     </section>
@endsection
@push('js')
    <script>
        function getPhotos(){
            $.ajax({
                url: BaseUrl+'/api/user/photos',
                method: 'POST',
                data
            });
        }
    </script>
@endpush