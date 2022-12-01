@extends('layouts.frontend.app')
@section('content')
    @component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3>{{ __('Pendaftaran Anggota Baru') }}</h3>
    </div>
    @endslot
    @endcomponent

    @component('components.frontend.page_content')
        @slot('page_content')
        <div class="d-flex align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
            <div class="lh-1">
              <h1 class="h6 mb-0 text-white lh-1">{{ __('Formulir Pendaftaran Anggota KOBI') }}</h1>
            </div>
          </div>
        <div>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-3">{{ __('Mohon isi formulir di bawah ini') }}</h6>
                <form id="store">
                  @csrf
                  <div class="row">
                    <input type="hidden" name="status" value="0">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="univ" class="form-label mt-3">{{ __('Nama Universitas') }}</label>
                        <input name="nama_univ" type="text" class="form-control" id="univ" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="kaprodi" class="form-label mt-3">{{ __('Nama Fakultas') }}</label>
                        <input name="nama_fakultas" type="text" class="form-control" id="kaprodi" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="jurusan" class="form-label mt-3">{{ __('Nama Program Studi/Jurusan') }}</label>
                        <input name="nama_jurusan" type="text" class="form-control" id="jurusan" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="mb-3">
                        <label for="jurusan" class="form-label mt-3">{{ __('Jenjang Studi') }}</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="jenjang_studi">
                          <option>S1</option>
                          <option>S2</option>
                          <option>S3</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label for="email" class="form-label mt-3">{{ __('Email Ketua Program Studi/Jurusan') }}</label>
                        <input name="email_kaprodi" type="email" class="form-control" id="email" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label for="email" class="form-label mt-3">{{ __('Email Pendaftar') }}</label>
                        <input name="email_user" type="email" class="form-control" id="email" required>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">{{ __('Alamat Pengiriman Sertifikat') }}</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="5" name="alamat" required></textarea>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="provinsi" class="form-label mt-3">{{ __('Provinsi') }}</label>
                        <select name="province_id" class="form-control" id="province" required>
                          <option>{{ __('Pilih Provinsi') }}</option>
                          @foreach ($provinces as $prov)
                          <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="kota" class="form-label mt-3">{{ __('Kabupaten/Kota') }}</label>
                        <select name="regency_id" class="form-control" id="regency_id" required>
                          <option>{{ __('Pilih Kabupaten') }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="name" class="form-label mt-3">{{ __('Nomor Telepon Program Studi/Jurusan') }}</label>
                        <input name="no_tlp" type="tel" class="form-control phone-number" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                            <label for="pos" class="form-label mt-3">{{ __('Kode Pos') }}</label>
                            <input name="kode_pos" type="text" minlength="5" maxlength="5" class="form-control" id="pos" required>
                          </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="name" class="form-label mt-3">{{ __('Nomor WhatsApp/Narahubung') }}</label>
                        <input name="no_wa" type="tel" class="form-control phone-number" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="formFile" class="form-label">{{ __('Unggah Bukti Pembayaran') }}</label>
                        <input name="bukti_pembayaran" class="form-control" type="file" id="formFile" required>
                        <small id="passwordHelpBlock" class="form-text">
                          <span><a href="{{ route('persyaratan') }}">Lihat no rekening dibagian persyaratan</a></span> 
                        </small>
                      </div>
                    </div>
                  </div>
                  <button id="btnSend" type="submit" class="w-btn w-btn">{{ __('Daftar') }}</button>
                </form>
                <button id="btnSending" class="w-btn w-btn" type="button" disabled style="display: none">Ajukan...
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  <span class="sr-only">Loading...</span>
                </button>
              </div>
        </div>
        @endslot
    @endcomponent
@endsection
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
  <script>
        $('#province').change(() => {
          let id_province = $('#province').val();
          $.ajax({
            url: BaseUrl+'/api/getRegencies/'+id_province,
            method: 'GET',
            procesData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
              if(response.status == 200) {
                let data = response.responseJSON.data.kabupten;
                
                let append = '';
                $.each(data, (k, v) => {
                  append +=' <option value='+ v.id +'>'+ v.name +'</option>';
                  $('select[name=regency_id]').html(append);
                });
              }
            }
          });
        });

        $("#store").submit(function(event){
            event.preventDefault();

            $('#btnSend').attr('style', 'display: none');
            $('#btnSending').removeAttr('style', 'display: none');

            var form = $(this)[0];
            var data = new FormData(form);
        
            $.ajax({
              url: BaseUrl+'/api/user/daftar/anggota-baru',
              method: 'post',
              data: data,
              processData: false,
              contentType: false,
              cache: false,
              complete: function(response){
                if(response.status == 201) {
                 
                  sendMil();
                  $('#btnSend').removeAttr('style', 'display: none');
                  $('#btnSending').attr('style', 'display: none');

                  swal({
                    title: "",
                    text: "Pendaftaran Berhasil",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace('/notifikasi/pendaftaran');
                  });
                }else {
                  $('#btnSend').removeAttr('style', 'display: none');
                  $('#btnSending').attr('style', 'display: none');
                  swal({
                    title: "",
                    text: response.responseJSON.message,
                    icon: "warning"
                  })
                }
              }
            });
            function sendMil(){
              $.ajax({
                url: BaseUrl+'/api/user/anggota-baru/send-mail',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                complete: (response) => {
                  console.log('Email terkirim');
                }
              });
            };
        });
    </script>
@endpush

