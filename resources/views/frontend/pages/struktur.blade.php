@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3>{{  __('KOBI | Struktur Organisasi') }}</h3>
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
        <div class="row justify-content-center portfolio__menu wow fadeInUp mb-50" data-wow-delay=".2s">
         <div class="col-md-4 ">
            <div class="sidebar__search">
               <select class="form-control" id="exampleFormControlSelect1">
               <option>Tampilkan berdasarkan tahun</option>
               <option>2020</option>
               <option>2021</option>
               <option>2022</option>
               </select>
            </div>
         </div>
         <div class="col-md-2 x-galeri__button">
            <button class="w-btn w-btn">Tampilkan</button>
         </div>
      </div>
        <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Pendiri KOBI <span class="text-primary">(Konsorium Biologi Indonesia)</span></h2>
            </div>    
        </div>
        <div class="row justify-content-center" id="founder-content">
            
         </div>
        <div class="row justify-content-center">
         <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
            <h2>Dewan Penasihat KOBI <span class="text-primary">(Konsorium Biologi Indonesia)</span></h2>
        </div>
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" id="advisor-content" data-wow-delay=".3s">
            
         </div>
      </div>
      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
         <span class="section__pre-title blue">Anggota</span>
      </div>
      <div class="row justify-content-center" id="member-content">
         
      </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Struktur Organisasi KOBI <span class="text-primary">(Konsorium Biologi Indonesia)</span></h2>
                <h4>Ketua dan Wakil Ketua</h4>
            </div>    
        </div>
        <div class="row justify-content-center">
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
            <div class="team__item mb-40">
               <div class="w-img p-relative mb-20 fix rounded">
                  <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-10.jpg" alt="">
               </div>
               <div class="team__content text-center">
                  <span class="team__position">Ketua</span>
                  <h3 class="team__title"><a href="#">Prof. Dr. Budi Setiadi Daryono, M.Agr.Sc. </a></h3>
                  <span class="team__position">F. Biologi Universitas Gadjah Mada</span>
               </div>
            </div>
         </div>
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
            <div class="team__item mb-40">
               <div class="w-img p-relative mb-20 fix rounded">
                  <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-11.jpg" alt="">
               </div>
               <div class="team__content text-center">
                  <span class="team__position">Wakil Ketua</span>
                  <h3 class="team__title"><a href="#">Dr. Miftahudin</a></h3>
                  <span class="team__position">F.MIPA IPB</span>
               </div>
            </div>
         </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Sekretaris KOBI <span class="text-primary">(Konsorium Biologi Indonesia)</span></h2>
            </div>    
        </div>
        <div class="row justify-content-center">
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
            <div class="team__item mb-40">
               <div class="w-img p-relative mb-20 fix rounded">
                  <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-12.jpg" alt="">
               </div>
               <div class="team__content text-center">
                  <span class="team__position">Sekretaris I</span>
                  <h3 class="team__title"><a href="#">Dr. rer. nat. Andhika Puspito Nugroho</a></h3>
                  <span class="team__position">F. Biologi Universitas Gadjah Mada</span>
               </div>
            </div>
         </div>
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
            <div class="team__item mb-40">
               <div class="w-img p-relative mb-20 fix rounded">
                  <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-13.jpg" alt="">
               </div>
               <div class="team__content text-center">
                  <span class="team__position">Sekretaris II</span>
                  <h3 class="team__title"><a href="#">Dr. Novi Febrianti, M.Si. </a></h3>
                  <span class="team__position">FKIP universitas Ahmad Dahlan</span>
               </div>
            </div>
         </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Bendahara KOBI <span class="text-primary">(Konsorium Biologi Indonesia)</span></h2>
            </div>    
        </div>
        <div class="row justify-content-center">
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
            <div class="team__item mb-40">
               <div class="w-img p-relative mb-20 fix rounded">
                  <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-14.jpg" alt="">
               </div>
               <div class="team__content text-center">
                  <span class="team__position">Bendahara I</span>
                  <h3 class="team__title"><a href="#">Lisna Hidayati, S.Si., M.Biotech. </a></h3>
                  <span class="team__position">F. Biologi Universitas Gadjah Mada</span>
               </div>
            </div>
         </div>
         <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
            <div class="team__item mb-40">
               <div class="w-img p-relative mb-20 fix">
                  <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-15.jpg" alt="">
               </div>
               <div class="team__content text-center">
                  <span class="team__position">Bendahara II</span>
                  <h3 class="team__title"><a href="#">Dr. Dra. Ari Hayati, M.P.</a></h3>
                  <span class="team__position">FMIPA Universitas Islam Malang</span>
               </div>
            </div>
         </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Koordinator Wilayah</h2>
            </div>    
        </div>
         <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-16.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Indonesia Bagian Barat</span>
                     <h3 class="team__title"><a href="#">Dr. Jarulis, M.Si.</a></h3>
                     <span class="team__position">FMIPA Universitas Bengkulu</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-17.jpg" alt="">

                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Indonesia Bagian Tengah</span>
                     <h3 class="team__title"><a href="#">Dr. Jantje Ngangi</a></h3>
                     <span class="team__position">FMIPA Universitas Negeri Manado</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-18.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Indonesia Bagian Timur</span>
                     <h3 class="team__title"><a href="#">Paskalina Theresia Lefaan, S.Si., M.Si.</a></h3>
                     <span class="team__position">FMIPA Universitas Papua</span>
                  </div>
               </div>
            </div>
         <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
            <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                <h2>Koordinator Bidang Kurikulum</h2>
            </div>    
        </div>
         <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-19.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Bidang Kurikulum Biologi</span>
                     <h3 class="team__title"><a href="#">Dr. Tedjo Sukmono, M.Si.</a></h3>
                     <span class="team__position">Fakultas Sains dan Teknologi Universitas Jambi</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-20.jpg" alt="">

                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Bidang Kurikulum Pendidikan Biologi	</span>
                     <h3 class="team__title"><a href="#">Dr. Rusdi, M.Biomed.</a></h3>
                     <span class="team__position">FMIPA Universitas Negeri Jakarta</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-21.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Bidang Kurikulum Bioteknologi</span>
                     <h3 class="team__title"><a href="#">Dr. Titta Novianti, M.Biomed.</a></h3>
                     <span class="team__position">FIKES Universitas Esa Unggul</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-22.jpg" alt="">

                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Kurikulum Pendidikan Profesi</span>
                     <h3 class="team__title"><a href="#">Prof. Dr. rer. nat. Imam Widhiono, M.Z., M.S.
                        </a></h3>
                     <span class="team__position">F. Biologi Universitas Jenderal Soedirman</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-23.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Bidang Jejaring</span>
                     <h3 class="team__title"><a href="#">Dra. Ni Luh Watininasih, M.Sc., Ph.D.</a></h3>
                     <span class="team__position">FMIPA Universitas Udayana</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".9s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-24.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Bidang LAMSAMA	</span>
                     <h3 class="team__title"><a href="#">Dr. Annawaty</a></h3>
                     <span class="team__position">Fakultas MIPA Universitas Tadulako</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.2s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-25.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator bidang Jaminan Mutu </span>
                     <h3 class="team__title"><a href="#">Dr. Nova Hariani</a></h3>
                     <span class="team__position">FMIPA Universitas Mulawarman</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1.2s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-26.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <span class="team__position">Koordinator Kerja sama dengan UIN</span>
                     <h3 class="team__title"><a href="#">Prof. Dr. Lily Surraya Eka Putri, M.Env.Stud.</a></h3>
                     <span class="team__position">FST UIN Syarif Hidayatullah Jakarta</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-12  col-xl-12  col-lg-12 col-md-12 ">
               <div class="text-center section__title-wrapper section__title-wrapper-4 mb-40 wow fadeInUp" data-wow-delay=".3s">
                   <h2>HUMAS</h2>
               </div>    
           </div>
           <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-27.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Dr. Evika Sandi Savitri, M.P.</a></h3>
                     <span class="team__position">FST UIN Syarif Hidayatullah Jakarta</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-28.jpg" alt="">

                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Muhammad Badrut Tamam, S.Pd., M.Sc.</a></h3>
                     <span class="team__position">FST Universitas Muhammadiyah Lamongan</span>
                  </div>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
               <div class="team__item mb-40">
                  <div class="w-img p-relative mb-20 fix rounded">
                     <img class="lazyload" data-src="{{ asset('frontend') }}/img/pengurus/kobi-29.jpg" alt="">
                  </div>
                  <div class="team__content text-center">
                     <h3 class="team__title"><a href="#">Moh. Iqbal, S.Si., M.Sc.</a></h3>
                     <span class="team__position">Fakultas MIPA Universitas Tadulako</span>
                  </div>
               </div>
            </div>
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

      function getAdvisor()
      {
         $.ajax({
            url: BaseUrl+'/api/user/advisor/getleader',
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.advisor;
                  console.log(data);
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     content += '<span class="team__position">Ketua</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#advisor-content').html(content);
                  getMemberAdsvisor();
               }
            }
         });
      }

      function getMemberAdsvisor()
      {
         $.ajax({
            url: BaseUrl+'/api/user/advisor/getmember',
            complete: (response) => {
               if(response.status == 200) {
                  let data = response.responseJSON.data.member;
                  console.log(data);
                  let content = '';
                  $.each(data, (k, v) => {
                     content += '<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp"  data-wow-delay=".1s">';
                     content += '<div class="team__item mb-40">';
                     content += '<div class="w-img p-relative mb-20 fix rounded">';
                     content += '<img class="lazyload" data-src="{{ asset('storage/structure') }}/'+ v.photo +'">';
                     content += '</div>';
                     content += '<div class="team__content text-center">';
                     // content += '<span class="team__position">Ketua</span>';
                     content += '<h3 class="team__title"><a href="#">'+ v.name +'</a></h3>';
                     content += '<span class="team__position">'+ v.univ +'</span>'
                     content += '</div>';
                     content += '</div>';
                     content += '</div>';
                  });
                  $('#member-content').html(content);
               }
            }
         });
      }
      
    </script>
@endpush