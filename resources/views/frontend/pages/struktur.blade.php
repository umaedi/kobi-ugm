@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3>{{  __('Struktur Organisasi') }}</h3>
    </div>
    @endslot
    @endcomponent

    @component('components.frontend.page_content')
    @slot('page_content')
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 mt-3">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-50 wow fadeInUp" data-wow-delay=".3s">
                <h2>Dewan Penasihat dan Struktur Organisasi KOBI</h2>
                <p id="decLatter" class="text-center"></p>
            </div>
        </div>
        <div class="row portfolio__menu wow fadeInUp mb-50" data-wow-delay=".2s">
            <div class="col-md-5 ">
                  <div class="sidebar__search">
                     <?php $start = date('Y'); $end = 2019 ?>
                     <select class="form-control" name="search">
                     <option selected value="{{ date('Y') }}">Tampilkan berdasarkan tahun</option>
                     <?php for($i=$end; $i<=$start; $i++) { ?>
                        <option value="<?php echo $i; ?>"> <?php echo ucwords($i); ?> </option>
                     <?php } ?>
                     </select>
                  </div>
            </div>
         <div class="col-md-2 x-galeri__button">
            <button type="submit" class="w-btn w-btn" onclick="getKeyword()">Tampilkan</button>
         </div>
      </div>
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Pendiri KOBI</h2>
            </div>    
        </div>
        <div class="row justify-content-center" id="founder-content">
            
        </div>
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Dewan Penasihat KOBI</h2>
            </div>    
        </div>
        <div class="row justify-content-center" id="advisor-content">
            
        </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Struktur Organisasi KOBI</h2>
                <h4>Ketua dan Wakil Ketua</h4>
            </div>    
        </div>
        <div class="row justify-content-center" id="chairman-content">

        </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Sekretaris KOBI</h2>
            </div>    
        </div>
        <div class="row justify-content-center" id="secretary-content">
         
        </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Bendahara KOBI</h2>
            </div>    
        </div>
        <div class="row justify-content-center" id="treasurer-content">
         
        </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Koordinator Wilayah</h2>
            </div>    
        </div>
         <div class="row justify-content-center" id="coorregion-content">

         </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Koordinator Bidang Kurikulum</h2>
            </div>    
        </div>
         <div class="row justify-content-center" id="curriculum-content">

         </div>
            <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
               <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                   <h2>HUMAS</h2>
               </div>    
           </div>
           <div class="row justify-content-center" id="relationship-content">
   
            </div>
         </div>
      </div>
   </div>
    @endslot
    @endcomponent
@endsection
@push('js')
    <script>
      function getDecisionLatter()
      {
         $.ajax({
            url: BaseUrl+'/api/user/decision-latter',
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.dec_latter;
                  $('#decLatter').html(data.body);
                  getFounder()
               }
            }
         });
      }
      getDecisionLatter();

         function getFounder(){
         $.ajax({
            url: BaseUrl+'/api/user/founder',
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.founder;
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
                  getAdvisor();
               }
            }
         });
      }

      function getKeyword(){
         let keyword = $('select[name=search]').val();
         let search = '?search='+keyword;
         getAdvisor(search)
      }

      function getAdvisor(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/advisor/getadvisor'
         }else {
            var path =  BaseUrl+'/api/user/advisor/getadvisor'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.advisor;
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#advisor-content').html(content);
                  getChairman(search)
               }
            }
         });
      }
      
      function getChairman(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/chairman'
         }else {
            var path =  BaseUrl+'/api/user/chairman'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.chairman;
                  console.log(data);
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#chairman-content').html(content);
                  getSecretary(search);
               }
            }
         });
      }

      function getSecretary(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/secretaries'
         }else {
            var path =  BaseUrl+'/api/user/secretaries'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.secretaries;
                  console.log(data);
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#secretary-content').html(content);
                  getTeasurer(search);
               }
            }
         });
      }

      function getTeasurer(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/treasurer'
         }else {
            var path =  BaseUrl+'/api/user/treasurer'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.treasurer;
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#treasurer-content').html(content);
                  getCoorregion(search);
               }
            }
         });
      }

      function getCoorregion(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/coorregion'
         }else {
            var path =  BaseUrl+'/api/user/coorregion'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.coorregion;
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#coorregion-content').html(content);
                  getCurriculum(search);
               }
            }
         });
      }

      function getCurriculum(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/curriculum'
         }else {
            var path =  BaseUrl+'/api/user/curriculum'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.curriculum;
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#curriculum-content').html(content);
                  getRelationship(search);
               }
            }
         });
      }

      function getRelationship(search)
      {
         if(search == null) {
           var path =  BaseUrl+'/api/user/relationship'
         }else {
            var path =  BaseUrl+'/api/user/relationship'+search
         }

         $.ajax({
            url: path,
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.relationship;
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">'+ v.department +'</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#relationship-content').html(content);
               }
            }
         });
      }
    </script>
@endpush