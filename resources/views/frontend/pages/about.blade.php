@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3>Sejarah Berdirinya KOBI</h3>
    </div>
    @endslot
    @endcomponent

    @component('components.frontend.page_content')
    @slot('page_content')
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="section__title-wrapper section__title-wrapper-4 mb-65 wow fadeInUp" data-wow-delay=".3s">
                <h2 class="text-center" id="aboutTitle"></h2>
                <p id="aboutBody"></p>
            </div>
        </div>
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="section__title-wrapper section__title-wrapper-4 mb-65 wow fadeInUp" data-wow-delay=".3s">
                <h2 class="text-center">Pendiri Konsorsium Biologi Indonesia</h2>
            </div>    
        </div>
        <div class="row justify-content-center" id="founder-content">
            
         </div>
    @endslot
    @endcomponent
@endsection
@push('js')
    <script>
      function getAbout() {
         $.ajax({
            url: BaseUrl+'/api/user/history',
            complete: (response) => {
               const data = response.responseJSON.data.about;
               $('h2#aboutTitle').html(`${data.title}`);
               $('#aboutBody').html(`${data.body}`);
            }
         });
      }
      getAbout();

      function getFounder(){
         $.ajax({
            url: BaseUrl+'/api/user/founder',
            complete: (response) => {
               let data = response.responseJSON.data.founder;
               console.log(data);
               let content = '';
               $.each(data, (k, v) => {
                  content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">';
                  content += '<div class="team__item mb-40">';
                  content += '<div class="w-img p-relative mb-20 fix rounded">';
                  content += '<img class="lazyload" data-src="{{ asset('storage/founder') }}/'+ v.photo +'">';
                  content += '</div>';
                  content += '<div class="team__content text-center">';
                  content += ' <h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                  content += '<span class="team__position">'+ v.position +'</span>';
                  content += '</div>';
                  content += '</div>';
                  content += '</div>';
               });
               $('#founder-content').html(content);
            }
         });
      }
      getFounder();
    </script>
@endpush