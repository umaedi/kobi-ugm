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
            <div class="lh-1 ms-auto">
              <a href="{{ url('/') }}" class="text-decoration-none"><h1 class="h6 mb-0 text-white lh-1 ">{{ __('Kembali') }}</h1></a>
            </div>
          </div>
        <div>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">{{ __('Mohon isi formulir dibawah ini') }}</h6>
                <form id="store">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="univ" class="form-label mt-3">{{ __('Nama Universitas') }}</label>
                        <input name="nama_univ" type="text" class="form-control" id="univ">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="email" class="form-label mt-3">{{ __('Email Pendaftar') }}</label>
                        <input name="email_user" type="email" class="form-control" id="email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="jurusan" class="form-label mt-3">{{ __('Nama Fakultas') }}</label>
                        <input name="nama_fakultas" type="text" class="form-control" id="jurusan">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="provinsi" class="form-label mt-3">{{ __('Provinsi') }}</label>
                        <select name="provinsi" class="form-control" id="province">
                          <option>{{ __('Pilih Provinsi') }}</option>
                          @foreach ($provinces as $prov)
                          <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="email" class="form-label mt-3">{{ __('Nama Prodi/Jurusan') }}</label>
                        <input name="nama_jurusan" type="text" class="form-control" id="email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="kota" class="form-label mt-3">{{ __('Kabupaten/Kota') }}</label>
                        <select name="kabupaten" class="form-control" id="kabupaten">
                          <option>{{ __('Pilih Kabupaten') }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mt-3">
                      <label for="alamat" class="form-label">{{ __('Email Kaprodi/Jurusan') }}</label>
                      <input name="email_kaprodi" type="text" class="form-control" id="jurusan">
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="pos" class="form-label mt-3">{{ __('Kode Pos') }}</label>
                        <input name="kode_pos" type="number" class="form-control" id="pos">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="name" class="form-label mt-3">{{ ('Nomor Telpon Prodi/jurusan') }}</label>
                        <input name="no_tlp" type="text" class="form-control phone-number">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                          <label for="name" class="form-label mt-3">{{ __('Unggah bukti pembayaran') }}</label>
                          <input name="bukti_pembayaran" type="file" class="form-control phone-number">
                          <small id="passwordHelpBlock" class="form-text">
                            <span><a href="{{ route('persyaratan') }}">Lihat bagian persyaratan</a></span> 
                          </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                          <label for="name" class="form-label mt-3">{{ __('Nomor WhatsApp/Narahubung') }}</label>
                          <input name="no_wa" type="text" class="form-control phone-number">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="form-label mt-3">{{ __('Alamat Pengiriman Sertifikat') }}</label>
                      <textarea name="alamat" type="text" class="form-control phone-number" rows="3"></textarea>
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
<script src=https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js></script>
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
                  $('select[name=kabupaten]').html(append);
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
              url: BaseUrl+'/api/list-anggota',
              method: 'POST',
              data: data,
              processData: false,
              contentType: false,
              cache: false,
              complete: function(response){
                if(response.status == 201) {
                 
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
                  swal({
                    title: "",
                    text: response.responseJSON.message,
                    icon: "warning"
                  })
                }
              }
            });
        });

        Inputmask({ "mask": "+62-9999-9999-9999"}).mask(document.querySelectorAll("input.phone-number"));
    </script>
@endpush