@extends('layouts.frontend.app')
@section('content')
    <main>
        @component('components.frontend.breadcrumb')
        @slot('breadcrumb')
        <div class="page__title-wrapper text-center">
         <h3>Upload Struk Bukti Pembayaran STR</h3>
      </div>
      @endslot
    @endcomponent

    <section class="blog__area pt-120 pb-120">
        <div class="container">
           <div class="row justify-content-center">
              <div class="col-xxl-8 col-xl-8 col-lg-8">
                 <div class="blog__wrapper">
                    <div class="postbox__item">
                     <form id="formUploadStr">
                        <div class="form-group mb-2">
                           <label for="email-pembayaran">Email pembayaran</label>
                           <input type="email" name="email" class="form-control" id="email-pembayaran" required>
                         </div>
                        <div class="form-group mb-2">
                            <label>Upload bukti pembayaran STR</label>
                            <input type="file" name="struk" class="form-control" placeholder="Pilih file" required>
                        </div>
                        <div class="form-group my-3">
                           <button id="btnSend" class="w-btn w-btn" type="submit">Upload</button>
                         </div>
                     </form>
                     <button id="btnSending" class="w-btn w-btn" type="button" disabled style="display: none">Ajukan...
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                      </button>
                       <div class="postbox__share d-flex justify-content-between align-items-center mb-75 wow fadeInUp" data-wow-delay=".9s">
                          <h3>Bagikan :</h3>
                          <ul>
                             <li><a href="https://www.facebook.com/sharer.php?u={{ url('/permohonan/upload-str') }}"><i class="fab fa-facebook-f"></i></a></li>
                             <li><a href="https://twitter.com/intent/tweet?text={{ url('/permohonan/upload-str') }}"><i class="fab fa-twitter"></i></a></li>
                             <li><a href="https://api.whatsapp.com/send?phone=&amp;text={{ url('/permohonan/upload-str') }}"><i class="fab fa-whatsapp"></i></a></li>
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
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
    <script>
         $('#formUploadStr').submit( function(event){
            event.preventDefault();

            $('#btnSend').attr('style', 'display: none');
            $('#btnSending').removeAttr('style', 'display: none');

            const form = $(this)[0];
            const data = new FormData(form);

         $.ajax({
            url: BaseUrl+'/api/upload/file-str',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
               $('#btnSend').removeAttr('style', 'display: none');
               $('#btnSending').attr('style', 'display: none');
               if(response.status == 201) {
                swal({
                    title: "",
                    text: "Bukti pembayaran berhasil diupload",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/pembayaran-str/berhasil');
                  });
            }else {
               $('#btnSend').removeAttr('style', 'display: none');
               $('#btnSending').attr('style', 'display: none');
                swal("", response.responseJSON.message, "warning");
            }
            }
         });
         });
    </script>
@endpush